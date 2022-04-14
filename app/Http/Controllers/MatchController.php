<?php

namespace App\Http\Controllers;

use App\Mail\ItIsMatch;
use App\Models\User;
use App\Models\UserDislike;
use App\Models\UserMatch;
use Illuminate\Support\Facades\Mail;

class MatchController extends Controller
{
    /**
     * When person is matched, notification is sent out to both users (goes through the job queue)
    */
    public function like(User $user)
    {
        $likes = UserMatch::all()
            ->where('match_id', '=', auth()->user()->id)
            ->where('user_id', '=', $user->id)
            ->all();

        if(!empty($likes)){
            foreach ($likes as $like){
                if($like['user_id'] === $user->id){

                    $attributes = [
                        'is_match' => true
                    ];

                    $like->update($attributes);

                    Mail::to(User::findOrFail($like['user_id'])->email)
                        ->send(new ItIsMatch(User::findOrFail($like['user_id'])));

                    Mail::to(User::findOrFail($like['match_id'])->email)
                        ->send(new ItIsMatch(User::findOrFail($like['match_id'])));

                    return redirect('/users')->with('success', "❤ It's a match! ❤");

                } else{
                    $attributes = [
                        'user_id' => auth()->user()->id,
                        'match_id' => $user->id,
                        'is_match' => false
                    ];

                    UserMatch::create($attributes);

                    return redirect('/users')->with('success', '❤');
                }
            }
        } else{
            $attributes = [
                'user_id' => auth()->user()->id,
                'match_id' => $user->id,
                'is_match' => false
            ];

            UserMatch::create($attributes);

            return redirect('/users')->with('success', '❤');
        }

    }


    public function dislike(User $user)
    {
        $attributes = [
            'user_id' => auth()->user()->id,
            'dislike_id' => $user->id
        ];

        UserDislike::create($attributes);

        return redirect('/users')->with('success', '💔');

    }


    public function index(User $user)
    {
        $allMatches = UserMatch::all()
            ->where('is_match', '=', true)
            ->sortByDesc('updated_at');

        $matches = [];
        foreach ($allMatches as $match){
            if($match->user_id === auth()->user()->id || $match->match_id === auth()->user()->id){
                $matches[] = $match;
            }
        }


        $users = [];
        foreach ($allMatches as $match){

            if($match['user_id'] === $user->id){
                $matchedUser = User::findOrFail($match['match_id']);
                $users[] = $matchedUser;

            } elseif($match['match_id'] === $user->id){
                $matchedUser = User::findOrFail($match['user_id']);
                $users[] = $matchedUser;
            }
        }

        return view('users.match', [
            'users' => $users,
            'matches' => $matches
        ]);
    }
}

