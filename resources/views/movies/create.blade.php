@extends('layouts.base', [
    'title' => 'Nieuwe film'
])

@section('content')
    <form action="{{ route('movies.store') }}" method="post">
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
            <label class="label" for="duration">Duur (in minuten)</label>

            <div class="control">
                <input class="input" type="number" name="duration" id="duration" value="{{ old('duration') }}" min="1" required>
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
