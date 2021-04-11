@extends('layouts.base', [
    'title' => 'Nieuw restaurant maken'
])

@section('content')
    <form method="POST" action="{{ route('restaurants.store') }}">
        @csrf

        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child box">
                    <div class="field">
                        <label class="label" for="name">Naam</label>

                        <div class="control">
                            <input
                                class="input"
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                required>

                            @error('name')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="category">Categorie</label>

                        <div class="select is-fullwidth">
                            <select name="category_id" id="category" for="category">
                                @foreach ($availableCategories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('category')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="description">Beschrijving</label>

                        <div class="control">
                            <textarea
                                class="textarea"
                                name="description"
                                id="description"
                                required>{{ old('description') }}</textarea>

                            @error('description')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="seats">Aantal stoelen</label>

                        <div class="control">
                            <input
                                class="input"
                                type="number"
                                name="seats"
                                id="seats"
                                value="{{ old('seats') }}"
                                min="1"
                                required>

                            @error('seats')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="tile is-4 is-vertical is-parent">
                <div class="tile is-child box">
                    @include('restaurants.hours.create')
                </div>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Opslaan</button>
            </div>

            <div class="control">
                <a href="{{ route('restaurants.index') }}" class="button is-link is-light">Annuleren</a>
            </div>
        </div>
    </form>
@endsection
