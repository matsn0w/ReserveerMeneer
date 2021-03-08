<?php

namespace App\Models;

use App\Models\RestaurantCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'seats'];

    public function category() {
        return $this->belongsTo(RestaurantCategory::class, 'category_id');
    }

    public function openinghours() {
        return $this->hasMany(RestaurantOpeninghours::class);
    }
}
