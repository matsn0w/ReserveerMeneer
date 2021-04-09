<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index() {
        $reservations = auth()->user()->reservations()->orderBy('id', 'DESC')->paginate(8);

        return view('reservations.index', [
            'reservations' => $reservations,
        ]);
    }

    public function show(Reservation $reservation) {
        
        if($reservation->user_id != auth()->user()->id) {
            return redirect()->route('reservations.index');
        }

        return view('reservations.show', [
            'reservation' => $reservation,
        ]); 
    }

    public function export(Reservation $reservation)
    {
        $csv = new \Laracsv\Export();

  

        // $csv->insertOne(array_keys($reservation->getAttributes()));
        // $csv->insertOne($reservation->toArray());

        $csv->output('people.csv');
    }
}
