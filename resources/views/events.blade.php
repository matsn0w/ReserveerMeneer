@extends('layouts.base', [
    'title' => 'Evenementen'
])

@section('content')
    <div class="columns">
        <div class="column is-three-quarters">
            @foreach ($events->chunk(2) as $chunk)
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
                                    <a href="{{ route('filmevents.show', $event) }}">Bekijk info</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="column is-one-quarter">
            <form action="{{ route('home.events') }}" method="get">
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select name="sort">
                                <option value="date-asc" @if (request()->sort == 'date-asc') selected @endif>Datum (oplopend)</option>
                                <option value="date-desc" @if (request()->sort == 'date-desc') selected @endif>Datum (aflopend)</option>
                                <option value="name-asc" @if (request()->sort == 'name-asc') selected @endif>Naam (oplopend)</option>
                                <option value="name-desc" @if (request()->sort == 'name-desc') selected @endif>Naam (aflopend)</option>
                            </select>
                        </div>
                    </div>

                    <div class="control">
                        <button type="submit" class="button is-link is-inverted">Sorteren</button>
                    </div>
                </div>
            </form>

            <h3>Filters</h3>
        </div>
    </div>
@endsection
