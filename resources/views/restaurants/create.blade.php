@extends('layouts.base', [
    'title' => 'Create a restaurant'
]);

@section('content')
    <div class="container">
            <form method="POST" action="/restaurants">
                @csrf

                <div class="field">
                    <label class="label" for="name">Name</label>

                    <div class="control">
                        <input 
                            class="input"
                            type="text"
                            name="name" 
                            id="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <p class="help is-danger">{{$errors->first('name')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="category">Category</label>

                    <div class="control">
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
                        <textarea 
                            class="textarea"
                            name="description" 
                            id="description"> {{ old('description') }} </textarea>

                        @error('description')
                            <p class="help is-danger">{{$errors->first('description')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="seats">Seats</label>

                    <div class="control">
                        <input 
                            class="input"
                            type="number"
                            name="seats" 
                            id="seats"
                            value="{{ old('seats') }}">

                        @error('seats')
                            <p class="help is-danger">{{$errors->first('seats')}}</p>
                        @enderror
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