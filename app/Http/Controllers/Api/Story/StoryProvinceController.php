<?php

namespace App\Http\Controllers\Api\Story;

use App\Http\Controllers\Controller;
use App\Models\StoryProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class StoryProvinceController extends Controller
{
    public function index()
    {
        $provinces = StoryProvince::with('details')->get();
        return response()->json([
            'status' => 'success',
            'data' => $provinces
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'subtitle' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);

        $province = StoryProvince::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Province created successfully',
            'data' => $province
        ], 201);
    }

    public function show($id)
    {
        $province = StoryProvince::with('details')->find($id);
        
        if (!$province) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $province
        ]);
    }

    public function showBySlug($slug)
    {
        $province = StoryProvince::with('details')->where('slug', $slug)->first();
        
        if (!$province) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $province
        ]);
    }

    public function update(Request $request, $id)
    {
        $province = StoryProvince::find($id);
        
        if (!$province) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'subtitle' => 'string',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $province->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Province updated successfully',
            'data' => $province
        ]);
    }

    public function destroy($id)
    {
        $province = StoryProvince::find($id);
        
        if (!$province) {
            return response()->json([
                'status' => 'error',
                'message' => 'Province not found'
            ], 404);
        }

        $province->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Province deleted successfully'
        ]);
    }
} 