<?php

namespace App\Models;

use DateTime;
use DateInterval;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Cinema;
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

    public function hall() {
        return $this->belongsTo(Hall::class);
    }

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function unified_date() {
        return date('Y-m-d', strtotime($this->start));
    }

    public function endTime()
    {
        $start = new DateTime($this->start);
        $start->add(new DateInterval('PT' . $this->movie->duration . 'M'));

        return $start->format('d-m-Y H:i');
    }
}
