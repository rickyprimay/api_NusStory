<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StoryProvinceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryProvinceDetailController extends Controller
{
    public function create(Request $request)
    {
        $province_id = $request->province_id;
        return view('pages.dashboard.story-province.detail.create', compact('province_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitle' => 'required|string',
            'story_province_id' => 'required|exists:story_provinces,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('province_details', $filename, 'public');
            $data['image'] = url('storage/province_details/' . $filename);
        }

        StoryProvinceDetail::create($data);

        return redirect()->route('dashboard.story-provinces.show', $request->story_province_id)
            ->with('success', 'Detail provinsi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $detail = StoryProvinceDetail::findOrFail($id);
        return view('pages.dashboard.story-province.detail.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = StoryProvinceDetail::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitle' => 'required|string',
            'story_province_id' => 'required|exists:story_provinces,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
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

        return redirect()->route('dashboard.story-provinces.show', $detail->story_province_id)
            ->with('success', 'Detail provinsi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $detail = StoryProvinceDetail::findOrFail($id);
        $province_id = $detail->story_province_id;

        // Delete image file
        if ($detail->image) {
            $imagePath = str_replace(url('storage/'), 'public/', $detail->image);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $detail->delete();

        return redirect()->route('dashboard.story-provinces.show', $province_id)
            ->with('success', 'Detail provinsi berhasil dihapus');
    }
} 