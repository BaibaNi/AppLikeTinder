<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItIsMatch extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private User $user;

    public $subject = 'You have a match!';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.is-match', [
            'user' => $this->user
        ]);
    }
}
