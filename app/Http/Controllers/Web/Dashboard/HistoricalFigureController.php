<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoricalFigures;
use App\Models\Province;
use App\Models\City;
use App\Helpers\ConvertToEmbed;
use App\Models\Categories;
use Illuminate\Support\Str;

class HistoricalFigureController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $figures = HistoricalFigures::with(['province', 'city'])->paginate(10);
        return view('pages.dashboard.historical-figure.index', compact('figures', 'categories'));
    }

    public function create()
    {
        $categories = Categories::all();
        $provinces = Province::all();
        return view('pages.dashboard.historical-figure._partials.add', compact('provinces', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'born_year' => 'required|integer',
            'died_year' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['video_url'] = ConvertToEmbed::youtube($validated['video_url']);
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_figures', $filename, 'public');
            $validated['thumbnail'] = url('storage/historical_figures/' . $filename);
        }

        HistoricalFigures::create($validated);
        return redirect()->route('historical-figure.index')->with('success', 'Tokoh berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $figure = HistoricalFigures::findOrFail($id);
        $provinces = Province::all();
        $categories = Categories::all();
        $cities = City::where('province_id', $figure->province_id)->get();
        return view('pages.dashboard.historical-figure._partials.edit', compact('figure', 'provinces', 'cities', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $figure = HistoricalFigures::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'born_year' => 'required|integer',
            'died_year' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['video_url'] = ConvertToEmbed::youtube($validated['video_url']);
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_figures', $filename, 'public');
            $validated['thumbnail'] = url('storage/historical_figures/' . $filename);
        }
        $figure->update($validated);
        return redirect()->route('historical-figure.index')->with('success', 'Tokoh berhasil diupdate!');
    }

    public function destroy($id)
    {
        $figure = HistoricalFigures::findOrFail($id);
        $figure->delete();
        return redirect()->route('historical-figure.index')->with('success', 'Tokoh berhasil dihapus!');
    }

    public function show($id)
    {
        $figure = HistoricalFigures::with(['province', 'city'])->findOrFail($id);
        return view('pages.dashboard.historical-figure.show', compact('figure'));
    }
}
