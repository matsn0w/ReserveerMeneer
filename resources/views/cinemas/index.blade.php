@extends('layouts.base', [
    'title' => 'Bioscopen'
])

@section('top-right')
    @can('create', App\Models\Cinema::class)
        <a class="button is-link is-light" href="{{ route('cinemas.create') }}">Nieuwe bioscoop</a>
    @endcan
@endsection

@section('content')
    @foreach($cinemas->chunk(4) as $chunk)
        <div class="columns">
            @foreach($chunk as $cinema)
                <div class="column">
                    <div class="card mb-3">
                        <header class="card-header">
                            <p class="card-header-title">{{ $cinema->name }}</p>
                        </header>

                        <div class="card-content">
                            Aantal zalen: {{ count($cinema->halls) }}
                        </div>

                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ route('cinemas.show', $cinema) }}">Bekijken</a>

                            @can('update', $cinema)
                                <a class="card-footer-item" href="{{ route('cinemas.edit', $cinema) }}">Bewerken</a>
                            @endcan
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
