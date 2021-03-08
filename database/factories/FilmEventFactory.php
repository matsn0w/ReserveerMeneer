<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\FilmEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FilmEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hall_id' => Hall::inRandomOrder()->first(),
            'movie_id' => Movie::inRandomOrder()->first(),
            'start' => $this->faker->dateTimeThisMonth()
        ];
    }
}
