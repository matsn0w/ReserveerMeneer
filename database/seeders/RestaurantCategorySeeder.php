<?php

namespace Database\Seeders;

use App\Models\RestaurantCategory;
use Illuminate\Database\Seeder;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1,'name' => "Italiaans"],
            ['id' => 2,'name' => "Orientaals"],
            ['id' => 3,'name' => "Sushi"],
            ['id' => 4,'name' => "Arabisch"],
            ['id' => 5,'name' => "Tapas"],
            ['id' => 6,'name' => "Westers"],
        ];

        RestaurantCategory::insert($categories);
    }
}
