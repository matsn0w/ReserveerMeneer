@extends('layouts.base', [
    'title' => $title = __('eventreservation.event'),
])

@push('scripts')
    <script src="{{ asset('js/eventreservation.js') }}" defer></script>
@endpush

@section('top-right')
    <a href="{{ route('eventreservations.locale', [$event->id, 'en']) }}" class="button is-primary is-light">{{__('eventreservation.english')}}</a>
    <a href="{{ route('eventreservations.locale', [$event->id, 'nl']) }}" class="button is-primary is-light">{{__('eventreservation.dutch')}}</a>
@endsection

@section('content')
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h3>{{$event->name}}</h3>

                <p>
                    <strong>{{__('eventreservation.description')}}:</strong> {{ $event->description }}<br>
                    <strong>{{__('eventreservation.startdate')}}:</strong> {{ $event->startdate }}<br>
                    <strong>{{__('eventreservation.enddate')}}:</strong> {{ $event->enddate }}<br>
                    <strong>{{__('eventreservation.maxPerPerson')}}:</strong> {{ $event->maxPerPerson }}</a>
                </p>

                <form method="POST" action="/events/{{$event->id}}/reserve/{{$locale}}">
                    @csrf

                    <div class="columns">
                        <div class="column">
                            @include('components.address-form')
                        </div>

                        <div class="column">
                            <div class="field">
                                <label class="label" for="tickettype">{{__('eventreservation.tickettype')}}</label>

                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="tickettype" id="tickettype" required>
                                            <option value="1">1 dag</option>
                                            <option value="2">2 dagen</option>
                                            <option value="full">Alle dagen</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="startdate">{{__('eventreservation.begindate')}}</label>

                                <div class="control">
                                    <input class="input"
                                        type="date"
                                        name="startdate"
                                        id="startdate"
                                        value="{{$event->startdate}}"
                                        min="{{$event->startdate}}"
                                        max="{{$event->enddate}}"
                                        required
                                        >
                                </div>

                                @error('startdate')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="label" for="enddate">{{__('eventreservation.enddate')}}</label>


                                <div class="control">
                                    <input class="input" type="date" name="enddate" id="enddate_display" value="" disabled>
                                    <input hidden type="date" name="enddate" id="enddate" value="" required>
                                </div>

                                @error('enddate')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="label" for="ticketamount">{{__('eventreservation.ticketamount')}}</label>

                                <div class="control">
                                    <input class="input" min="1" max="" type="number" name="ticketamount" id="ticketamount" value="{{old('ticketamount')}}" required>
                                </div>

                                @error('ticketamount')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="block">
                        <button type="submit" class="button is-primary">{{__('eventreservation.next')}}</button>
                        <a href="{{ route('events.show', $event) }}" class="button is-link is-light">{{__('eventreservation.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
