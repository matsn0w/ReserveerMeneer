<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\RestaurantOpeninghours;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::whereNotNull('id')->delete();

        $restaurants = 
        Restaurant::factory()
            ->count(15)
            ->create();

        $this->callWith(RestaurantOpeninghoursSeeder::class, ['restaurants' => $restaurants]);
    }
}
