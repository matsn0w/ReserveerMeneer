<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $eventdate = $this->faker->dateTimeBetween('now', '+2 years');
        $eventlength = $this->faker->numberBetween(1, 5);
        return [
            'name' => $this->faker->word() . ' ' . $this->faker->word(),
            'description' => $this->faker->text(),
            'startdate' => date('Y-m-d', $eventdate->getTimestamp()),
            'enddate' => date('Y-m-d', $eventdate->modify('+'.$eventlength.' day')->getTimestamp()),
            'personMax' => $this->faker->numberBetween(5, 20)
        ];

    }
}
