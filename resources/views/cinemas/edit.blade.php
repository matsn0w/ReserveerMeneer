@extends('layouts.base', [
    'title' => "{$cinema->name} bewerken"
])

@section('top-right')
    <form action="{{ route('cinemas.destroy', $cinema) }}" method="post">
        @csrf
        @method('DELETE')

        <button class="button is-danger is-inverted" type="submit">Verwijderen</button>
    </form>
@endsection

@section('content')
    <form action="{{ route('cinemas.update', $cinema) }}" method="post">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label" for="name">Naam</label>

            <div class="control">
                <input class="input" type="text" name="name" id="name" value="{{ old('name', $cinema->name) }}">
            </div>

            @error('name')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="{{ route('cinemas.show', $cinema) }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection
