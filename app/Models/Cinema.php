<?php

namespace App\Models;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\FilmEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function halls() {
        return $this->hasMany(Hall::class);
    }

    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
