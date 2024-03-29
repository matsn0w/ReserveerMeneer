<?php

namespace Database\Factories;

use DateInterval;
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
            'enddate' => $date->add(new DateInterval('P5D')),
            'ticketamount' => 5,
        ];
    }
}
