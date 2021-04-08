<?php

namespace App\Models;

use App\Models\Seat;
use App\Models\Address;
use App\Models\FilmEvent;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilmEventReservation extends Model
{
    use HasFactory;

    public function addresses() {
        return $this->belongsTo(Address::class);
    }

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }

    public function filmevent() {
        return $this->hasOne(FilmEvent::class);
    }

    public function seat() {
        return $this->hasOne(Seat::class);
    }
}
