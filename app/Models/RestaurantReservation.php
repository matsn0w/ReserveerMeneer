<?php

namespace App\Models;

use App\Models\FilmEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieReserrvation extends Model
{
    use HasFactory;

    protected $fillable = [
        'filmevent_id'
    ];

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }

    public function filmevent() {
        return $this->belongsTo(FilmEvenót::class);
    }
}
