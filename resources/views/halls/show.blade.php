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

        @forelse ($hall->filmevents as $filmevent)
            <div class="block">
                <p>
                    <a href="{{ route('filmevents.show', $filmevent) }}">{{ $filmevent->movie->name }}</a><br>
                    <strong>Start:</strong> {{ date('d-m-Y H:i', strtotime($filmevent->start)) }}
                </p>
            </div>
        @empty
            <p>Er zijn nog geen filmavonden!</p>
        @endforelse
    </div>

    <div class="block">
        @can('update', $hall)
            <a href="{{ route('halls.edit', $hall) }}">Bewerken</a> |
        @endcan

        <a href="{{ route('halls.index') }}">Terug naar overzicht</a>
    </div>
@endsection
