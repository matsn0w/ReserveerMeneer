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
        <a href="{{ route('filmevents.reserve', $filmevent) }}">Reserveren</a> |
        <a href="{{ route('filmevents.edit', $filmevent) }}">Bewerken</a> |
        <a href="{{ route('events.index') }}">Terug naar overzicht</a>
    </div>
@endsection
