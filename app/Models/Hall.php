<?php

namespace App\Models;

use App\Models\Seat;
use App\Models\Cinema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rows',
        'seatsPerRow',
        'cinema_id'
    ];

    public function cinema() {
        return $this->belongsTo(Cinema::class);
    }

    public function seats() {
        return $this->hasMany(Seat::class);
    }

    public function filmevents() {
        return $this->hasMany(FilmEvent::class);
    }
}
