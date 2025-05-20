<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\HistoricalTopics;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HistoricalTopicsController extends Controller
{
    private function convertToEmbedUrl($url)
    {
        $videoId = null;

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }

        return $videoId ? 'https://www.youtube.com/embed/' . $videoId : $url;
    }

    public function index()
    {
        $historicalTopics = HistoricalTopics::all();
        return view('pages.dashboard.historical-topics.index', compact('historicalTopics'));
    }

    public function create()
    {
        $provinces = Province::all();
        $cities = City::all();
        return view('pages.dashboard.historical-topics._partials.add', compact('provinces', 'cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'thumbnail' => 'required|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['video_url'] = $this->convertToEmbedUrl($data['video_url']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_topics', $filename, 'public');
            $data['thumbnail'] = url('storage/historical_topics/' . $filename);
        }

        HistoricalTopics::create($data);

        return redirect()->route('historical-topics.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $historicalTopic = HistoricalTopics::findOrFail($id);
        $provinces = Province::all();
        $cities = City::all();
        return view('pages.dashboard.historical-topics._partials.edit', compact('historicalTopic', 'provinces', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'thumbnail' => 'nullable|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $historicalTopic = HistoricalTopics::findOrFail($id);
        $data = $request->all();
        $data['video_url'] = $this->convertToEmbedUrl($data['video_url']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_topics', $filename, 'public');
            $data['thumbnail'] = url('storage/historical_topics/' . $filename);
        }

        $historicalTopic->update($data);

        return redirect()->route('historical-topics.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $historicalTopic = HistoricalTopics::find($id);

        if (!$historicalTopic) {
            return redirect()->route('historical-topics.index')->with('error', 'Data tidak ditemukan.');
        }

        $historicalTopic->delete();

        return redirect()->route('historical-topics.index')->with('success', 'Data berhasil dihapus.');
    }
}
