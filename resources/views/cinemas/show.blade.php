@extends('layouts.base', [
    'title' => $cinema->name
])

@section('content')
    <p>Aantal zalen: {{ count($cinema->halls) }}</p>

    <div class="level">
        <div class="level-left">
            <h2>Zalen</h2>
        </div>

        <div class="level-right">
            @can('create', App\Models\Hall::class)
                <a href="{{ route('halls.create') }}" class="button is-link is-light">Nieuwe zaal</a>
            @endcan
        </div>
    </div>

    @foreach($cinema->halls->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $hall)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $hall->name }}</p>
                        </header>

                        <div class="card-content">
                            Aantal rijen: {{ $hall->rows }}<br>
                            Aantal stoelen per rij: {{ $hall->seatsPerRow }}<br>
                            Aantal zitplaatsen: {{ count($hall->seats) }}
                        </div>

                        <footer class="card-footer">
                            @can('update', $hall)
                                <a class="card-footer-item" href="{{ route('halls.show', $hall) }}">Bekijken</a>
                            @endcan
                            <a class="card-footer-item" href="{{ route('halls.edit', $hall) }}">Bewerken</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="level">
        <div class="level-left">
            <h2>Aankomende filmavonden</h2>
        </div>

        <div class="level-right">
            @can('create', App\Models\FilmEvent::class)
                <a href="{{ route('filmevents.create') }}" class="button is-link is-light">Nieuwe filmavond</a>
            @endcan
        </div>
    </div>

    @foreach ($cinema->halls as $hall)
        @forelse ($hall->filmevents as $filmevent)
            <div class="block">
                <p>
                    <strong>{{ $filmevent->movie->name }}</strong><br>
                    <strong>Zaal:</strong> <a href="{{ route('halls.show', $filmevent->hall) }}">{{ $filmevent->hall->name }}</a><br>
                    <strong>Start:</strong> {{ date('d-m-Y H:i', strtotime($filmevent->start)) }}
                </p>
            </div>
        @endforeach
    @empty
        <p>Er zijn nog geen filmavonden!</p>
    @endforelse

    <div class="block">
        @can('update', $cinema)
            <a href="{{ route('cinemas.edit', $cinema) }}">Bewerken</a> |
        @endcan

        <a href="{{ route('cinemas.index') }}">Terug naar het overzicht</a>
    </div>
@endsection
