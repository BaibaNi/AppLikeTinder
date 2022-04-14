<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPicture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    public function create()
    {
        $file = file_get_contents('storage/countrylist.json');

        $countries = [];
        foreach (json_decode($file, true) as $key => $value) {
            $countries[] = $value['country'];
        }

        return view('register.create', [
            'countries' => $countries
        ]);
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'surname' => ['required', 'min:3', 'max:255'],
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'birthday' => ['required', 'before:-18 years'],
            'gender' => ['required'],
            'location' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        request()->validate([
            'picture' => ['required']
        ]);

        $path = $request->file('picture')->store('pictures/' . $request->id, 'public');

        $pictureName = explode('/', $path);

        $smallPicture = Image::make($request->file('picture'))
            ->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save('storage/pictures/' . $request->id . '/small_' . $pictureName[2]);

        $smallPath = explode('/', $smallPicture->basePath());
        unset($smallPath[0]);
        $smallPath = implode('/', $smallPath);


        $user = User::create($attributes);

        $lastUserId = User::orderBy('created_at', 'desc')->first()->id;

        UserPicture::create([
            'user_id' => $lastUserId,
            'picture' => $path,
            'small_picture' => $smallPath
            ]);

        auth()->login($user);

        return redirect('/users/'. auth()->user()->id)->with('success', 'Your account has been created.');
    }
}
