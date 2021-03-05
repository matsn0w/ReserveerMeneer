<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantOpeninghours;

class RestaurantOpeninghoursController extends Controller
{
    public function store(Request $request, Restaurant $restaurant) {

        $weekdays = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
        foreach($weekdays as $day) {
            $openinghour = $request->get("openinghour".$day);
            $closinghour = $request->get("closinghour".$day);
            
            RestaurantOpeninghours::create([
                'weekday' => $day,
                'restaurant_id' => $restaurant->id, 
                'openingtime' => date('H:i', strtotime($openinghour)), 
                'closingtime' =>  date('H:i', strtotime($closinghour))]);
        }
    }

    public function update(Request $request, Restaurant $restaurant) {

        foreach(RestaurantOpeninghours::where('restaurant_id' , '=' , $restaurant->id)->get() as $times) {
            $openinghour = $request->get("openinghour".$times->weekday);
            $closinghour = $request->get("closinghour".$times->weekday);
            
            $times->update(['weekday' => $times->weekday, 'restaurant_id' => $restaurant->id, 'openingtime' => date('H:i', strtotime($openinghour)), 'closingtime' =>  date('H:i', strtotime($closinghour))]);
        }
    }
}
