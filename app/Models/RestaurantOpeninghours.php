<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOpeninghours extends Model
{
    use HasFactory;

    protected $fillable = ['weekday', 'openingtime', 'closingtime', 'restaurant_id'];

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}
