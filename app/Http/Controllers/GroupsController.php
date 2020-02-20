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
        $group->saveLights($this->parseTagify($request->get('lights')));
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been created.");
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->saveLights($this->parseTagify($request->get('lights')));
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been updated.");
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success', "The Group {$group->name} has been deleted.");
    }

    private function parseTagify(string $str): string
    {
        $tmp = [];
        foreach (json_decode($str) as $item)
            $tmp[] = $item->value;
        return implode(',', $tmp);
    }
}
