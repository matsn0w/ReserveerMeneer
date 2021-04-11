<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantCategory extends Model
{
    use HasFactory;

    public function values() {
        return RestaurantCategory::whereNotNull('id');
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
