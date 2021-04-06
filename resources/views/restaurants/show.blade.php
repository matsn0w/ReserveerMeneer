@extends('layouts.base', [
    'title' => 'Restaurant'
])

@section('content') 
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h1 class="title">{{$restaurant->name}}</h1>

                <div class="section">
                    <p class="is-size-4">
                        {{$restaurant->description}}
                    </p>
                </div>

                <p class="is-size-4"><strong>Category:</strong> {{$restaurant->category->name}}</p>
                <p class="is-size-4"><strong>Zitplaatsen: </strong>{{$restaurant->seats}}</p>

                <a class="button is-primary" href="{{ route('restaurantreservations.reserve', $restaurant->id) }}">Reserveren</a>
                <!-- Authorisatie en Authenticatie op bewerken -->
                <a class="button is-warning">Bewerken</a>     
            </div>
        </div>
        <div class="tile is-3 is-vertical is-parent">
            <div class="tile is-child box">
                @include('restaurants.restaurants-hours.show')
            </div>
        </div>
    </div>
@endsection
