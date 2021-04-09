<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use App\Models\Event;
use App\Models\File;
use App\Repositories\ReservationRepository;
use App\Rules\MaxReservationsPerPerson;
use App\Rules\ValidEventDateDifference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class EventReservationController extends Controller
{
    private $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository;
    }

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

        $validatedReservation = $this->validateReservation($request, $event);
        $validatedReservation['event_id'] = $event->id;
        $validatedAddress = $this->validateAddress($request);

        if($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                $this->validateFile($request);
                $extension = $request->image->extension();
                $name = $this->generateName(); 
                $request->image->move('uploads/file/', $name.".".$extension);
                $url = $name.".".$extension;
                $file = File::create([
                    'user_id' => auth()->user()->id,
                    'name' => $name,
                    'url' => $url
                ]);

                session()->flash('success', "Success!");

                $validatedReservation['file_id'] = $file->id;
            }
        } else {
            abort(500, 'could not upload image : (');
        }

        $this->reservationRepository->create($validatedReservation, $validatedAddress,'event');

        return redirect()->route('home');
    }

    public function validateReservation(Request $request, Event $event) {
        return $request->validate([
            'startdate' => ['required', 'before_or_equal:enddate', 'after_or_equal:'.$event->startdate],
            'enddate' => ['required', 'after_or_equal:startdate', 'before_or_equal:'.$event->enddate, new ValidEventDateDifference($event->startdate, $event->enddate, $request->get('startdate'), $request->get('enddate'))],
            'ticketamount' => ['required', 'min:1', 'max:'.$event->maxPerPerson, new MaxReservationsPerPerson($request->ticketamount, $event)],
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

    public function validateFile($request) {
        return $request->validate([
            'image' => ['mimes:jpeg,png, max:1014']
        ]);
    }

    public function generateName() {
        $user = auth()->user();

        $files = File::where('name', 'like', $user->id.'-'."%")->get();

        return $user->id.'-'.$user->name.'-'.($files->count()+1);
    }


}
