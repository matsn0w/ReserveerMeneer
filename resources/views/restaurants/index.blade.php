@extends('layouts.base', [
    'title' => 'Restaurants'
])

@section('content')
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