<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Address;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address_id', 'related_id', 'related_type'];

    public function related() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function address() {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
}
