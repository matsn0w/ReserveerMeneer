@extends('layouts.base', [
    'title' => 'Home'
])

@section('content')
    <p>Welkom bij {{ env('APP_NAME') }}!</p>
@endsection
