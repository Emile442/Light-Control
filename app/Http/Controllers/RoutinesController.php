<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoutineRequest;
use App\Routine;

class RoutinesController extends Controller
{
    public function index()
    {
        $routines = Routine::all();

        return view('routines.index', compact('routines'));
    }

    public function store(RoutineRequest $request)
    {
        $routine = Routine::create($request->all());
        $routine->saveGroups($this->parseTagify($request->get('groups')));
        return redirect()->route('routines.index')->with('success', "The Routine {$routine->name} has been created.");
    }

    public function edit(Routine $routine)
    {
        return view('routines.edit', compact('routine'));
    }

    public function update(RoutineRequest $request, Routine $routine)
    {
        $routine->update($request->all());
        $routine->saveGroups($this->parseTagify($request->get('groups')));
        return redirect()->route('routines.index')->with('success', "The Routine {$routine->name} has been updated.");
    }

    public function destroy($id)
    {
        $routine = Routine::findOrFail($id);
        $routine->delete();
        return redirect()->route('routines.index')->with('success', 'The Routine has been deleted.');
    }

    private function parseTagify(string $str): string
    {
        $tmp = [];
        foreach (json_decode($str) as $item)
            $tmp[] = $item->value;
        return implode(',', $tmp);
    }
}
