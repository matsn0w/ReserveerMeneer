<?php

namespace App\Models;

use App\Models\Cinema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function cinemas()
    {
        return $this->belongsToMany(Cinema::class);
    }
}
