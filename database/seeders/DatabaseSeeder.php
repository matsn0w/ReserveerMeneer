<?php

namespace Database\Seeders;

use App\Models\RestaurantOpeninghours;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RestaurantCategorySeeder::class);
        $this->call(RestaurantSeeder::class);
    }
}
