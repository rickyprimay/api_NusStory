<?php

namespace App\Http\Controllers\Api\Story;

use App\Http\Controllers\Controller;
use App\Models\StoryProvinceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitle' => 'required|string',
            'story_province_id' => 'required|exists:story_provinces,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('province_details', $filename, 'public');
            $data['image'] = url('storage/province_details/' . $filename);
        }

        $detail = StoryProvinceDetail::create($data);

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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitle' => 'string',
            'story_province_id' => 'exists:story_provinces,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($detail->image) {
                $oldImagePath = str_replace(url('storage/'), 'public/', $detail->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('province_details', $filename, 'public');
            $data['image'] = url('storage/province_details/' . $filename);
        }

        $detail->update($data);

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

        // Delete image file if exists
        if ($detail->image) {
            $imagePath = str_replace(url('storage/'), 'public/', $detail->image);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $detail->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Province detail deleted successfully'
        ]);
    }
} 