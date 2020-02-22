<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Zigbee\ZigbeeApi;

class NetworkController extends Controller
{
    public function index()
    {
        $lights = (new ZigbeeApi())->getLights();
        if (!$lights)
            return response()->json(['errors' => [' Connection problem with the bridge']])->setStatusCode(504);
        return response()->json($lights);
    }
}
