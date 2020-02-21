<?php

namespace App\Http\Controllers;

use App\Zigbee\ZigbeeApi;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index()
    {
        $deconzLights = (new ZigbeeApi())->getLights();

        return view('network.index', compact('deconzLights'));
    }
}
