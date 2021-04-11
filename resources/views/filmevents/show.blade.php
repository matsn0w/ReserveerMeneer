@extends('layouts.base', [
    'title' => $filmevent->movie->name
])

@section('content')
    <p>
        <strong>Bioscoop:</strong> <a href="{{ route('cinemas.show', $filmevent->hall->cinema) }}">{{ $filmevent->hall->cinema->name }}</a><br>
        <strong>Zaal:</strong> <a href="{{ route('halls.show', $filmevent->hall) }}">{{ $filmevent->hall->name }}</a><br>
        <strong>Start:</strong> {{ date('d-m-Y H:i', strtotime($filmevent->start)) }}<br>
    </p>

    <x-seats :hall="$filmevent->hall" />

    <div class="block">
        @can('reserve', $filmevent)
            <a href="{{ route('filmeventreservations.reserve', $filmevent) }}">Reserveren</a> |
        @endcan

        @can('update', $filmevent)
            <a href="{{ route('filmevents.edit', $filmevent) }}">Bewerken</a> |
        @endcan

        <a href="{{ route('filmevents.index') }}">Terug naar overzicht</a>
    </div>
@endsection
