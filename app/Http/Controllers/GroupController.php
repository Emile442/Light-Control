<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all(['id', 'name']);

        return response()->json($groups);
    }

    public function show($id)
    {
        $group = Group::where('id', $id)->get();

        return response()->json($group->lights);
    }
}
