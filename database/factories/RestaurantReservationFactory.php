<?php

namespace Database\Factories;

use App\Models\RestaurantReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RestaurantReservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeThisMonth;
        return [
            'date' => date('Y-m-d', $date),
            'time' => date('H:i:s', $date),
            'groupsize' => $this->faker->numberBetween(1, 5),
        ];
    }
}
