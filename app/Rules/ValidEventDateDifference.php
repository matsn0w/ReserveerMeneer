<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidEventDateDifference implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($eventstart, $eventend, $startdate, $enddate)
    {
        $this->eventstart = Carbon::createFromFormat('Y-m-d', $eventstart);
        $this->eventend = Carbon::createFromFormat('Y-m-d', $eventend);
        $this->startdate = Carbon::createFromFormat('Y-m-d', $startdate);
        $this->enddate = Carbon::createFromFormat('Y-m-d', $enddate);
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
        $days = $this->startdate->diff($this->enddate)->days;
        $fullevent =  $this->eventstart->diff($this->eventend)->days;
        
        if($days == 1 || $days == 2 || $days == $fullevent) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid date difference';
    }
}
