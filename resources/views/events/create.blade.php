@extends('layouts.base', [
    'title' => 'Nieuw evenement'
])

@section('content')
    <form action="{{ route('events.store') }}" method="post">
        @csrf

        <div class="field">
            <label class="label" for="name">Naam</label>

            <div class="control">
                <input class="input" type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            @error('name')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="description">Beschrijving</label>

            <div class="control">
                <textarea 
                    class="textarea"
                    name="description" 
                    id="description"> {{ old('description') }} </textarea>

                @error('description')
                    <p class="help is-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="field">
            <label class="label" for="startdate">Start datum</label>

            <div class="control">
                <input class="input" type="date" name="startdate" id="startdate" value="{{ old('startdate', 1) }}" min="1" required>
            </div>

            @error('startdate')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="enddate">Eind datum</label>

            <div class="control">
                <input class="input" type="date" name="enddate" id="enddate" value="{{ old('enddate', 1) }}" min="1" required>
            </div>

            @error('enddate')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="maxPerPerson">Maximaal aantal tickets per persoon</label>

            <div class="control">
                <input class="input" type="number" name="maxPerPerson" id="maxPerPerson" value="{{ old('maxPerPerson', 1) }}" min="1" required>
            </div>

            @error('maxPerPerson')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="{{ route('events.index') }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection