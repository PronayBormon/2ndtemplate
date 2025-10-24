<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role",
        "phone",
        "address",
        "avatar",
        "date_of_birth",
        "gender",
        "bio",
        "facebook_url",
        "twitter_url",
        "linkedin_url",
        "instagram_url",
        "website",
        "status",
        'reset_password_token',
        'reset_password_token_exp',
        "last_login_at",
        "last_login_ip",
        "business_category",
        "business_name",
    ];


    public function getAvatarAttribute($value)
    {
        // if (filter_var($value, FILTER_VALIDATE_URL)) {
        //     return $value;
        // }
        if (request()->is('api/*') && !empty($value)) {
            return url($value);
        }
        return $value;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'reset_password_token',
        'reset_password_token_exp',
    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
