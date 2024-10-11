<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'albom_id', 'track_id'];

    /*
    * Связываем с таблицей users
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    * Связываем с таблицей alboms
    */
    public function albom()
    {
        return $this->belongsTo(Albom::class);
    }

    /*
    * Связываем с таблицей track
    */
    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
