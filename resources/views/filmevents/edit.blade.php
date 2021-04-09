@extends('layouts.base', [
    'title' => 'Filmavond bewerken'
])

@section('top-right')
    <form action="{{ route('filmevents.destroy', $filmevent) }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit" class="button is-danger is-inverted">Verwijderen</button>
    </form>
@endsection

@section('content')
    <form action="{{ route('filmevents.update', $filmevent) }}" method="post">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label" for="hall">Zaal</label>

            <div class="select is-fullwidth">
                <select name="hall_id" id="hall">
                    <option disabled>Kies een zaal...</option>

                    @foreach ($halls as $hall)
                        <option value="{{ $hall->id }}" @if ($hall->id == old('hall_id', $filmevent->hall->id)) selected @endif>{{ $hall->cinema->name }} - {{ $hall->name }}</option>
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
                    <option disabled>Kies een film...</option>

                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}" @if ($movie->id == old('movie_id', $filmevent->movie->id)) selected @endif>{{ $movie->name }}</option>
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
                <input class="input" type="datetime-local" name="start" id="start" value="{{ date('Y-m-d\TH:i', strtotime(old('start', $filmevent->start))) }}">
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
                <a href="{{ route('filmevents.show', $filmevent) }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection
