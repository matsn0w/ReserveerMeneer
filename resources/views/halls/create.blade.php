@extends('layouts.base', [
    'title' => 'Nieuwe zaal'
])

@section('content')
    <form action="{{ route('halls.store') }}" method="post">
        @csrf

        <div class="field">
            <label class="label" for="cinema">Bioscoop</label>

            <div class="select is-fullwidth">
                <select name="cinema_id" id="cinema">
                    <option disabled selected>Kies een bioscoop...</option>

                    @foreach ($cinemas as $cinema)
                        <option value="{{ $cinema->id }}" @if ($cinema->id == old('cinema_id')) selected @endif>{{ $cinema->name }}</option>
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
                <input class="input" type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            @error('name')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="rows">Aantal rijen</label>

            <div class="control">
                <input class="input" type="number" name="rows" id="rows" value="{{ old('rows', 1) }}" min="1" required>
            </div>

            @error('rows')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="seatsPerRow">Aantal stoelen per rij</label>

            <div class="control">
                <input class="input" type="number" name="seatsPerRow" id="seatsPerRow" value="{{ old('seatsPerRow', 1) }}" min="1" required>
            </div>

            @error('seatsPerRow')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

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
