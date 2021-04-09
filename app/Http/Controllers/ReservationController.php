<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use File;

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

    public function exportToCSV(Reservation $reservation)
    {
        $csv = new \Laracsv\Export();
        $data = $this->prepExportData($reservation);
        $csv->build(collect($data), ['event_name', 'group_size', 'reserved_by.name', 'reserved_by.email', 'ticket_valid.from', 'ticket_valid.till', 'guest.name', 'guest.birthdate', 'guest.imageurl'])->download();
    }

    public function exportToJSON(Reservation $reservation) {
        $data = json_encode($this->prepExportData($reservation)); 
        
        $file = time() . '_file.json';
        $destinationPath=public_path()."/upload/json/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }

    public function prepExportData(Reservation $reservation) {
        $guests = [];
        foreach($reservation->related->guests as $guest) {
            $exportObj = (object) [
                'event_name' => $reservation->related->event->name,//TODO check for additional info
                'group_size' => $reservation->related->ticketamount,
                'reserved_by' => [
                    'name' => $reservation->user->name,
                    'email' => $reservation->user->email,
                ],
                'ticket_valid' => [
                    'from' => $reservation->related->startdate,
                    'till' => $reservation->related->enddate,
                ],
                'guest' => [
                    'name' => $guest->name,
                    'birthdate' => $guest->birthdate,
                    'imageurl' => $guest->file->url, 
                ],
            ];

            array_push($guests, $exportObj);
        } 
        return $guests;
    }
}
