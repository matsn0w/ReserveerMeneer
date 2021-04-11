@extends('layouts.base', [
    'title' => 'Bioscoopzalen'
])

@section('top-right')
    @can('create', App\Models\Hall::class)
        <a class="button is-link is-light" href="{{ route('halls.create') }}">Nieuwe zaal</a>
    @endcan
@endsection

@section('content')
    @foreach($halls->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $hall)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $hall->name }}</p>
                        </header>

                        <div class="card-content">
                            Bioscoop: <a href="{{ route('cinemas.show', $hall->cinema) }}">{{ $hall->cinema->name }}</a><br>
                            Aantal stoelen: {{ count($hall->seats) }}
                        </div>

                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ route('halls.show', $hall) }}">Bekijken</a>

                            @can('update', $hall)
                                <a class="card-footer-item" href="{{ route('halls.edit', $hall) }}">Bewerken</a>
                            @endcan
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $halls->links('vendor.pagination.bulma') }}
@endsection
