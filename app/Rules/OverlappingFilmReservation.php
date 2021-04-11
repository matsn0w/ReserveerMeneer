<?php

namespace App\Rules;

use App\Models\FilmEvent;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class OverlappingFilmReservation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($filmevent_id)
    {
        $this->filmevent = FilmEvent::find($filmevent_id);
        $this->date = date("Y-m-d",strtotime($this->filmevent->start));
        //get all movie events on same day
        $user = auth()->user(); 
        $this->films = $user->reservations()
                                ->where('related_type', '=', 'App\Models\FilmEventReservation')
                                ->get()
                                ->load(['related', 'related.filmevent'])
                                ->filter(function($r) { return Str::startsWith($r->related->filmevent->start, $this->date);})
                                ->pluck('related.filmevent');

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $mainfilm_start = date('Y-m-d H:i:s', strtotime($this->filmevent->start));
        $mainfilm_end = date('Y-m-d H:i:s',strtotime('+'.$this->filmevent->movie->duration." minutes" ,strtotime($this->filmevent->start)));

        foreach($this->films as $film) {
            $checkfilm_start = date('Y-m-d H:i:s', strtotime($film->start));
            $checkfilm_end = date('Y-m-d H:i:s',strtotime('+'.$film->movie->duration." minutes" ,strtotime($film->start))); 

            if($mainfilm_start <= $checkfilm_end && $mainfilm_end >= $checkfilm_start) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You already have a movie reservation at this time.';
    }
}
