@extends('layouts.base', [
    'title' => $movie->name
])

@section('content')
    <a href="{{ route('movies.edit', $movie) }}">Bewerken</a> |
    <a href="{{ route('movies.index') }}">Terug naar het overzicht</a>
@endsection
