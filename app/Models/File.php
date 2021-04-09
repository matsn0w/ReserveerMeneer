<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'url'];

    public function eventreservations() {
        return $this->hasMany(EventReservation::class);
    }
}
