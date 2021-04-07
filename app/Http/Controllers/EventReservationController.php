<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use App\Models\Event;
use Illuminate\Http\Request;

class EventReservationController extends Controller
{
    public function Reserve($id)
    {
        $event = Event::find($id);

        if($event == null) {
            abort(404, "Restaurant not found");
        }
        
        return view('events.reservation', [
            'event' => $event,
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
        dd($request);
    }
}
