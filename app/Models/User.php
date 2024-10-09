<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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

    /*
    * Связываем с таблицей tracks
    */
    public function tracks() {
        return $this->hasMany(Track::class);
    }

    /*
    * Связываем с таблицей comments
    */
    public function comment() {
        return $this->hasMany(Comment::class);
    }

    /*
    * Связываем с таблицей likes
    */
    public function likes() {
        return $this->hasMany(Like::class);
    }

    /*
    * Связываем с таблицей albom
    */
    public function albom()
    {
        return $this->hasMany(Albom::class);
    }

}
