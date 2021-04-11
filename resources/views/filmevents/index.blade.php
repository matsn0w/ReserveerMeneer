@extends('layouts.base', [
    'title' => 'Filmavonden'
])

@section('top-right')
    @can('create', App\Models\FilmEvent::class)
        <a class="button is-link is-light" href="{{ route('filmevents.create') }}">Nieuwe filmavond</a>
    @endcan
@endsection

@section('content')
    @foreach($filmevents->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $filmevent)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $filmevent->movie->name }}</p>
                        </header>

                        <div class="card-content">
                            <strong>Bioscoop:</strong> {{ $filmevent->hall->cinema->name }}<br>
                            <strong>Zaal:</strong> {{ $filmevent->hall->name }}<br>
                            <strong>Start:</strong> {{ date('d-m-Y - H:i', strtotime($filmevent->start)) }}<br>
                        </div>

                        <footer class="card-footer">
                            @can('reserve', $filmevent)
                                <a class="card-footer-item" href="{{ route('filmeventreservations.reserve', $filmevent) }}">Reserveren</a>
                            @endcan

                            <a class="card-footer-item" href="{{ route('filmevents.show', $filmevent) }}">Bekijken</a>

                            @can('update', $filmevent)
                                <a class="card-footer-item" href="{{ route('filmevents.edit', $filmevent) }}">Bewerken</a>
                            @endcan
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $filmevents->links('vendor.pagination.bulma') }}
@endsection
