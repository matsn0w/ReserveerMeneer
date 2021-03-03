@extends('layouts.base', [
    'title' => $hall->name
])

@section('content')
    <div class="content">
        Aantal rijen: {{ $hall->rows }}<br>
        Aantal stoelen per rij: {{ $hall->seatsPerRow }}<br>
        Aantal zitplaatsen: {{ count($hall->seats) }}<br>
        Bioscoop: <a href="{{ route('cinemas.show', $hall->cinema) }}">{{ $hall->cinema->name }}</a>
    </div>
@endsection
