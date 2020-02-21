<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->get('term');

        return User::select('name', 'id')
            ->where('name', 'LIKE', $term . '%')
            ->get()
            ->map(function ($user) {
                return ['value' => $user->name, 'id' => $user->id];
            });
    }

}
