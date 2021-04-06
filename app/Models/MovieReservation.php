<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieReservation extends Model
{
    use HasFactory;

    public function addresses() {
        return $this->belongsTo(Address::class);
    }

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }
}