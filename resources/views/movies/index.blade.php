@extends('layouts.base', [
    'title' => 'Films'
])

@section('top-right')
    @can('create', App\Models\Movie::class)
        <a class="button is-link is-light" href="{{ route('movies.create') }}">Nieuwe film</a>
    @endcan
@endsection

@section('content')
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Duur</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->name }}</td>
                    <td>{{ $movie->duration }} min.</td>
                    <td>
                        <a href="{{ route('movies.show', $movie) }}">Bekijken</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="block">
        {{ $movies->links('vendor.pagination.bulma') }}
    </div>
@endsection
