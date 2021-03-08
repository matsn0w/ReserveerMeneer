@extends('layouts.base', [
    'title' => $hall->name
])

@section('content')
    <p>
        Aantal rijen: {{ $hall->rows }}<br>
        Aantal stoelen per rij: {{ $hall->seatsPerRow }}<br>
        Aantal zitplaatsen: {{ count($hall->seats) }}<br>
        Bioscoop: <a href="{{ route('cinemas.show', $hall->cinema) }}">{{ $hall->cinema->name }}</a>
    </p>

    <div class="block">
        <h2>Stoelen</h2>

        <div class="seats">
            @php $counter = 1; @endphp
            @foreach ($hall->seats->chunk($hall->seatsPerRow) as $row)
                <div class="row">
                    <p>Rij {{ $counter++ }}</p>

                    @foreach ($row as $seat)
                        <div class="seat" data-seat-id="{{ $seat->id }}">{{ $seat->number }}</div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <div class="block">
        <a href="{{ route('halls.edit', $hall) }}">Bewerken</a> |
        <a href="{{ route('halls.index') }}">Terug naar overzicht</a>
    </div>
@endsection
