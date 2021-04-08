<?php

namespace App\Rules;

use App\Models\Reservation;
use Illuminate\Contracts\Validation\Rule;

class MaxReservationsPerPerson implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ticketamount, $event) 
    {
        $this->userid = auth()->user()->id;
        $this->event = $event;
        $this->ticketamount = $ticketamount;
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
        $amountOfReservation = 0;
        $reservations = Reservation::where('user_id', '=', $this->userid)
                                ->where('related_id', '=', $this->event->id)
                                ->where('related_type', '=', 'App\Models\EventReservation')->get();
        
        foreach($reservations as $reservation) {
            $eventreservation = $reservation->related;
            $amountOfReservation = $amountOfReservation + $eventreservation->ticketamount;
        }

        $amountOfReservation = $amountOfReservation + $this->ticketamount;

        if($amountOfReservation > $this->event->maxPerPerson) {
            return false;
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
        return 'You have exceeded the maximum amount of tickets!';
    }
}
