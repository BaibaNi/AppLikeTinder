<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserDislike;
use App\Models\UserImage;
use App\Models\UserMatch;
use App\Models\UserPicture;
use App\Models\UserPreference;
use Carbon\Carbon;


class UserController extends Controller
{
    public function home()
    {

        if(auth()->user()) {
            $allLikes = UserMatch::all()
                ->where('is_match', '=' , false)
                ->where('user_id', '=' , auth()->user()->id)
                ->all();

            $allMatches = UserMatch::all()
                ->where('is_match', '=' , true)
                ->all();

            $allDislikes = UserDislike::all()
                ->where('user_id', '=' , auth()->user()->id)
                ->all();


            $notToShowIds = [];
            foreach ($allLikes as $like){
                $notToShowIds[] = $like['match_id'];
            }

            foreach ($allMatches as $match){
                if($match['user_id'] === auth()->user()->id){
                    $notToShowIds[] = $match['match_id'];
                } elseif ($match['match_id'] === auth()->user()->id){
                    $notToShowIds[] = $match['user_id'];
                }
            }

            foreach ($allDislikes as $dislike){
                $userPicture = UserPicture::all()
                    ->where('user_id', '=', $dislike->dislike_id)
                    ->first();

                $dislikeDate = Carbon::parse($dislike->created_at->format('Y-m-d H:m:s'))->timestamp;
                $pictureUpdateDate = Carbon::parse($userPicture->updated_at->format('Y-m-d H:m:s'))->timestamp;

                if($pictureUpdateDate > $dislikeDate){

                    UserDislike::destroy($dislike->id);
                }

                $notToShowIds[] = $dislike->dislike_id;
            }


            $preference = UserPreference::all()
                ->where('user_id', '=', auth()->user()->id)->first();


            $allUsers = User::all()->sortByDesc('updated_at')->all();

            $users = [];
            foreach ($allUsers as $user){
                if(!in_array($user->id, $notToShowIds)){

                    if(!empty($preference)){
                        if(($user->age > $preference->min_age && $user->age < $preference->max_age)
                            && ($preference->location === $user->location)
                            && ($preference->gender === $user->gender || $preference->gender === 'Both')){
                            $users[] = $user;
                        }
                    } else{
                        $users[] = $user;
                    }

                }
            }

            return view('home', [
                'users' => $users
            ]);
        } else{

            return view('home');
        }
    }


    public function show(User $user)
    {
        $user = User::findOrFail($user->id);

        $images = UserImage::all()
            ->where('user_id', '=', $user->id)
            ->all();

        $allMatches = $user->userMatch()
            ->where('is_match', '=', true)
            ->get();

        $matches = [];
        foreach ($allMatches as $match) {
            if ($match->user_id === auth()->user()->id || $match->match_id === auth()->user()->id) {
                $matches[] = $match;
            }
        }

        return view('users.show', [
            'user' => $user,
            'images' => $images,
            'matches' => $matches
        ]);
    }

}
