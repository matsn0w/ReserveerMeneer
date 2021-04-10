@extends('layouts.base', [
    'title' => $event->movie->name . ' reserveren'
])

@section('content')
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <p>
                    <strong>Start:</strong> {{ date('d-m-Y \o\m H:i', strtotime($event->start)) }}<br>
                    <strong>Duur: </strong> {{ $event->movie->duration }} min. (eindtijd {{ date('H:i', strtotime($event->endTime())) }})<br>
                    <strong>Bisocoop:</strong> {{ $event->hall->cinema->name }}<br>
                    <strong>Zaal:</strong> {{ $event->hall->name }}<br>
                </p>

                <form method="POST" action="{{ route('filmevents.reserve', $event) }}">
                    @csrf
                    @method('PUT')

                    <div class="is-flex is-justify-content-space-between">
                        <div class="column is-two-fifths p-0 pt-3">
                            @include('components.address-form')
                        </div>

                        <div class="column is-half p-0 pt-3">
                        </div>
                    </div>

                    <div class="container mt-5">
                        <button type="submit" class="button is-primary">Plaats reservering</button>
                        <a class="button is-link is-light" href="{{ route('filmevents.show', $event) }}">Annuleren</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
