@extends('layouts.base', [
    'title' => 'Restaurant'
])

@section('content') 
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h3>{{$restaurant->name}}</h3>

                <p class="m-0">{{$restaurant->category->name}}</p>
                <p class="m-0">{{$restaurant->seats}} Zitplaatsen</p>

                <form method="POST" action="/restaurants/{{$restaurant->id}}/reserve">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="restaurant_id" for="restaurant_id" value="{{$restaurant->id}}">

                    <div class="is-flex is-justify-content-space-between">
                        <div class="column is-two-fifths p-0 pt-3">
                            @include('components.personal-data-form')
                        </div>

                        <div class="column is-half p-0 pt-3">
                            <div class="field">
                                <label class="label" for="date">Datum</label>
                            
                                <div class="control">
                                    <input class="input" type="date" name="date" id="date" value="" required>
                                </div>
                            
                                @error('date')
                                    <p class="help is-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="label" for="time">Tijd</label>
                            
                                <div class="control">
                                    <input class="input" 
                                        type="time" 
                                        name="time" 
                                        id="time" 
                                        value=""
                                        min=""
                                        max=""
                                        required
                                        >
                                </div>
                            
                                @error('time')
                                    <p class="help is-danger">{{$message}}</p>
                                @enderror
                            </div>  
                            
                            <div class="field">
                                <label class="label" for="groupsize">Aantal personen</label>
                            
                                <div class="control">
                                    <input class="input" min="1" max="{{$restaurant->seats}}" type="number" name="groupsize" id="groupsize" value="{{old('groupsize')}}">
                                </div>
                            
                                @error('groupsize')
                                    <p class="help is-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="container mt-5">
                        <button type="submit" class="button is-primary">Plaats reservering</button>
                        <!-- Authorisatie en Authenticatie op bewerken -->
                        <button class="button is-danger">Annuleer</button>     
                    </div>
                </form>


            </div>
        </div>
        <div class="tile is-3 is-vertical is-parent">
            <div class="tile is-child box">
                @include('restaurants.restaurants-hours.show')
            </div>
        </div>
    </div>
@endsection
