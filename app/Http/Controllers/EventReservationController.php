<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use App\Models\Event;
use App\Rules\ValidEventDateDifference;
use Illuminate\Http\Request;

class EventReservationController extends Controller
{
    public function reserve($id)
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
        $event = Event::find($request->get('event_id')) ?? abort(404, "Event not found");

        $validatedReservation = $this->validateReservation($request, $event); //TODO fix validation
        $validatedReservation['event_id'] = $event->id;
        $validatedAddress = $this->validateAddress($request);

        $this->reservationRepository->create($validatedReservation, $validatedAddress, 'event');

        return redirect()->route('home');
    }

    public function validateReservation(Request $request, Event $event) {
        return $request->validate([
            'startdate' => ['required', 'before_or_equal:enddate', "after_or_equal:$event->startdate"],
            'enddate' => ['required', 'after_or_equal:startdate', "before_or_equal:$event->enddate", new ValidEventDateDifference($event->startdate, $event->enddate, $request->get('startdate'), $request->get('enddate'))],
            'ticketamount' => ['required', 'min:1', "max:$event->maxPerPerson"], // validate if not over amount with earlier reservations
        ]);
    }

    //Move to common location
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
