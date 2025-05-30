<?php

namespace App\Http\Controllers\Api\Historical;

use App\Helpers\ConvertToEmbed;
use App\Http\Controllers\Controller;
use App\Models\HistoricalFigures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\HistoricalFigureResource;

class HistoricalFigureController extends Controller
{
    public function index()
    {
        $figures = HistoricalFigures::with(['province', 'city'])->paginate(10);
        $data = HistoricalFigureResource::collection($figures)->response()->getData(true);
        return response()->json([
            'success' => true,
            'message' => 'Historical Figures Retrieved Successfully',
            'data' => $data['data'],
            'links' => $data['links'],
            'meta' => $data['meta'],
        ]);
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
        $data['video_url'] = ConvertToEmbed::youtube($data['video_url']);

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
        $data['video_url'] = ConvertToEmbed::youtube($data['video_url']);

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
