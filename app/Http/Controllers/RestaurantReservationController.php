<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use DB;
use Illuminate\Http\Request;
use App\Models\RestaurantReservation;
use App\Models\RestaurantOpeninghours;
use App\Rules\MaxReservationsByTime;

use function PHPUnit\Framework\isEmpty;

class RestaurantReservationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestaurantReservation  $restaurantReservation
     * @return \Illuminate\Http\Response
     */
    public function Reserve($id)
    {
        $restaurant = Restaurant::find($id);

        if($restaurant == null) {
            abort(404, "Restaurant not found");
        }

        $openingtimes = RestaurantOpeninghours::where('restaurant_id' , '=' , $restaurant->id)->get();
        
        return view('restaurants.reservation', [
            'restaurant' => $restaurant,
            'openingtimes' => $openingtimes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::find($request->get('restaurant_id'));

        if($restaurant == null) {abort(404, "Restaurant not found");}

        $validatedPersonalia = $this->validatePersonalData($request);
        $personal_data_id = DB::table('personal_data')->insertGetId($validatedPersonalia);

        $validatedReservation = $this->validateReservation($request, $restaurant);
        $validatedReservation['restaurant_id'] = $restaurant->id;
        $validatedReservation['personal_data_id'] = $personal_data_id;

        RestaurantReservation::create($validatedReservation);

        return redirect()->route('home');

    }

    public function validatePersonalData(Request $request) {
        return $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'phonenumber' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:7'],
            'postalcode' => ['required'],
            'housenumber' => ['required', 'regex:/^\d+[a-zA-Z]*$/'],
        ]);
    }

    public function validateReservation(Request $request, Restaurant $restaurant) {
        
        return $request->validate([
            'date' => ['required', 'date' ,'after:yesterday'],
            'time' => ['required', new MaxReservationsByTime($request->get('date'))],
            'groupsize' => ['required', 'integer', 'min:1', 'max:'.$restaurant->seats],
            //check if id's exist
        ]);
    }
}
