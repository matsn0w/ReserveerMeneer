<?php

namespace App\Rules;

use App\Models\RestaurantReservation;
use Illuminate\Contracts\Validation\Rule;

class MaxReservationsByTime implements Rule
{
    protected $date;
    protected $from;
    protected $to;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
        $this->date = $date;
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
        $this->from = date('H:i', floor(strtotime($value) / (30 * 60)) * (30 * 60));
        $this->to = date('H:i', ceil(strtotime($value) / (30 * 60)) * (30 * 60));

        $reservations_in_timeslot = RestaurantReservation::where('date', $this->date)->whereBetween('time', [$this->from, $this->to])->get();
        dd($reservations_in_timeslot);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return `The timeslot $this->from - $this->to is full.`;
    }

}
