@extends('layouts.base', [
    'title' => "'$movie->name' bewerken"
])

@section('top-right')
    <form action="{{ route('movies.destroy', $movie) }}" method="post">
        @csrf
        @method('DELETE')

        <button class="button is-danger is-inverted" type="submit">Verwijderen</button>
    </form>
@endsection

@section('content')
    <form action="{{ route('movies.update', $movie) }}" method="post">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label" for="name">Naam</label>

            <div class="control">
                <input class="input" type="text" name="name" id="name" value="{{ old('name', $movie->name) }}" required>
            </div>

            @error('name')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="duration">Duur (in minuten)</label>

            <div class="control">
                <input class="input" type="number" name="duration" id="duration" value="{{ old('duration', $movie->duration) }}" min="1" required>
            </div>

            @error('duration')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="{{ route('movies.index') }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection
