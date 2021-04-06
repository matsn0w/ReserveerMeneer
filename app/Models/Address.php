<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['postal_code', 'street_name', 'house_number', 'city', 'country']; 

    use HasFactory;

    public function event_reservations() {
        $this->hasMany(EventReservation::class);
    }
    
    public function movie_reservations() {
        $this->hasMany(MovieReservation::class);
    }
    
    public function restaurant_reservation() {
        $this->hasMany(RestaurantReservation::class);
    }
}
