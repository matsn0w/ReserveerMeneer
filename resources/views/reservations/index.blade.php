@extends('layouts.base', [
    'title' => 'Mijn reserveringen'
])

@section('content')

    @forelse($reservations->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $reservation)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $reservation->created_at }}</p>
                        </header>

                        <div class="card-content">
                            <div class="content">
                                @if($reservation->related_type == 'App\Models\EventReservation')
                                    <p> 
                                        <strong>{{$reservation->related->event->name}}</strong> <br><br>          
                                        <strong>Startdatum: </strong>{{$reservation->related->startdate}}<br>
                                        <strong>Einddatum: </strong>{{$reservation->related->enddate}}<br>
                                        <strong>Aantal tickets: </strong>{{$reservation->related->ticketamount}}
                                    </p>
                                @elseif($reservation->related_type == 'App\Models\RestaurantReservation')
                                    <p> 
                                        <strong>{{$reservation->related->restaurant->name}}</strong> <br><br>          
                                        <strong>Datum: </strong>{{$reservation->related->date}}<br>
                                        <strong>Tijd: </strong>{{$reservation->related->time}}<br>
                                        <strong>Groepomvang: </strong>{{$reservation->related->groupsize}}
                                    </p>
                                @elseif($reservation->related_type == 'App\Models\FilmEventReservation')
                                    {{-- TODO --}}
                                @endif
                            </div>
                        </div>

                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ route('reservations.show', $reservation) }}">Bekijken</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p>Geen reserveringen gevonden.</p>
    @endforelse

    {{ $reservations->links('vendor.pagination.bulma') }}
@endsection