<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPreference;


class PreferenceController extends Controller
{
    public function create(User $user)
    {
        $locations = User::distinct('location')->pluck('location');

        return view('preferences.create', [
            'user' => $user,
            'locations' => $locations
        ]);
    }

    public function store(User $user)
    {

        request()->validate([
            'age' => ['required'],
            'gender' => ['required'],
            'location' => ['required', 'min:3', 'max:255']
        ]);

        $ageRange = explode(' - ', request('age'));

        $userPreference = User::findOrFail($user->id)->userPreference;

        if(!$userPreference){
            UserPreference::create([
                'user_id' => $user->id,
                'min_age' => $ageRange[0],
                'max_age' => $ageRange[1],
                'gender' => request('gender'),
                'location' => request('location')
            ]);
        } else{
            $userPreference->update([
                'min_age' => $ageRange[0],
                'max_age' => $ageRange[1],
                'gender' => request('gender'),
                'location' => request('location')
            ]);
        }

        return redirect('/users')->with('success', 'Your search preferences information is updated.');
    }

    public function clear(User $user)
    {

        UserPreference::destroy($user->userPreference->id);

        return redirect('/users')->with('success', 'Your search preferences information is cleared.');
    }

}
