<?php

namespace App\Models;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    public function halls()
    {
        return $this->hasMany(Hall::class);
    }
}
