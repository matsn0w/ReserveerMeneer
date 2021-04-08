@extends('layouts.base', [
    'title' => 'Nieuwe filmavond'
])

@section('content')
    <form action="{{ route('filmevents.store') }}" method="post">
        @csrf

        <div class="field">
            <label class="label" for="hall">Zaal</label>

            <div class="select is-fullwidth">
                <select name="hall_id" id="hall">
                    <option selected disabled></option>

                    @foreach ($halls as $hall)
                        <option value="{{ $hall->id }}">{{ $hall->cinema->name }} - {{ $hall->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('hall_id')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="movie">Film</label>

            <div class="select is-fullwidth">
                <select name="movie_id" id="movie">
                    <option selected disabled></option>

                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('movie_id')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="start">Start</label>

            <div class="control">
                <input class="input" type="datetime-local" name="start" id="start">
            </div>

            @error('start')
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
