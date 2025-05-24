<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GuessFigureQuiz;
use App\Models\GuessFigureQuestion;
use App\Models\HistoricalFigures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuessFigureQuizController extends Controller
{
    public function index()
    {
        $quizzes = GuessFigureQuiz::with(['questions.historicalFigure'])->get();
        return view('pages.dashboard.guess-figure.index', compact('quizzes'));
    }

    public function create()
    {
        $historicalFigures = HistoricalFigures::all();
        return view('pages.dashboard.guess-figure.create', compact('historicalFigures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.historical_figure_id' => 'required|exists:historical_figures,id',
            'questions.*.image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'questions.*.hint' => 'nullable|string',
            'questions.*.correct_latitude' => 'required|numeric',
            'questions.*.correct_longitude' => 'required|numeric',
            'questions.*.order' => 'required|integer|min:0'
        ]);

        $quiz = GuessFigureQuiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => true
        ]);

        foreach ($request->questions as $question) {
            $imagePath = $question['image']->store('guess-figure', 'public');
            
            $quiz->questions()->create([
                'historical_figure_id' => $question['historical_figure_id'],
                'image' => $imagePath,
                'hint' => $question['hint'],
                'correct_latitude' => $question['correct_latitude'],
                'correct_longitude' => $question['correct_longitude'],
                'order' => $question['order']
            ]);
        }

        return redirect()->route('guess-figure.index')
            ->with('success', 'Quiz berhasil dibuat');
    }

    public function show(GuessFigureQuiz $guessFigureQuiz)
    {
        $quiz = $guessFigureQuiz->load(['questions.historicalFigure']);
        return view('pages.dashboard.guess-figure.show', compact('quiz'));
    }

    public function edit(GuessFigureQuiz $guessFigureQuiz)
    {
        $quiz = $guessFigureQuiz->load(['questions.historicalFigure']);
        $historicalFigures = HistoricalFigures::all();
        return view('pages.dashboard.guess-figure.edit', compact('quiz', 'historicalFigures'));
    }

    public function update(Request $request, GuessFigureQuiz $guessFigureQuiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.id' => 'nullable|exists:guess_figure_questions,id',
            'questions.*.historical_figure_id' => 'required|exists:historical_figures,id',
            'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'questions.*.hint' => 'nullable|string',
            'questions.*.correct_latitude' => 'required|numeric',
            'questions.*.correct_longitude' => 'required|numeric',
            'questions.*.order' => 'required|integer|min:0'
        ]);

        $guessFigureQuiz->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        // Delete removed questions
        $currentQuestionIds = collect($request->questions)->pluck('id')->filter();
        $guessFigureQuiz->questions()->whereNotIn('id', $currentQuestionIds)->delete();

        foreach ($request->questions as $question) {
            $questionData = [
                'historical_figure_id' => $question['historical_figure_id'],
                'hint' => $question['hint'],
                'correct_latitude' => $question['correct_latitude'],
                'correct_longitude' => $question['correct_longitude'],
                'order' => $question['order']
            ];

            if (isset($question['image'])) {
                // Delete old image if exists
                if (isset($question['id'])) {
                    $oldQuestion = GuessFigureQuestion::find($question['id']);
                    if ($oldQuestion && $oldQuestion->image) {
                        Storage::disk('public')->delete($oldQuestion->image);
                    }
                }
                $questionData['image'] = $question['image']->store('guess-figure', 'public');
            }

            if (isset($question['id'])) {
                $guessFigureQuiz->questions()->where('id', $question['id'])->update($questionData);
            } else {
                $guessFigureQuiz->questions()->create($questionData);
            }
        }

        return redirect()->route('guess-figure.index')
            ->with('success', 'Quiz berhasil diperbarui');
    }

    public function destroy(GuessFigureQuiz $guessFigureQuiz)
    {
        // Delete all question images
        foreach ($guessFigureQuiz->questions as $question) {
            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }
        }

        $guessFigureQuiz->delete();

        return redirect()->route('guess-figure.index')
            ->with('success', 'Quiz berhasil dihapus');
    }
} 