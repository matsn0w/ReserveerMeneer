<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantReservation extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'address_id', 'date', 'time', 'groupsize'];

    public function addresses() {
        return $this->belongsTo(Address::class);
    }

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }
}
