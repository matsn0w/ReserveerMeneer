<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\EventReservation;
use App\Models\EventGuest;
use App\Models\FilmEventReservation;
use App\Models\RestaurantReservation;
use App\Models\Reservation;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ReservationRepository extends BaseRepository
{
    public function _construct(Model $model)
    {
        parent::_construct($model);
    }

    public function create($validatedReservation, $validatedAddress, $type) {
        // userID
        $user_id = auth()->user()->id;

        // check if address with exact same values exists. Reduce redundant rows
        if ($validatedAddress == null || $validatedReservation == null) {
            return;
        }

        $address = DB::table('addresses')
            ->where('postal_code', '=', $validatedAddress['postal_code'])
            ->where('street_name', '=', $validatedAddress['street_name'])
            ->where('house_number', '=', $validatedAddress['house_number'])
            ->where('city', '=', $validatedAddress['city'])
            ->where('country', '=', $validatedAddress['country'])
            ->first();

        if ($address == null) {
            $address = Address::create($validatedAddress);
        }

        // do something with address
        $reservation_related = null;
        switch($type) {
            case 'restaurant':
                $reservation_related = RestaurantReservation::create($validatedReservation);
                break;
            case 'event':
                $guests = $validatedReservation['guests'];
                unset($validatedReservation['guests']);
                $reservation_related = EventReservation::create($validatedReservation);

                foreach($guests as $guest) {
                    EventGuest::create([
                        'name' => $guest['name'],
                        'birthdate' => $guest['birthdate'],
                        'file_id' => $guest['file_id'],
                        'event_reservation_id' => $reservation_related->id
                    ]);
                }
                break;
            case 'filmevent':
                $seats = $validatedReservation['seats'];
                unset($validatedReservation['seats']);
                $reservation_related = FilmEventReservation::create($validatedReservation);
                $reservation_lock = FilmEventReservation::create(['filmevent_id' => $validatedReservation['filmevent_id']]);

                foreach($seats as $seat_id) {

                    //search seat in db -> check if 

                    $found = Seat::find($seat_id);
                    if($found != null) {
                        $hall_id = $found->hall_id;
                        $row = $found->row;
                        $number = $found->number;
                        
                        $lock1 = Seat::where('hall_id', '=', $hall_id)
                                    ->where('row', '=', $row)
                                    ->where('number', '=', $number-1)->first();
                        $lock2 = Seat::where('hall_id', '=', $hall_id)
                                    ->where('row', '=', $row)
                                    ->where('number', '=', $number+1)->first();

                        if($lock1 != null) {
                            DB::table('filmevent_reservation_seat')->insert([
                                'filmevent_reservation_id' => $reservation_lock->id,
                                'seat_id' => $lock1->id
                            ]);
                        } if($lock2 != null) {
                            DB::table('filmevent_reservation_seat')->insert([
                                'filmevent_reservation_id' => $reservation_lock->id,
                                'seat_id' => $lock2->id
                            ]);
                        } 
                    }

                    DB::table('filmevent_reservation_seat')->insert([
                        'filmevent_reservation_id' => $reservation_related->id,
                        'seat_id' => $seat_id
                    ]);
                }
                break;
        }

        if ($address != null && $reservation_related != null && $user_id != null) {
            Reservation::create([
                'user_id' => $user_id,
                'address_id' => $address->id,
                'related_id' => $reservation_related->id,
                'related_type' => get_class($reservation_related)
            ]);

            session()->flash('success', 'Reservering is opgeslagen!');
        }
    }
}
