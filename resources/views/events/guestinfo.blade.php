@extends('layouts.base', [
    'title' => $title = __('eventreservation.event'),
])

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

                <form method="POST" action="/events/{{$event->id}}/reserve" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @for($i = 0; $i < $guestamount; $i++)
                        <div class="my-5">
                        <h2>{{__('eventreservation.guest')}} #{{$i+1}}</h2>

                        <div class="field">
                            <label class="label" for="guests[{{$i}}][name]">{{__('eventreservation.fullname')}}</label>
                        
                            <div class="control">
                                <input class="input" type="text" name="guests[{{$i}}][name]" id="guests[{{$i}}][name]" value="" required>
                            </div>
                        
                            @error('guests[{{$i}}][birthdate]')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label" for="guests[{{$i}}][birthdate]">{{__('eventreservation.birthdate')}}</label>

                            <div class="control">
                                <input class="input"
                                    type="date"
                                    name="guests[{{$i}}][birthdate]"
                                    id="guests[{{$i}}][birthdate]"
                                    required
                                    >
                            </div>

                            @error("guests[{{$i}}][birthdate]")
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div class="field">
                            <label class="label" for="guests[{{$i}}][image]">{{__('eventreservation.image')}}</label>

                            <div class="control">
                                <label for="guests[{{$i}}][image]" class="button">{{__('eventreservation.choose_file')}}</label>
                                <input id="guests[{{$i}}][image]" style="display:none" type="file" name="guests[{{$i}}][image]" onchange="document.getElementById('guests[{{$i}}][image].filename').innerHTML = this.files[0].name" required>
                                <label id="guests[{{$i}}][image].filename"></label>
                            </div>

                            @error('guests[{{$i}}][image]')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        </div>
                    @endfor

                    <div class="container mt-5">
                        <button type="submit" class="button is-primary">{{__('eventreservation.next')}}</button>
                        <button class="button is-danger">{{__('eventreservation.cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


