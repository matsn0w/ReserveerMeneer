<?php

namespace App\Models;

use App\Models\Hall;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilmEvent extends Model
{
    use HasFactory;

    protected $table = 'filmevents';

    protected $fillable = [
        'hall_id',
        'movie_id',
        'start'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
