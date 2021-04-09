@extends('layouts.base', [
    'title' => 'Filmavonden'
])

@section('content')
    <div class="block">
        <a href="{{ route('filmevents.create') }}">Nieuwe filmavond</a>
    </div>

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
                            <a class="card-footer-item" href="{{ route('filmevents.show', $filmevent) }}">Bekijken</a>
                            <a class="card-footer-item" href="{{ route('filmevents.edit', $filmevent) }}">Bewerken</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $filmevents->links('vendor.pagination.bulma') }}
@endsection
