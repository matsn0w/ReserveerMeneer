<?php

namespace App\Models;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seat extends Model
{
    use HasFactory;

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function filmeventreservations() {
        return $this->belongsToMany(FilmEventReservation::class, 'filmevent_reservation_seat', 'seat_id', 'filmevent_reservation_id');
    }
}
