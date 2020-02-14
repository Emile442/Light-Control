<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    public function store(Request $request)
    {
        $group = Group::create($request->only('name'));

        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been created.");
    }

    public function edit($id)
    {
        $group = Group::find($id);

        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->name = $request->get('name');
        $group->save();
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been updated.");
    }

    public function destroy($id)
    {
        $group = Group::find($id);

        $group->delete();
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been deleted.");
    }

}
