<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\RestaurantReservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //Dashboard for restaurant-overview;

    //Display all restaurants on today's date and how full they are
    public function index() {
        $date = Carbon::now()->toDateString();
        $restaurants = Restaurant::get();
        return view('restaurants.dashboard', [
            'restaurants' => $restaurants,
            'date' => $date,
            'name' => ''
        ]);
    }

    public function filter(Request $request) {

        $date = $request->get('date');
        $name = $request->get('name');
        $restaurants = [];
        if($request->get('date') == null && $request->get('name') == null) {
            return redirect()->route('dashboard.index');
        } 
        if($date == null) {
            $date = Carbon::now()->toDateString();
        } 
        if($name == null) {
            $restaurants = Restaurant::get();
        } else {
            $restaurants = Restaurant::where('name', 'LIKE', "%".$name."%")->get();
        }

        return view('restaurants.dashboard', [
            'restaurants' => $restaurants,
            'date' => $date,
            'name' => $name
        ]);
    }
}
