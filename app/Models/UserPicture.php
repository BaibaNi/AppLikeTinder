<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'picture',
        'small_picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
