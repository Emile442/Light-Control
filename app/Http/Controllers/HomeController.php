<?php

namespace App\Http\Controllers;

use App\Timer;

class HomeController extends Controller
{
    public function index()
    {
        $timers = Timer::with('job')->with('group')->get();
        return view('home.index', compact('timers'));
    }
}
