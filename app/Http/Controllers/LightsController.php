<?php

namespace App\Http\Controllers;

use App\Http\Requests\LightRequest;
use App\Light;

class LightsController extends Controller
{
    public function index()
    {
        $lights = Light::with('groups')->get();
        return view('lights.index', compact('lights'));
    }

    public function store(LightRequest $request)
    {
        $light = Light::create($request->all());
        return redirect()->route('lights.index')->with('success', "The Light {$light->name} has been created.");
    }

    public function edit(Light $light)
    {
        return view('lights.edit', compact('light'));
    }

    public function update(LightRequest $request, Light $light)
    {
        $light->update($request->all());
        return redirect()->route('lights.index')->with('success', "The Light {$light->name} has been updated.");
    }

    public function destroy(Light $light)
    {
        $light->delete();
        return redirect()->route('lights.index')->with('success', "The Light {$light->name} has been deleted.");
    }
}
