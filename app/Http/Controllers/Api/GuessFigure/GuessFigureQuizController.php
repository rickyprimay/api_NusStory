<?php

namespace App\Http\Controllers\Api\GuessFigure;

use App\Http\Controllers\Controller;
use App\Models\GuessFigureQuiz;
use App\Models\GuessFigureQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuessFigureQuizController extends Controller
{
    public function index()
    {
        $quizzes = GuessFigureQuiz::with('questions.historicalFigure')
            ->where('is_active', true)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $quizzes
        ]);
    }

    public function show($id)
    {
        $quiz = GuessFigureQuiz::with('questions.historicalFigure')
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $quiz
        ]);
    }

    public function checkAnswer(Request $request, $quizId, $questionId)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $question = GuessFigureQuestion::where('quiz_id', $quizId)
            ->where('id', $questionId)
            ->firstOrFail();
        
        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $question->correct_latitude,
            $question->correct_longitude
        );

        $isCorrect = $distance <= 10;

        return response()->json([
            'status' => 'success',
            'data' => [
                'is_correct' => $isCorrect,
                'distance' => $distance,
                'correct_location' => $isCorrect ? [
                    'latitude' => $question->correct_latitude,
                    'longitude' => $question->correct_longitude
                ] : null
            ]
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; 

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $latDelta = $lat2 - $lat1;
        $lonDelta = $lon2 - $lon1;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($lat1) * cos($lat2) * pow(sin($lonDelta / 2), 2)));
        
        return $angle * $earthRadius;
    }
} 