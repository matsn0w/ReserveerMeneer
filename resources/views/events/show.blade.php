@extends('layouts.base', [
    'title' => $event->name
])

@section('content')
    <p>
        <strong>Beschrijving:</strong> {{ $event->description }}<br>
        <strong>Start datum:</strong> {{ $event->startdate }}<br>
        <strong>Eind datum:</strong> {{ $event->enddate }}<br>
        <strong>Maximaal aantal tickets per persoon:</strong> {{ $event->maxPerPerson }}</a>
    </p>

    <div class="block">
        <a href="{{ route('eventreservations.reserve', $event->id) }}">Reserveren</a> | 
        <a href="{{ route('events.edit', $event) }}">Bewerken</a> |
        <a href="{{ route('events.index') }}">Terug naar overzicht</a>
    </div>
@endsection