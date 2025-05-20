<?php

namespace App\Http\Controllers\Api\Historical;

use App\Http\Controllers\Controller;
use App\Models\HistoricalFigures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\HistoricalFigureResource;

class HistoricalFigureController extends Controller
{
    private function convertToEmbedUrl($url)
    {
        $videoId = null;
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }
        if ($videoId) {
            return 'https://www.youtube.com/embed/' . $videoId;
        }
        return $url;
    }

    public function index()
    {
        $figures = HistoricalFigures::with(['province', 'city'])->get();
        return response()->json([
            'success' => true,
            'message' => 'Historical Figures Retrieved Successfully',
            'data' => HistoricalFigureResource::collection($figures),
        ], 200);
    }

    public function getById($id)
    {
        $figure = HistoricalFigures::with(['province', 'city'])->find($id);
        if (!$figure) {
            return response()->json([
                'success' => false,
                'message' => 'Historical Figure Not Found',
                'data' => [],
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Historical Figure Get By Id Retrieved Successfully',
            'data' => new HistoricalFigureResource($figure),
        ], 200);
    }

    public function getBySlug($slug)
    {
        $figure = HistoricalFigures::with(['province', 'city'])->where('slug', $slug)->first();
        return response()->json([
            'success' => true,
            'message' => 'Historical Figure Get By Slug Retrieved Successfully',
            'data' => new HistoricalFigureResource($figure),
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'born_year' => 'required|integer',
            'died_year' => 'required|integer',
            'thumbnail' => 'required|file|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $data['video_url'] = $this->convertToEmbedUrl($data['video_url']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_figures', $filename, 'public');
            $data['thumbnail'] = url('storage/historical_figures/' . $filename);
        }

        $figure = HistoricalFigures::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Historical Figure Created Successfully',
            'data' => $figure,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'born_year' => 'required|integer',
            'died_year' => 'required|integer',
            'thumbnail' => 'nullable|file|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 400);
        }

        $figure = HistoricalFigures::find($id);
        if (!$figure) {
            return response()->json([
                'success' => false,
                'message' => 'Historical Figure Not Found',
                'data' => [],
            ], 404);
        }

        $data = $request->all();
        $data['video_url'] = $this->convertToEmbedUrl($data['video_url']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_figures', $filename, 'public');
            $data['thumbnail'] = url('storage/historical_figures/' . $filename);
        }

        $figure->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Historical Figure Updated Successfully',
            'data' => $figure,
        ], 200);
    }

    public function destroy($id)
    {
        $figure = HistoricalFigures::find($id);
        if (!$figure) {
            return response()->json([
                'success' => false,
                'message' => 'Historical Figure Not Found',
                'data' => [],
            ], 404);
        }

        $figure->delete();

        return response()->json([
            'success' => true,
            'message' => 'Historical Figure Deleted Successfully',
        ], 200);
    }
}
