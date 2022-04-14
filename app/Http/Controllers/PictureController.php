<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PictureController extends Controller
{
    public function create(User $user)
    {
        $user = User::findOrFail($user->id);

        return view('pictures.create', ['user' => $user]);
    }


    public function store(Request $request)
    {

        $userPicture = UserPicture::all()->where('user_id','=', $request->id)->first();
        Storage::disk('public')->delete([$userPicture->picture, $userPicture->small_picture]);

        request()->validate([
            'picture' => ['required']
        ]);

        $path = $request->file('picture')->store('pictures/'. auth()->user()->id, 'public');

        $pictureName = explode('/', $path);

        $smallPicture = Image::make($request->file('picture'))
            ->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save('storage/pictures/' . $request->id . '/small_' . $pictureName[2]);

        $smallPath = explode('/', $smallPicture->basePath());
        unset($smallPath[0]);
        $smallPath = implode('/', $smallPath);


        $userPicture->update([
            'picture' => $path,
            'small_picture' => $smallPath,
        ]);

        return redirect('/users/' . $request->id . '/edit')->with('success', 'Your profile picture is changed.');

    }

}
