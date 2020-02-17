<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect(route('users.index'))->with('success', "{$user->name} has been created.");
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->only('name', 'email'));
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->get('password'));
            $user->save();
        }

        return redirect(route('users.index'))->with('success', "{$user->name} has been edited.");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $username = $user->name;
        $user->delete();
        return redirect(route('users.index'))->with('success', "{$username} has been created.");
    }

}
