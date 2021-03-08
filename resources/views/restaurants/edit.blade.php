@extends('layouts.base', [
    'title' => "'$restaurant->name' bewerken"
])
@section('content')
<div class="container">
    <form method="POST" action="/restaurants/{{$restaurant->id}}">
        @csrf
        @method('PUT')
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child box">
                    <div class="field">
                        <label class="label" for="name">Naam</label>

                        <div class="control">
                            <input class="input" type="text" name="name" id="name" value="{{$restaurant->name}}">
                        </div>

                        @error('name')
                            <p class="help is-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="category">Categorie</label>

                        <div class="control select">
                            <select name="category_id" id="category" for="category">
                                @foreach ($availableCategories as $category)
                                    <option value="{{$category->id}}"

                                        @if($restaurant->category->id == $category->id)
                                            selected
                                        @endif

                                        >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('category_id')
                            <p class="help is-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="description">Beschrijving</label>

                        <div class="control">
                            <textarea class="textarea" name="description" id="description">{{$restaurant->description}}</textarea>
                        </div>

                        @error('description')
                            <p class="help is-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="seats">Aantal stoelen</label>

                        <div class="control">
                            <input class="input" type="number" name="seats" id="seats" value="{{$restaurant->seats}}">
                        </div>

                        @error('seats')
                            <p class="help is-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="tile is-4 is-vertical is-parent">
                <div class="tile is-child box">
                    @include('restaurants.restaurants-hours.edit')
                </div>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Submit</button>
            </div>
        </div>
</form>
</div>
@endsection
