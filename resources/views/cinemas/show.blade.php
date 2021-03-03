@extends('layouts.base', [
    'title' => $cinema->name
])

@section('content')
    <div class="content">
        <p>Aantal zalen: {{ count($cinema->halls) }}</p>

        <h2>Zalen</h2>
    </div>

    @foreach($cinema->halls->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $hall)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <h3 class="card-header-title">{{ $hall->name }}</h3>
                        </header>

                        <div class="card-content">
                            <div class="content">
                                Aantal rijen: {{ $hall->rows }}<br>
                                Aantal stoelen per rij: {{ $hall->seatsPerRow }}<br>
                                Aantal zitplaatsen: {{ count($hall->seats) }}
                            </div>
                        </div>

                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ route('halls.show', $hall) }}">Bekijken</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <a href="{{ route('cinemas.edit', $cinema) }}">Bewerken</a> |
    <a href="{{ route('cinemas.index') }}">Terug naar het overzicht</a>
@endsection
