@extends('layouts.base', [
    'title' => 'Reservering'
])

@section('content')
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <p>Geplaatst op {{ date('d-m-Y \o\m H:i', strtotime($reservation->created_at)) }}</p>

                <div class="columns">
                    <div class="column">
                        <p>
                            @if ($reservation->related_type == 'App\Models\EventReservation')
                                <strong>Evenement: </strong>{{$reservation->related->event->name}} <br>
                                <strong>Startdatum: </strong>{{$reservation->related->startdate}}<br>
                                <strong>Einddatum: </strong>{{$reservation->related->enddate}}<br>
                                <strong>Aantal tickets: </strong>{{$reservation->related->ticketamount}}
                            @elseif ($reservation->related_type == 'App\Models\RestaurantReservation')
                                <strong>Restaurant: </strong>{{$reservation->related->restaurant->name}} <br>
                                <strong>Datum: </strong>{{$reservation->related->date}}<br>
                                <strong>Tijd: </strong>{{$reservation->related->time}}<br>
                                <strong>Groepomvang: </strong>{{$reservation->related->groupsize}}
                            @elseif ($reservation->related_type == 'App\Models\FilmEventReservation')
                                <strong>Film: {{$reservation->related->filmevent->movie->name}}</strong> <br>
                                <strong>Datum/Tijd: </strong>{{$reservation->related->filmevent->start}}<br>
                                <strong>Bioscoop: </strong>{{$reservation->related->filmevent->hall->cinema->name}}<br>
                                <strong>Hall: </strong>{{$reservation->related->filmevent->hall->name}}<br>
                                <strong>Groepomvang: </strong>{{count($reservation->related->seats)}}
                            @endif
                        <p>
                    </div>

                    <div class="column">
                        <p>
                            <strong>Gereserveerd door:</strong><br>
                            <strong>Naam: </strong>{{ $reservation->user->name }}<br>
                            <strong>Email: </strong>{{ $reservation->user->email }}<br>
                            <strong>Telefoonnummer: </strong>{{ $reservation->user->phonenumber }}<br>
                        </p>

                        <p>
                            <strong>Postcode: </strong>{{ $reservation->address->postal_code }}<br>
                            <strong>Straatnaam: </strong>{{ $reservation->address->street_name }}<br>
                            <strong>Huisnummer: </strong>{{ $reservation->address->house_number }}<br>
                            <strong>Plaatsnaam: </strong>{{ $reservation->address->city }}<br>
                            <strong>Land: </strong>{{ $reservation->address->country }}<br>
                        </p>
                    </div>
                </div>

                @if ($reservation->related_type == 'App\Models\EventReservation')
                    <div class="w-100 is-flex flex-wrap is-justify-content-flex-start my-5">
                        @foreach ($reservation->related->guests as $guest)
                            <div class="mr-4">
                                <p>
                                    <strong>Naam: </strong>{{ $guest->name }} <br>
                                    <strong>Geboortedatum: </strong>{{ $guest->birthdate }}<br>
                                    <strong>Pasfoto: </strong><br>
                                </p>

                                <img class="guestimg" src="{{ url('storage/images/' . $guest->file->url) }}">
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($reservation->related_type == 'App\Models\FilmEventReservation')
                    <h2>Stoelen</h2>

                    <div class="w-100 is-flex flex-wrap is-justify-content-flex-start my-5">
                        @foreach ($reservation->related->seats as $seat)
                            <div class="mr-4">
                                <p>
                                    <strong>Rij: </strong>{{ $seat->row }} <br>
                                    <strong>Stoelnummer: </strong>{{ $seat->number }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($reservation->related_type == 'App\Models\EventReservation')
                    <a class="button is-primary" href="{{ route('reservations.exportCSV', $reservation) }}">Exporteer naar CSV</a>
                    <a class="button is-primary" href="{{ route('reservations.exportJSON', $reservation) }}">Exporteer naar JSON</a>
                @endif

                <a class="button is-link is-light" href="{{ route('reservations.index') }}">Terug</a>
            </div>
        </div>
    </div>
@endsection
