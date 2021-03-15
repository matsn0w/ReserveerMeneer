@extends('layouts.base', [
    'title' => 'Restaurants'
])

@section('content')
    <div class="block">
        <a href="{{ route('events.create') }}">Nieuwe zaal</a>
    </div>

    <form class="mb-5" method="get" action="/restaurants/">
        <label class="label" for="filter">Filter: </label>
        <div class="field is-grouped">

            <div class="control select">
                <select name="filter" id="filter" for="filter">
                    <option value="" selected></option>
                    @foreach ($availableCategories as $category)
                        <option value="{{$category->name}}"
                            @if($filter == $category->name) 
                                            selected
                            @endif
                            >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="control">
                <div class="control">
                    <button class="button is-link" type="submit">Submit</button>
                </div>
            </div>

            @error('filter')
                <p class="help is-danger">{{$errors->first('filter')}}</p>
            @enderror
            
        </div>
    </form>

    @foreach($restaurants->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $restaurant)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <h3 class="card-header-title">{{ $restaurant->name }}</h3>
                        </header>

                        <div class="card-content">
                            <div class="content">
                                <p><strong>Categorie:</strong> {{$restaurant->category}}</p>
                                <p>
                                    {{$restaurant->description}}
                                </p>
                            </div>
                        </div>

                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ route('restaurants.show', $restaurant) }}">Bekijken</a>
                            <a class="card-footer-item" href="{{ route('restaurants.edit', $restaurant) }}">Bewerken</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $restaurants->links('vendor.pagination.bulma') }}
@endsection