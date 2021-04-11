<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use App\Models\Event;
use App\Models\EventGuest;
use App\Models\File;
use App\Repositories\ReservationRepository;
use App\Rules\MaxReservationsPerPerson;
use App\Rules\ValidEventDateDifference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App;

class EventReservationController extends Controller
{
    private $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository;
    }

    public function reserve($id, $locale = null)
    {
        if(in_array($locale, ['en', 'nl'])) {
            app()->setlocale($locale);
        }

        $locale = app()->getLocale();

        $event = Event::find($id);

        if($event == null) {
            abort(404, "Restaurant not found");
        }

        return view('events.reservation', [
            'event' => $event,
            'locale' => $locale,
        ]);
    }

    public function setLocale($id, $locale) {

        if(in_array($locale, ['en', 'nl'])) {
            app()->setlocale($locale);
        }

        return redirect()->route('eventreservations.reserve', [$id, $locale]);
    }

    public function nextStep(Request $request, $event_id, $locale = null) {
        if(in_array($locale, ['en', 'nl'])) {
            app()->setlocale($locale);
        }

        $locale = app()->getLocale();

        $event = Event::find($event_id) ?? abort(404, "Event not found");

        $validatedReservation = $this->validateReservation($request, $event);
        $validatedReservation['event_id'] = $event->id;
        $validatedAddress = $this->validateAddress($request);

        $request->session()->put('address_data', $validatedAddress);
        $request->session()->put('reservation_data', $validatedReservation);

        return view('events.guestinfo', [
            'guestamount' => $validatedReservation['ticketamount'],
            'event' => $event,
            'locale' => $locale,
        ]);
    }


    public function store(Request $request)
    {

        $validatedAddress = $request->session()->get('address_data');
        $validatedReservation = $request->session()->get('reservation_data');
        $new_guests = [];
        $this->validateGuests($request);
        $files = [];

        $i = 0;
        foreach($request['guests'] as $guest) {
            if($request->hasFile('guests.'.$i)) {
                if($request->file('guests.'.$i)['image']->isValid()) {
                    $file = $this->validateFile($request, $i)['guests'][$i]['image'];
                    $files[$i.'-'.$guest['name']] = $file;
                }
            } else {
                abort(500, 'No image found');
            }
            $i++;
        }

        $i = 0;
        foreach($request['guests'] as $guest) {
            $file = $files[$i.'-'.$guest['name']];
            $extension = $file->extension();
            $name = $this->generateName($guest['name']);
            $file->storeAs('public/images', $name.".".$extension);
            $url = $name.".".$extension;
            $file = File::create([
                'user_id' => auth()->user()->id,
                'name' => $name,
                'url' => $url
            ]);


            array_push($new_guests, array(
                'name' => $guest['name'],
                'birthdate' => $guest['birthdate'],
                'file_id' => $file->id,
            ));

            $i++;
        }


        $validatedReservation['guests'] = $new_guests;
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

    public function validateAddress(Request $request) {
        return $request->validate([
            'postal_code' => ['required'],
            'street_name' => ['required'],
            'house_number' => ['required', 'regex:/^\d+[a-zA-Z]*$/'],
            'city' => ['required'],
            'country' => ['required']
        ]);
    }

    public function validateFile(Request $request, $index) {
        return $request->validate([
            'guests.'.$index.'.image' => ['mimes:jpeg,png, max:1014']
        ]);
    }

    public function generateName($name) {
        $user = auth()->user();

        $files = File::where('name', 'like', $user->id.'-'."%")->get();

        return $user->id.'-'.$name.'-'.($files->count()+1);
    }

    public function validateGuests(Request $request) {

        return $request->validate([
            'guests.*.name' => ['required', 'min:3', 'max:80'],
            'guests.*.birthdate' => ['required', 'before:today'],
        ]);
    }


}
