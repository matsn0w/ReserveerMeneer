<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class HallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hall::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName . 'zaal',
            'rows' => $this->faker->numberBetween(5, 10),
            'seatsPerRow' => $this->faker->numberBetween(5, 10)
        ];
    }
}
