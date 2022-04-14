<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'birthday',
        'gender',
        'location',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function userPicture()
    {
        return $this->hasOne(UserPicture::class);
    }

    public function userMatch()
    {
        return $this->hasMany(UserMatch::class);
    }

    public function userDislike()
    {
        return $this->hasMany(UserDislike::class);
    }

    public function userImage()
    {
        return $this->hasMany(UserImage::class);
    }

    public function userPreference()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function userDescription()
    {
        return $this->hasOne(UserDescription::class);
    }
}
