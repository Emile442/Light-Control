<?php

namespace App\Http\Controllers;

use App\Zigbee\DeconzApi;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index()
    {
        $deconzLights = (new DeconzApi())->getLights();

        return view('network.index', compact('deconzLights'));
    }
}
