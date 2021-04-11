<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use DB;
use Illuminate\Http\Request;
use App\Models\RestaurantReservation;
use App\Models\RestaurantOpeninghours;
use App\Repositories\ReservationRepository;
use App\Rules\MaxReservationsByTime;

class RestaurantReservationController extends Controller
{
    private $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestaurantReservation  $restaurantReservation
     * @return \Illuminate\Http\Response
     */
    public function reserve($id)
    {
        $restaurant = Restaurant::find($id) ?? abort(404, "Restaurant not found");
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
        $restaurant = Restaurant::find($request->get('restaurant_id')) ?? abort(404, "Restaurant not found");

        $validatedReservation = $this->validateReservation($request, $restaurant);
        $validatedReservation['restaurant_id'] = $restaurant->id;

        $validatedAddress = $this->validateAddress($request);

        if($this->checkTimeSlot($request) == false) {
            session()->flash('error', 'Tijd slot vol, je bent in de wachtrij geplaatst! een telefoontje zal volgen wanneer deze vrijkomt');
            return redirect()->route('home');
        }

        $this->reservationRepository->create($validatedReservation, $validatedAddress, 'restaurant');

        return redirect()->route('home');
    }

    public function checkTimeSlot($validatedReservation) {
        $rule = new MaxReservationsByTime($validatedReservation['date']);

        if($rule->passes('date' ,$validatedReservation['date']) == false) { // 
            return false;
        }

        DB::table('restaurant_queues')->insert([
            'user_id' => auth()->user()->id,
            'restaurant_id' => $validatedReservation['restaurant_id'],
            'date' => $validatedReservation['date'],
            'time' => $validatedReservation['time'],
            'groupsize' =>  $validatedReservation['groupsize'],
        ]);

        return true;
    }

    // TODO: move to common location
    public function validateReservation(Request $request, Restaurant $restaurant) {
        return $request->validate([
            'date' => ['required', 'date' ,'after:yesterday'],
            'time' => ['required'],
            'groupsize' => ['required', 'integer', 'min:1', 'max:'.$restaurant->seats],
            // check if id's exist
            // check if there is still space for the groupsize
        ]);
    }

    // TODO: move to common location
    public function validateAddress(Request $request) {
        return $request->validate([
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'house_number' => ['required', 'regex:/^\d+[a-zA-Z]*$/'],
            'city' => ['required'],
            'country' => ['required']
        ]);
    }
}
