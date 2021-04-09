<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['postal_code', 'street_name', 'house_number', 'city', 'country']; 

    use HasFactory;

    public function reservations() {
        $this->hasMany(Reservation::class);
    }
}
