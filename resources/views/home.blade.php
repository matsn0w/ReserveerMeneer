@extends('layouts.base', [
'title' => 'Home'
])

@section('content')
    <p>Welkom bij {{ env('APP_NAME') }}!</p>

    @auth
        <p>Je bent ingelogd als <strong>{{ auth()->user()->name }}</strong> (<a data-action="logout" href="{{ route('logout') }}">log uit</a>)</p>
    @endauth

    <div class="columns">
        <div class="column is-one-quarter">
            <nav class="panel">
                <p class="panel-heading mb-0">Onderdelen</p>

                <a class="panel-block" href="{{ route('restaurants.index') }}">Restaurants</a>
                <a class="panel-block" href="{{ route('cinemas.index') }}">Bioscopen</a>
                <a class="panel-block" href="{{ route('halls.index') }}">Zalen</a>
                <a class="panel-block" href="{{ route('movies.index') }}">Films</a>
                <a class="panel-block" href="{{ route('events.index') }}">Evenementen</a>
                <a class="panel-block" href="{{ route('filmevents.index') }}">Filmavonden</a>
            </nav>
        </div>
    </div>

    <x-logoutform />
@endsection
