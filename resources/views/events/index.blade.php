@extends('layouts.base', [
    'title' => 'Evenementen'
])

@section('top-right')
    @can('create', App\Model\Event::class)
        <a class="button is-link is-light" href="{{ route('events.create') }}">Nieuw evenement</a>
    @endcan
@endsection

@section('content')
    @foreach($events->chunk(4) as $chunk)
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

                            @can('update', $event)
                                <a class="card-footer-item" href="{{ route('events.edit', $event) }}">Bewerken</a>
                            @endcan
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $events->links('vendor.pagination.bulma') }}
@endsection
