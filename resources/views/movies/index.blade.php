@extends('layouts.base', [
    'title' => 'Films'
])

@section('content')
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->name }}</td>
                    <td>
                        <a href="{{ route('movies.show', $movie) }}">Bekijken</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="block">
        <a href="{{ route('movies.create') }}">Nieuwe film</a>
    </div>

    <div class="block">
        {{ $movies->links('vendor.pagination.bulma') }}
    </div>
@endsection
