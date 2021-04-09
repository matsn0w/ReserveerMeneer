<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
