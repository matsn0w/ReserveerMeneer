@extends('layouts.base', [
    'title' => 'Reservation'
])

@section('content') 
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h1 class="title">{{$reservation->created_at}}</h1>

                <div class="is-flex is-justify-content-space-between">
                    <div class="column is-two-fifths p-0 pt-3">
                        <p class="is-size-4 mb-4">
                        @if($reservation->related_type == 'App\Models\EventReservation')
                    
                            <strong>Evenement: </strong>{{$reservation->related->event->name}} <br><br>          
                            <strong>Startdatum: </strong>{{$reservation->related->startdate}}<br>
                            <strong>Einddatum: </strong>{{$reservation->related->enddate}}<br>
                            <strong>Aantal tickets: </strong>{{$reservation->related->ticketamount}}
                                   
                        @elseif($reservation->related_type == 'App\Models\RestaurantReservation')
                            
                            <strong>Restaurant: </strong>{{$reservation->related->restaurant->name}} <br><br>          
                            <strong>Datum: </strong>{{$reservation->related->date}}<br>
                            <strong>Tijd: </strong>{{$reservation->related->time}}<br>
                            <strong>Groepomvang: </strong>{{$reservation->related->groupsize}}
                            
                        @elseif($reservation->related_type == 'App\Models\FilmEventReservation')
                                    {{-- TODO --}}
                        @endif
                        <p>

                        @if($reservation->related_type == 'App\Models\EventReservation')
                            <strong>Pasfoto: </strong><br>
                            <img class="mb-4" src="{{asset('uploads/file/' . $reservation->related->file->url)}}">
                        @endif
                    </div>

                    <div class="column is-half p-0 pt-3">
                        <p class="is-size-4">
                            <strong>Postcode: </strong>{{$reservation->address->postal_code}}<br>
                            <strong>Straatnaam: </strong>{{$reservation->address->street_name}}<br>
                            <strong>Huisnummer: </strong>{{$reservation->address->house_number}}<br>
                            <strong>Plaatsnaam: </strong>{{$reservation->address->city}}<br>
                            <strong>Land: </strong>{{$reservation->address->country}}<br>
                        </p>
                    </div>
                </div>

                @if($reservation->related_type == 'App\Models\EventReservation')
                    <a class="button is-primary" href="{{route('reservations.export', $reservation)}}">Exporteren</a>
                @endif
                <!-- Authorisatie en Authenticatie op bewerken -->
                <a class="button is-warning" href="{{ route('reservations.index')}}">Terug</a>     
            </div>
        </div>
    </div>
@endsection