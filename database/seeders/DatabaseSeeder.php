<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\CinemaSeeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\FilmEventSeeder;
use App\Models\RestaurantOpeninghours;

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
        $this->call(CinemaSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(FilmEventSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
