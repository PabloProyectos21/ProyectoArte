<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'profile_picture',
        'description',
        'is_premium',
        'is_private',
        'user_permission_level',

    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
    // app/Models/User.php

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

// Usuarios que este usuario sigue
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }
// User.php
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }
    public function favoritePublications()
    {
        return $this->belongsToMany(Publication::class, 'user_publication_favorite')->withTimestamps();
    }


    public function isFollowing(User $user): bool
    {
        return $this->following->contains($user);
    }




}
