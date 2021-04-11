@extends('layouts.base', [
    'title' => 'Restaurants'
])

@section('top-right')
    @can('create', App\Models\Restaurant::class)
        <a class="button is-link is-light" href="{{ route('restaurants.create') }}">Nieuw restaurant</a>
    @endcan
@endsection

@section('content')
    <form class="block" method="get">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="filter">Filter: </label>
            </div>

            <div class="field-body">
                <div class="field is-grouped is-narrow">
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="filter" id="filter" for="filter">
                                <option value=""></option>

                                @foreach ($availableCategories as $category)
                                    <option value="{{$category->id}}" @if ($filter == $category->id) selected @endif>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="control">
                        <button class="button is-link" type="submit">Toepassen</button>
                    </div>
                </div>
            </div>

            @error('filter')
                <p class="help is-danger">{{$errors->first('filter')}}</p>
            @enderror
        </div>
    </form>

    @forelse ($restaurants->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $restaurant)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $restaurant->name }}</p>
                        </header>

                        <div class="card-content">
                            <div class="content">
                                <p><strong>Categorie:</strong> {{$restaurant->category->name}}</p>
                                <p>{{$restaurant->description}}</p>
                            </div>
                        </div>

                        <footer class="card-footer">
                            @can('reserve', $restaurant)
                                <a class="card-footer-item" href="{{ route('restaurantreservations.reserve', $restaurant->id) }}">Reserveren</a>
                            @endcan

                            <a class="card-footer-item" href="{{ route('restaurants.show', $restaurant) }}">Bekijken</a>

                            @can('update', $restaurant)
                                <a class="card-footer-item" href="{{ route('restaurants.edit', $restaurant) }}">Bewerken</a>
                            @endcan
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p>Geen restaurants gevonden.</p>
    @endforelse

    {{ $restaurants->links('vendor.pagination.bulma') }}
@endsection
