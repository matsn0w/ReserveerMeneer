<?php

namespace App\Http\Controllers;

use App\Models\RestaurantReservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantReservationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestaurantReservation  $restaurantReservation
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        return view('restaurants.reservation', ['restaurant' => $restaurant]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
}
