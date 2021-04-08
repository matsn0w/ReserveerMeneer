@extends('layouts.base', [
    'title' => 'Evenementen en films'
])

@section('content')
    <div class="columns">
        <div class="column">
            <h2>Evenementen</h2>

            <div class="block">
                <a href="{{ route('events.create') }}">Nieuw evenement</a>
            </div>

            @foreach($events->chunk(2) as $chunk)
                <div class="columns">
                    @foreach($chunk as $event)
                        <div class="column">
                            <div class="card mb-3">
                                <header class="card-header">
                                    <p class="card-header-title">{{ $event->name }}</p>
                                </header>

                                <div class="card-content">
                                    <strong>Beschrijving:</strong> {{ $event->description }} <br>
                                    <strong>Startdatum:</strong> {{ date('d-m-Y', strtotime($event->startdate)) }} <br>
                                    <strong>Einddatum:</strong> {{ date('d-m-Y', strtotime($event->enddate)) }}  <br>
                                </div>

                                <footer class="card-footer">
                                    <a class="card-footer-item" href="{{ route('events.show', $event) }}">Bekijken</a>
                                    <a class="card-footer-item" href="{{ route('events.edit', $event) }}">Bewerken</a>
                                </footer>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{ $events->links('vendor.pagination.bulma') }}
        </div>

        <div class="column">
            <h2>Filmavonden</h2>

            <div class="block">
                <a href="{{ route('filmevents.create') }}">Nieuwe filmavond</a>
            </div>

            @foreach($films->chunk(2) as $chunk)
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
                                    <a class="card-footer-item" href="{{ route('filmevents.show', $event) }}">Bekijken</a>
                                    <a class="card-footer-item" href="{{ route('filmevents.edit', $event) }}">Bewerken</a>
                                </footer>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{ $films->links('vendor.pagination.bulma') }}
        </div>
    </div>
@endsection
