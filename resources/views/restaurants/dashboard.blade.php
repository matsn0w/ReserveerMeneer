@extends('layouts.base', [
    'title' => 'Restaurant dashboard'
])

@section('content')
    <form method="GET" action="/dashboard/filter">

        <div class="is-flex flex-wrap">
            <div class="field mr-5">
                <label class="label" for="date">Datum</label>

                <div class="control">
                    <input class="input" type="date" name="date" id="date" value="{{$date}}">
                </div>

                @error('date')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field mr-3">
                <label class="label" for="name">Restaurant</label>

                <div class="control">
                    <input class="input" type="text" name="name" id="name" value="{{$name}}">
                </div>

                @error('name')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="container mt-5">
                <button type="submit" class="button is-primary mt-2">Filter</button>
                <a href="{{ route('dashboard.index') }}" class="button is-primary mt-2">Clear filters</a>
            </div>
        </div>
    </form>

    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <table>
                    <thead>
                        <th>Restaurant</th>
                        <th>Drukte (Aantal reserveringen)</th>
                    </thead>
                    <tbody>
                        @foreach($restaurants as $restaurant)
                        <tr>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->restaurantreservations->where('date', '=', $date)->count()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
