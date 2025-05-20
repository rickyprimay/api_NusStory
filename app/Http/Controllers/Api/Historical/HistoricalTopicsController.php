<?php

namespace App\Http\Controllers\Api\Historical;

use App\Http\Controllers\Controller;
use App\Models\HistoricalTopics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HistoricalTopicsController extends Controller
{
    public function index()
    {
        $historicalTopics = HistoricalTopics::all();

        return response()->json([
            'success'   => true,
            'message'   => 'Historical Topics Retrieved Successfully',
            'data'      => $historicalTopics
        ], 200);
    }

    public function getById($id)
    {
        $historicalTopic = HistoricalTopics::find($id);

        if (!$historicalTopic) {
            return response()->json([
                'success'   => false,
                'message'   => 'Historical Topic Not Found',
                'data'      => []
            ], 404);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Historical Topic Get By Id Retrieved Successfully',
            'data'      => $historicalTopic
        ], 200);
    }

    public function getBySlug($slug)
    {
        $historicalTopic = HistoricalTopics::where('slug', $slug)->first();

        return response()->json([
            'success'   => true,
            'message'   => 'Historical Topic Get By Slug Retrieved Successfully',
            'data'      => $historicalTopic
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'thumbnail' => 'required',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Validation Error',
                'data'      => $validator->errors()
            ], 400);
        }

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        $historicalTopic = HistoricalTopics::create($data);

        return response()->json([
            'success'   => true,
            'message'   => 'Historical Topic Created Successfully',
            'data'      => $historicalTopic
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'thumbnail' => 'required',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Validation Error',
                'data'      => $validator->errors()
            ], 400);
        }

        $historicalTopic = HistoricalTopics::find($id);

        if (!$historicalTopic) {
            return response()->json([
                'success'   => false,
                'message'   => 'Historical Topic Not Found',
                'data'      => []
            ], 404);
        }

        $historicalTopic->update($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Historical Topic Updated Successfully',
            'data'      => $historicalTopic
        ], 200);
    }

    public function destroy($id)
    {
        $historicalTopic = HistoricalTopics::find($id);

        if (!$historicalTopic) {
            return response()->json([
                'success'   => false,
                'message'   => 'Historical Topic Not Found',
                'data'      => []
            ], 404);
        }

        $historicalTopic->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Historical Topic Deleted Successfully',
            'data'      => []
        ], 200);
    }
    
}
