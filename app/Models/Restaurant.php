<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category', 'seats'];

    public function openinghours() {
        return $this->hasMany(RestaurantOpeninghours::class);
    }
}
