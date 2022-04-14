<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function create(User $user)
    {

        return view('descriptions.create', [
            'user' => $user,
        ]);
    }

    public function store(User $user, Request $request)
    {

        $description = UserDescription::all()
            ->where('user_id', '=', $user->id)
            ->first();

        if(!$description){
            UserDescription::create([
                'user_id' => $user->id,
                'description' => $request->description
            ]);
        } else{
            $description->update([
                'user_id' => $user->id,
                'description' => $request->description
            ]);
        }

        return redirect('/users/' . $user->id )->with('success', 'Description added.');
    }
}
