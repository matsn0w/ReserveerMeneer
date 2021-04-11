<?php

namespace App\Rules;

use App\Models\FilmEvent;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class MaxMoviesPerHallPerDay implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($hall_id)
    {
        $this->max = 3;
        $this->hall_id = $hall_id;
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
        $value = str_replace('T', ' ', $value);
        $this->date = date('Y-m-d', strtotime($value));

        $filmevents = FilmEvent::get()
                            ->filter(function($r) { return Str::startsWith($r->start, $this->date);})
                            ->where('hall_id', '=', $this->hall_id);

        if(count($filmevents) >= 3) {
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
        return 'There are already '. $this->max .' movies for this hall today.';
    }
}
