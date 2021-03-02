@extends('layouts.base', [
    'title' => 'Restaurant'
])

@section('content') 
    <div class="container">
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child box">
                    <h1 class="title">{{$restaurant->name}}</h1>

                    <p class="is-size-4">
                        {{$restaurant->description}}
                    </p>

                    <p class="is-size-5"><strong>Zitplaatsen: </strong>{{$restaurant->seats}}</p>
                </div>
            </div>
            <div class="tile is-3 is-vertical is-parent">
                <div class="tile is-child box">
                    <p class="subtitle">Openingstijden</p>
                </div>
            </div>
        </div>
    </div>
@endsection