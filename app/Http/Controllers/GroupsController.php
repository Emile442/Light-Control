<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::with('lights')->get();

        return view('groups.index', compact('groups'));
    }

    public function store(GroupRequest $request)
    {
        $group = Group::create($request->all());
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been created.");
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->all());
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been updated.");
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been deleted.");
    }

}
