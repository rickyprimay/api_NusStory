<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoricalFigureController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.historical-figure.index');
    }
}
