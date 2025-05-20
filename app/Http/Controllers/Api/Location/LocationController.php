<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvince()
    {
        $provinces = Province::all();

        return response()->json([
            'success'   => true,
            'message'   => 'Province Retrieved Successfully',
            'data'      => $provinces
        ], 200);
    }

    public function getCity($id)
    {
        $cities = City::where('province_id', $id)->get();

        return response()->json([
            'success'   => true,
            'message'   => 'City Retrieved Successfully',
            'data'      => $cities
        ], 200);
    }
}
