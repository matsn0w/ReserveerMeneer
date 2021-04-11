<?php

namespace App\Models;

use App\Models\EventReservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'startdate',
        'enddate',
        'maxPerPerson'
    ];

    public function unified_date()
    {
        return date('Y-m-d', strtotime($this->startdate));
    }

    public function eventreservations() {
        return $this->hasMany(EventReservation::class);
    }
}
