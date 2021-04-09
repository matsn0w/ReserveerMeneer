<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGuest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthdate', 'file_id'];  

    public function eventreservation() {
        return $this->belongsTo(EventReservation::class);
    }
}
