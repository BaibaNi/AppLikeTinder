<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);

        $file = file_get_contents('storage/countrylist.json');

        $countries = [];
        foreach (json_decode($file, true) as $key => $value) {
            $countries[] = $value['country'];
        }

        return view('users.edit', [
            'user' => $user,
            'countries' => $countries
        ]);
    }

    public function update(User $user)
    {
        $user = User::findOrFail($user->id);

        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'surname' => ['required', 'min:3', 'max:255'],
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'birthday' => ['required', 'before:-18 years'],
            'gender' => ['required'],
            'location' => ['required', 'min:3', 'max:255'],
        ]);

        $user->update($attributes);

        return redirect('/users/' . $user->id)->with('success', 'Your profile information is updated.');
    }

}
