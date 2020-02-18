<?php

namespace App\Http\Controllers;

use App\Light;
use App\Zigbee\DeconzApi;
use Illuminate\Http\Request;

class LightsController extends Controller
{
    public function index()
    {
        $lights = Light::with('group')->get();

        return view('lights.index', compact('lights'));
    }

    public function store(Request $request)
    {
        $light = Light::create($request->only('name', 'networkId', 'group_id'));
        return redirect()->route('lights.index')->with('success', "The Light {$light->name} has been created.");
    }

    public function edit($id)
    {
        $light = Light::find($id);
        return view('lights.edit', compact('light'));
    }

    public function update(Request $request, $id)
    {
        $light = Light::find($id);
        $light->name = $request->get('name');
        $light->group_id = $request->get('group_id');
        $light->networkId = $request->get('networkId');
        $light->save();
        return redirect()->route('lights.index')->with('success', "The Light {$light->name} has been updated.");
    }

    public function destroy($id)
    {
        $light = Light::find($id);
        $light->delete();
        return redirect()->route('lights.index')->with('success', "The Light has been deleted.");
    }
}
