<?php

namespace App\Http\Controllers;

use App\Models\FilmEvent;
use App\Repositories\ReservationRepository;

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
        return view('filmevents.reservation', [
            'event' => $filmevent
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
        $validatedAddress = $this->validateAddress($request);

        $this->reservationRepository->create($validatedAddress, 'filmevent');

        return redirect()->route('home');
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
