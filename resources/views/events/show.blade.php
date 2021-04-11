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
        @can('reserve', $event)
            <a href="{{ route('eventreservations.reserve', $event->id) }}">Reserveren</a> |
        @endcan

        @can('update', $event)
            <a href="{{ route('events.edit', $event) }}">Bewerken</a> |
        @endcan

        <a href="{{ route('events.index') }}">Terug naar overzicht</a>
    </div>
@endsection
