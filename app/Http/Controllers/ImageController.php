<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $images = $request->file('image');

        foreach ($images as $image){
            $path = $image->store('images/'. $request->id, 'public');

            $pictureName = explode('/', $path);
            $smallPicture = Image::make($image)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save('storage/images/' . $request->id . '/small_' . $pictureName[2]);

            $smallPath = explode('/', $smallPicture->basePath());
            unset($smallPath[0]);
            $smallPath = implode('/', $smallPath);

            $attributes = [
                'user_id' => $request->id,
                'image' => $path,
                'small_image' => $smallPath
            ];

            UserImage::create($attributes);
        }

        return redirect('/users/' . $request->id )->with('success', 'Your images are uploaded.');
    }


    public function delete(User $user, UserImage $userImage)
    {
        // delete from the storage
        $image = UserImage::findOrFail($userImage->id);
        Storage::disk('public')->delete([$image->image, $image->small_image]);


        // delete from the database table
        UserImage::destroy($userImage->id);

        return redirect('/users/' . $user->id )->with('success', 'Image deleted.');
    }
}
