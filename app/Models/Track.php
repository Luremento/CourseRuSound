<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'genre',
        'music_file',
        'cover_file',
    ];

    /*
    * Связываем с таблицей users
    */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /*
    * Связываем с таблицей comments
    */
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    /*
    * Связываем с таблицей likes
    */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
