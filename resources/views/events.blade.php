@extends('layouts.base', [
    'title' => 'Evenementen'
])

@section('content')
    <div class="columns">
        <div class="column is-three-quarters">
            @forelse ($events->chunk(2) as $chunk)
                <div class="columns">
                    @foreach ($chunk as $event)
                        <div class="column">
                            <div class="block">
                                @if ($event instanceof App\Models\Event)
                                    <h3>Evenement: {{ $event->name }}</h3>
                                    <strong>Start: </strong> {{ date('d-m-Y', strtotime($event->startdate)) }}<br>
                                    <strong>Eind: </strong> {{ date('d-m-Y', strtotime($event->enddate)) }}<br>
                                    <a href="{{ route('events.show', $event) }}">Bekijk info</a>
                                @else
                                    <h3>Film: {{ $event->movie->name }}</h3>
                                    <strong>Start: </strong> {{ date('d-m-Y \o\m H:i', strtotime($event->start)) }}<br>
                                    <strong>Bioscoop: </strong> {{ $event->hall->cinema->name }}<br>
                                    <a href="{{ route('filmevents.show', $event) }}">Bekijk info</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <p>Er zijn geen evenementen gepland!</p>
            @endforelse
        </div>

        <div class="column is-one-quarter">
            <nav class="panel">
                <p class="panel-heading">Filters</p>

                <form action="{{ route('home.events') }}" method="get">
                    <div class="panel-block">
                        <div class="field">
                            <label class="label" for="sort">Sorteren</label>

                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select name="sort">
                                        <option value="date-asc" @if (request()->sort == 'date-asc') selected @endif>Datum (oplopend)</option>
                                        <option value="date-desc" @if (request()->sort == 'date-desc') selected @endif>Datum (aflopend)</option>
                                        <option value="name-asc" @if (request()->sort == 'name-asc') selected @endif>Naam (oplopend)</option>
                                        <option value="name-desc" @if (request()->sort == 'name-desc') selected @endif>Naam (aflopend)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-block">
                        <div class="field">
                            <label class="label" for="dateFrom">Van</label>

                            <div class="control">
                                <input class="input" type="date" name="dateFrom" id="dateFrom" @if (request()->filled('dateFrom')) value="{{ request()->dateFrom }}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="panel-block">
                        <div class="field">
                            <label class="label" for="dateTill">Tot</label>

                            <div class="control">
                                <input class="input" type="date" name="dateTill" id="dateTill" @if (request()->filled('dateTill')) value="{{ request()->dateTill }}" @endif>
                            </div>
                        </div>
                    </div>

                    <div class="panel-block">
                        <div class="field">
                            <label class="label">Locatie</label>

                            @foreach ($locations as $location)
                                @php
                                    $selected = false;

                                    if (request()->filled('location')) {
                                        $selected = in_array($location->id, request()->location);
                                    }
                                @endphp

                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox" name="location[]" value="{{ $location->id }}" @if ($selected) checked @endif>{{ $location->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel-block">
                        <button class="button is-link is-outlined is-fullwidth">Filteren</button>
                    </div>
                </form>
            </nav>
        </div>
    </div>
@endsection
