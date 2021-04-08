@extends('layouts.base', [
    'title' => 'Evenement'
])

@section('scripts')     
    <script type="text/javascript" src="{{ asset('js/eventreservation.js') }}" defer></script>  
@endsection

@section('content') 
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">
                <h3>{{$event->name}}</h3>

                <p>
                    <strong>Beschrijving:</strong> {{ $event->description }}<br>
                    <strong>Start datum:</strong> {{ $event->startdate }}<br>
                    <strong>Eind datum:</strong> {{ $event->enddate }}<br>
                    <strong>Maximaal aantal tickets per persoon:</strong> {{ $event->maxPerPerson }}</a>
                </p>

                <form method="POST" action="/events/{{$event->id}}/reserve">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="event_id" for="event_id" value="{{$event->id}}">

                    <div class="is-flex is-justify-content-space-between">
                        <div class="column is-two-fifths p-0 pt-3">
                            @include('components.address-form')
                        </div>

                        <div class="column is-half p-0 pt-3">
                            <div class="field">
                                <label class="label" for="tickettype">Tickettype</label>
                            
                                <div class="control">
                                    <select class="select" name="tickettype" id="tickettype" required>
                                        <option value="1">1 dag</option>
                                        <option value="2">2 dagen</option>
                                        <option value="full">Alle dagen</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="startdate">Begindatum</label>
                            
                                <div class="control">
                                    <input class="input" 
                                        type="date" 
                                        name="startdate" 
                                        id="startdate" 
                                        value="{{$event->startdate}}"
                                        min="{{$event->startdate}}"
                                        max="{{$event->enddate}}" 
                                        required
                                        >
                                </div>
                            
                                @error('startdate')
                                    <p class="help is-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="label" for="enddate">Einddatum</label>
                                
                                
                                <div class="control">
                                    <input class="input" type="date" name="enddate" id="enddate_display" value="" disabled>
                                    <input hidden type="date" name="enddate" id="enddate" value="" required>
                                </div>
                            
                                @error('enddate')
                                    <p class="help is-danger">{{$message}}</p>
                                @enderror
                            </div> 
                            
                            <div class="field">
                                <label class="label" for="ticketamount">Aantal tickets</label>
                            
                                <div class="control">
                                    <input class="input" min="1" max="" type="number" name="ticketamount" id="ticketamount" value="{{old('ticketamount')}}">
                                </div>
                            
                                @error('ticketamount')
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
    </div>
@endsection
