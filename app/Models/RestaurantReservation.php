<?php

namespace App\Models;

use App\Models\FilmEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantReservation extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'date', 'time', 'groupsize'];

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}
