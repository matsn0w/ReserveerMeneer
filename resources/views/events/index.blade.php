@extends('layouts.base', [
    'title' => 'Evenementen'
])

@section('content')
    <div class="block">
        <a href="{{ route('events.create') }}">Nieuw evenement</a>
    </div>

    @foreach($events->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $event)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $event->name }}</p>
                        </header>

                        <div class="card-content">
                            <strong>Beschrijving:</strong> {{$event->description}} <br>
                            <strong>Start datum:</strong> {{ $event->startdatum }} <br>
                            <strong>Eind datum:</strong> {{ $event->startdatum }}  <br>
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
@endsection
