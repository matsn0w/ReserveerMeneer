@extends('layouts.base', [
    'title' => 'Home'
])

@section('content')
    <div class="columns">
        <div class="column">
            <p>Welkom bij {{ env('APP_NAME') }}!</p>

            @auth
                <p>Je bent ingelogd als <strong>{{ auth()->user()->name }}</strong> (<a data-action="logout" href="{{ route('logout') }}">log uit</a>)</p>
            @endauth
        </div>

        <div class="column is-one-quarter">
            <nav class="panel">
                <p class="panel-heading mb-0">Onderdelen</p>

                @can('viewAny', App\Models\Restaurant::class)
                    <a class="panel-block" href="{{ route('restaurants.index') }}">Restaurants</a>
                @endcan

                @can('viewAny', App\Models\Cinema::class)
                    <a class="panel-block" href="{{ route('cinemas.index') }}">Bioscopen</a>
                @endcan

                @can('viewAny', App\Models\Hall::class)
                    <a class="panel-block" href="{{ route('halls.index') }}">Zalen</a>
                @endcan

                @can('viewAny', App\Models\Movie::class)
                    <a class="panel-block" href="{{ route('movies.index') }}">Films</a>
                @endcan

                @can('viewAny', App\Models\Event::class)
                    <a class="panel-block" href="{{ route('events.index') }}">Evenementen</a>
                @endcan

                @can('viewAny', App\Models\FilmEvent::class)
                    <a class="panel-block" href="{{ route('filmevents.index') }}">Filmavonden</a>
                @endcan

                @auth
                    @if(auth()->user()->hasRole('ADMIN'))
                        <a class="panel-block" href="{{ route('dashboard.index') }}">Dashboard</a>
                        <a class="panel-block" href="{{ route('reservations.index') }}">Mijn Reserveringen</a>
                    @endif
                @endauth
            </nav>
        </div>
    </div>

    <div class="level">
        <div class="level-left">
            <h2>Komende evenementen</h2>
        </div>

        <div class="level-right">
            @can('viewAny', App\Models\Event::class)
                <a class="button is-link is-light" href="{{ route('home.events') }}">Alle evenementen</a>
            @endcan
        </div>
    </div>

    @foreach ($events->chunk(2) as $chunk)
        <div class="columns">
            @foreach ($chunk as $event)
                <div class="column">
                    <div class="block">
                        @if ($event instanceof App\Models\Event)
                            <h3>Evenement: {{ $event->name }}</h3>
                            <strong>Start: </strong> {{ date('d-m-Y', strtotime($event->startdate)) }}<br>
                            <strong>Eind: </strong> {{ date('d-m-Y', strtotime($event->enddate)) }}<br>
                            <a href="{{ route('events.show', $event) }}">Bekijk info</a>
                        @else
                            <h3>Film: {{ $event->movie->name }}</h3>
                            <strong>Start: </strong> {{ date('d-m-Y \o\m H:i', strtotime($event->start)) }}<br>
                            <a href="{{ route('filmevents.show', $event) }}">Bekijk info</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
