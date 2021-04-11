<?php

namespace Database\Factories;

use App\Models\EventGuest;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventGuestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventGuest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birthdate' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
        ];
    }
}
