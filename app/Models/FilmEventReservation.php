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

    protected $table = 'filmevent_reservations';
    protected $fillable = ['filmevent_id']; 

    public function addresses() {
        return $this->belongsTo(Address::class);
    }

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }

    public function filmevent() {
        return $this->belongsTo(FilmEvent::class);
    }

    public function seats() {
        return $this->belongsToMany(Seat::class, 'filmevent_reservation_seat', 'filmevent_reservation_id', 'seat_id');
    }
}
