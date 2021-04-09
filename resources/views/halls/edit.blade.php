@extends('layouts.base', [
    'title' => "'$hall->name' bewerken"
])

@section('top-right')
    <form action="{{ route('halls.destroy', $hall) }}" method="post">
        @csrf
        @method('DELETE')

        <button class="button is-danger is-inverted" type="submit">Verwijderen</button>
    </form>
@endsection

@section('content')
    <form action="{{ route('halls.update', $hall) }}" method="post">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label" for="cinema">Bioscoop</label>

            <div class="select">
                <select name="cinema_id" id="cinema">
                    <option disabled selected>Kies een bioscoop...</option>

                    @foreach ($cinemas as $cinema)
                        <option value="{{ $cinema->id }}" @if ($cinema->id == $hall->cinema_id) selected @endif>{{ $cinema->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('cinema_id')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="name">Naam</label>

            <div class="control">
                <input class="input" type="text" name="name" id="name" value="{{ old('name', $hall->name) }}" required>
            </div>

            @error('name')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <p>Het is niet mogelijk om het aantal stoelen te bewerken.</p>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="{{ route('halls.index') }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection
