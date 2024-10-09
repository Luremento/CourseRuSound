<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albom extends Model
{
    use HasFactory;

    protected $casts = [
        'music' => 'json',
    ];

    protected $fillable = [
        'user_id',
        'music',
        'name',
        'cover_file'
    ];
    /*
    * Связываем с таблицей users
    */
    public function user() {
        return $this->belongsTo(User::class);
    }

}
