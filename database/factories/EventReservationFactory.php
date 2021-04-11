<?php

namespace Database\Factories;

use App\Models\EventReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventReservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeThisMonth();
        return [
            'startdate' => $date,
            'enddate' => date('Y-m-d', strtotime($date. ' + 5 days')),
            'ticketamount' => 5,
        ];
    }
}
