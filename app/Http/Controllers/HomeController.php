<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lastJob = Job::latest()->first();

        return view('home.index', compact("lastJob"));
    }
}
