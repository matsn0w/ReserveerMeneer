<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = RestaurantCategory::all();
        return [
            'name' => $this->faker->firstname() . "'s ". $this->faker->word(),
            'category' => $categories[$this->faker->numberBetween(0, count($categories) - 1)]->name,
            'description' => $this->faker->text(),
            'seats' => $this->faker->numberBetween(10, 130),
        ];
    }
}
