<?php

namespace App\Http\Controllers\Api\Story;

use App\Http\Controllers\Controller;
use App\Models\StoryProvinceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoryProvinceDetailController extends Controller
{
    public function index()
    {
        $details = StoryProvinceDetail::with('province')->get();
        return response()->json([
            'status' => 'success',
            'data' => $details
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|string',
            'subtitle' => 'required|string',
            'story_province_id' => 'required|exists:story_provinces,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $detail = StoryProvinceDetail::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Province detail created successfully',
            'data' => $detail
        ], 201);
    }

    public function show($id)
    {
        $detail = StoryProvinceDetail::with('province')->find($id);
        
        if (!$detail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province detail not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $detail = StoryProvinceDetail::find($id);
        
        if (!$detail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province detail not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'image' => 'string',
            'subtitle' => 'string',
            'story_province_id' => 'exists:story_provinces,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $detail->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Province detail updated successfully',
            'data' => $detail
        ]);
    }

    public function destroy($id)
    {
        $detail = StoryProvinceDetail::find($id);
        
        if (!$detail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province detail not found'
            ], 404);
        }

        $detail->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Province detail deleted successfully'
        ]);
    }
} 