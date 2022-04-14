<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'match_id',
        'is_match'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
