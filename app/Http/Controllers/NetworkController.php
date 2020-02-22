<?php

namespace App\Http\Controllers;

use App\Jobs\NetworkImportJob;
use App\Zigbee\ZigbeeApi;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index()
    {
        return view('network.index');
    }

    public function import(Request $request)
    {
        NetworkImportJob::dispatch($request->get('lights'));
        return redirect()->route('network.index')->with('success', 'Please wait a couple minutes during import.');
    }
}
