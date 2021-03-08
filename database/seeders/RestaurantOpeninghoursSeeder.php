<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestaurantOpeninghours;
use phpDocumentor\Reflection\Types\Null_;

class RestaurantOpeninghoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($restaurants)
    {
        
        $weekdays = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
        foreach($restaurants as $restaurant) {
            foreach($weekdays as $weekday) {
                $test = RestaurantOpeninghours::create([
                    'weekday' => $weekday,
                    'openingtime' => date('H:i', strtotime("11:00")),
                    'closingtime' => date('H:i', strtotime("23:00")),
                    'restaurant_id' => $restaurant->id, 
                ]);

            }
        }

    }
}
