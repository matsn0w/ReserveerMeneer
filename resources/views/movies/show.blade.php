@extends('layouts.base', [
    'title' => $movie->name
])

@section('content')
    <p>Duur: {{ $movie->duration }} minuten</p>

    <div class="block">
        <h2>Aankomende filmavonden</h2>

        @forelse ($movie->filmevents as $filmevent)
            <div class="block">
                <p>
                    <a href="{{ route('filmevents.show', $filmevent) }}">{{ $filmevent->movie->name }}</a><br>
                    <strong>Bioscoop:</strong> {{ $filmevent->hall->cinema->name }}<br>
                    <strong>Zaal:</strong> {{ $filmevent->hall->name }}<br>
                    <strong>Start:</strong> {{ date('d-m-Y H:i', strtotime($filmevent->start)) }}
                </p>
            </div>
        @empty
            <p>Er zijn nog geen filmavonden voor deze film.</p>
        @endforelse
    </div>

    <a href="{{ route('movies.edit', $movie) }}">Bewerken</a> |
    <a href="{{ route('movies.index') }}">Terug naar het overzicht</a>
@endsection
