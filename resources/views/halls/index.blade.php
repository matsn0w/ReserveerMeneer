@extends('layouts.base', [
    'title' => 'Bioscoopzalen'
])

@section('content')
    @foreach($halls->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $hall)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <h3 class="card-header-title">{{ $hall->name }}</h3>
                        </header>

                        <div class="card-content">
                            <div class="content">
                                Bioscoop: <a href="{{ route('cinemas.show', $hall->cinema) }}">{{ $hall->cinema->name }}</a><br>
                                Aantal stoelen: {{ count($hall->seats) }}
                            </div>
                        </div>

                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ route('halls.show', $hall) }}">Bekijken</a>
                            <a class="card-footer-item" href="#edit">Bewerken</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $halls->links('vendor.pagination.bulma') }}
@endsection
