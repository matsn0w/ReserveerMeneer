@extends('layouts.base')

@section('content')
<div class="container">
    <form method="POST" action="/restaurant/{{$restaurant->id}}">
        @csrf
        @method('PUT')
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <div class="tile is-child box">
                    <div class="field">
                        <label class="label" for="name">Name</label>
    
                        <div class="control">
                            <input class="input" type="text" name="name" id="name" value="{{$restaurant->name}}">
                        </div>

                        @error('name')
                            <p class="help is-danger">{{$errors->first('name')}}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="category">Category</label>
    
                        <div class="control select">
                            <select name="category" id="category" for="category">
                                @foreach ($availableCategories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
    
                            @error('category')
                                <p class="help is-danger">{{$errors->first('category')}}</p>
                            @enderror
                        </div>
                    </div>
    
                    <div class="field">
                        <label class="label" for="description">Description</label>
    
                        <div class="control">
                            <textarea class="textarea" name="description" id="description">{{$restaurant->description}}</textarea>
                        </div>

                        @error('description')
                            <p class="help is-danger">{{$errors->first('description')}}</p>
                        @enderror
                    </div>
    
                    <div class="field">
                        <label class="label" for="seats">Seats</label>
    
                        <div class="control">
                            <input class="input" type="text" name="seats" id="seats" value="{{$restaurant->seats}}">
                        </div>

                        @error('seats')
                            <p class="help is-danger">{{$errors->first('seats')}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="tile is-4 is-vertical is-parent">
                <div class="tile is-child box">
                    
                </div>
            </div>
        </div>
        
        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Submit</button>
            </div>
        </div>         
</form>
</div>
@endsection
