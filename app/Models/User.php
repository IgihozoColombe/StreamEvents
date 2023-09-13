<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define the relationship: a user can have many followers
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Check if the user is already following another user
    public function isFollowing(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    // Follow another user
    public function follow(User $user)
    {
        $this->followers()->attach($user->id);
    }

    // Unfollow another user
    public function unfollow(User $user)
    {
        $this->followers()->detach($user->id);
    }
}
