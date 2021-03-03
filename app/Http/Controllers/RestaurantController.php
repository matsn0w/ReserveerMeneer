<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\RestaurantOpeninghours;
use DateTime;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableCategories = RestaurantCategory::all('name');
        $weekdays = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
        
        $array = [];
        foreach($weekdays as $weekday) {
            $array[$weekday] = ["openinghour" => "00:00", "closinghour" => "00:00"];
        }

        return view('restaurants.create', ['availableCategories' => $availableCategories, 'openinghours' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        global $weekdays;

        $validatedAttributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required'],
            'category' => ['required'],
            'seats' => ['required']
        ]);

        $restaurant = Restaurant::create($validatedAttributes);

        $weekdays = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
        foreach($weekdays as $day) {
            $openinghour = $request->get("openinghour".$day);
            $closinghour = $request->get("closinghour".$day);
            RestaurantOpeninghours::create(['weekday' => $day, 'restaurant_id' => $restaurant->id, 'openingtime' => date('H:i', strtotime($openinghour)), 'closingtime' =>  date('H:i', strtotime($closinghour))]);
        }

        return redirect(Route('restaurants.show', $restaurant));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if($restaurant == null) abort(404, "Page not found"); 

        return view('restaurants.show', ['restaurant' => $restaurant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }

    
}
