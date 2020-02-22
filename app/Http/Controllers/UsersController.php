<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'api_token' => Str::random(80),
            'admin' => $request->get('admin'),
            'suspend' => $request->get('suspend')
        ]);
        return redirect(route('users.index'))->with('success', "{$user->name} has been created.");
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->only('name', 'email', 'suspend', 'admin'));

        return redirect(route('users.edit', $user))->with('success', "{$user->name} has been edited.");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', "{$user->name} has been created.");
    }
}
