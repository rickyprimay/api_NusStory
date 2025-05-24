<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StoryProvince;
use Illuminate\Http\Request;

class StoryProvinceController extends Controller
{
    public function index()
    {
        $provinces = StoryProvince::with('details')->get();
        return view('pages.dashboard.story-province.index', compact('provinces'));
    }

    public function show($id)
    {
        $province = StoryProvince::with('details')->findOrFail($id);
        return view('pages.dashboard.story-province.show', compact('province'));
    }
}
