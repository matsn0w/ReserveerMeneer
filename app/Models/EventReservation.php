<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'file_id', 'startdate', 'enddate', 'ticketamount'];

    public function addresses() {
        return $this->belongsTo(Address::class);
    }

    public function reservation() {
        return $this->morphOne(Reservation::class, 'related', 'reservations');
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function file() {
        return $this->belongsTo(File::class);
    }
}
