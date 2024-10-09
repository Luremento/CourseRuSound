<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'track_id',
    ];

    /*
    * Связываем с таблицей tracks
    */
    public function track() {
        return $this->belongsTo(Track::class);
    }

    /*
    * Связываем с таблицей users
    */
    public function user() {
        return $this->belongsTo(User::class);
    }

}
