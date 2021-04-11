@extends('layouts.base', [
    'title' => $restaurant->name
])

@section('content')
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <p>{{ $restaurant->description }}</p>

                <p><strong>Categorie:</strong> {{ $restaurant->category->name }}</p>
                <p><strong>Zitplaatsen: </strong>{{ $restaurant->seats }}</p>

                @can('reserve', $restaurant)
                    <a class="button is-primary" href="{{ route('restaurantreservations.reserve', $restaurant->id) }}">Reserveren</a>
                @endcan

                @can('update', $restaurant)
                    <a class="button is-link is-light" href="{{ route('restaurants.edit', $restaurant) }}">Bewerken</a>
                @endcan
            </div>
        </div>

        <div class="tile is-3 is-vertical is-parent">
            <div class="tile is-child box">
                @include('restaurants.hours.show')
            </div>
        </div>
    </div>
@endsection
