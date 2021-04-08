@extends('layouts.base', [
    'title' => $hall->name
])

@section('content')
    <p>
        Aantal rijen: {{ $hall->rows }}<br>
        Aantal stoelen per rij: {{ $hall->seatsPerRow }}<br>
        Aantal zitplaatsen: {{ count($hall->seats) }}<br>
        Bioscoop: <a href="{{ route('cinemas.show', $hall->cinema) }}">{{ $hall->cinema->name }}</a>
    </p>

    <div class="block">
        <h2>Stoelen</h2>

        <x-seats :hall="$hall" />
    </div>

    <div class="block">
        <h2>Aankomende filmavonden</h2>

        @foreach ($hall->filmevents as $filmevent)
            <div class="block">
                <p>
                    <strong>{{ $filmevent->movie->name }}</strong><br>
                    <strong>Start:</strong> {{ date('d-m-Y H:i', strtotime($filmevent->start)) }}
                </p>
            </div>
        @endforeach
    </div>

    <div class="block">
        <a href="{{ route('halls.edit', $hall) }}">Bewerken</a> |
        <a href="{{ route('halls.index') }}">Terug naar overzicht</a>
    </div>
@endsection
