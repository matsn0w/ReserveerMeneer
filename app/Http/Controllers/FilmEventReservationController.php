<?php

namespace App\Http\Controllers;

use App\Models\FilmEvent;
use App\Models\Seat;
use App\Models\FilmEventReservation;
use Illuminate\Http\Request;
use App\Repositories\ReservationRepository;
use App\Rules\OverlappingFilmReservation;

class FilmEventReservationController extends Controller
{
    private $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  FilmEvent  $filmevent
     * @return \Illuminate\Http\Response
     */
    public function reserve(FilmEvent $filmevent)
    {
        $filmreservations = $filmevent->filmeventreservations;
        $seat_ids =[];

        foreach($filmreservations as $filmreservation) {
            if($filmreservation->reservation != null) { 
                foreach($filmreservation->seats as $seat) {
                    array_push($seat_ids, $seat->id);
                }
            }   
        }
        
        return view('filmevents.reservation', [
            'event' => $filmevent,
            'lockedSeats' => $seat_ids
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FilmEvent $filmevent)
    {
        $this->validateReservation($filmevent);
        $seats = $this->validateSeats($request, $filmevent->id);

        $validatedReservation['filmevent_id'] = $filmevent->id;
        $validatedReservation['seats'] = $seats;
        $validatedAddress = $this->validateAddress($request);

        $this->reservationRepository->create($validatedReservation, $validatedAddress, 'filmevent');

        return redirect()->route('home');
    }

    public function validateReservation($filmevent) {
        $rule = new OverlappingFilmReservation($filmevent->id);
        if($rule->passes('filmevent_id', $filmevent->id) == false) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'filmevent_id' => [$rule->message()],
            ]);
            throw $error;
        }
    }

    public function validateSeats($request, $filmevent_id) {
        if($request['seats'] == null) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'seats' => ['There are no seats selected.'],
            ]);
            throw $error;
        }

        $seats = explode(',', $request['seats']);

        foreach($seats as $seat) {
            $seat = Seat::find(intval($seat));
            if($seat != null) {
                if($seat->filmeventreservations()->where('filmevent_id', '=', $filmevent_id)->first() != null) {//If already a reservation for this event on this seat;
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        'seats' => ['This seat has already been reserved.'],
                    ]);
                    throw $error;
                } 
            }
        }
        
        return $seats;
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
