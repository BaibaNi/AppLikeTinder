<?php

namespace App\Http\Controllers;

use App\Models\User;

class PasswordChangeController extends Controller
{

    public function create(User $user)
    {
        $user = User::findOrFail($user->id);

        return view('password.change-password', [
            'user' => $user
        ]);
    }

    public function store(User $user)
    {

        $user = User::findOrFail($user->id);

        $attributes = request()->validate([
            'password' => ['required', 'string', 'confirmed', 'min:8']
        ]);

        $user->update($attributes);

        return redirect('/users/' . $user->id . '/edit')->with('success', 'Your password is changed.');

    }
}
