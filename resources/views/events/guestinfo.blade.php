@extends('layouts.base', [
    'title' => 'Evenement'
])

@section('content')
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h3>{{$event->name}}</h3>

                <p>
                    <strong>Beschrijving:</strong> {{ $event->description }}<br>
                    <strong>Start datum:</strong> {{ $event->startdate }}<br>
                    <strong>Eind datum:</strong> {{ $event->enddate }}<br>
                    <strong>Maximaal aantal tickets per persoon:</strong> {{ $event->maxPerPerson }}</a>
                </p>

                <form method="POST" action="/events/{{$event->id}}/reserve" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @for($i = 0; $i < $guestamount; $i++)
                        <div class="my-5">
                        <h2>Gast #{{$i+1}}</h2>

                        <div class="field">
                            <label class="label" for="guests[{{$i}}][name]">Volledige naam</label>
                        
                            <div class="control">
                                <input class="input" type="text" name="guests[{{$i}}][name]" id="guests[{{$i}}][name]" value="" required>
                            </div>
                        
                            @error('guests[{{$i}}][birthdate]')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label" for="guests[{{$i}}][birthdate]">Begindatum</label>

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
                            <label class="label" for="guests[{{$i}}][image]">Afbeelding</label>

                            <div class="control">
                                <input id="guests[{{$i}}][image]" type="file" name="guests[{{$i}}][image]" required>
                            </div>

                            @error('guests[{{$i}}][image]')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        </div>
                    @endfor

                    <div class="container mt-5">
                        <button type="submit" class="button is-primary">Volgende</button>
                        <button class="button is-danger">Annuleer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
