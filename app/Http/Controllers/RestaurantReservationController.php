<?php

namespace App\Http\Controllers;

use App\Models\RestaurantReservation;
use App\Models\Restaurant;
use App\Models\RestaurantOpeninghours;
use Illuminate\Http\Request;

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
        $validatedPersonalia = $this->validatePersonalData($request);
        $validatedReservation = $this->validateReservation($request);

        //$personal_data = DB::table('personal_data')->insert($validatedPersonalia);
        return redirect()->route('home');

    }

    public function validatePersonalData(Request $request) {
        return $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'phonenumber' => ['required'],
            'postalcode' => ['required'],
            'housenumber' => ['required'],
        ]);
    }

    public function validateReservation(Request $request) {
        return $request->validate([
            'date' => ['required'],
            'time' => ['required'],
            'groupsize' => ['required'],
            //check if id's exist
        ]);
    }
}
