<?php

namespace App\Models;

use App\Models\Hall;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilmEvent extends Pivot
{
    use HasFactory;

    protected $table = 'filmevents';

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
