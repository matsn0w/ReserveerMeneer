@extends('layouts.base', [
    'title' => "'$event->name' bewerken"
])

@section('top-right')
    <form action="{{ route('events.destroy', $event) }}" method="post">
        @csrf
        @method('DELETE')

        <button class="button is-danger is-inverted" type="submit">Verwijderen</button>
    </form>
@endsection

@section('content')
    <form action="{{ route('events.update', $event) }}" method="post">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label" for="name">Naam</label>

            <div class="control">
                <input class="input" type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required>
            </div>

            @error('name')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="description">Beschrijving</label>

            <div class="control">
                <textarea class="textarea" name="description" id="description">{{$event->description}}</textarea>
            </div>

            @error('description')
                <p class="help is-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="startdate">Startdatum</label>

            <div class="control">
                <input class="input" type="date" name="startdate" id="startdate" value="{{$event->startdate}}">
            </div>

            @error('startdate')
                <p class="help is-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="enddate">Einddatum</label>

            <div class="control">
                <input class="input" type="date" name="enddate" id="enddate" value="{{$event->enddate}}">
            </div>

            @error('enddate')
                <p class="help is-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="maxPerPerson">Maximaal aantal tickets per persoon</label>

            <div class="control">
                <input class="input" type="number" name="maxPerPerson" id="maxPerPerson" value="{{$event->maxPerPerson}}">
            </div>

            @error('maxPerPerson')
                <p class="help is-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="{{ route('events.show', $event) }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection
