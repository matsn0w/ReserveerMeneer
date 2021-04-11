@extends('layouts.base', [
    'title' => 'Registreren'
])

@section('content')
    <div class="box">
        <form class="block" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="field">
                <div class="control">
                    <input class="input" type="name" name="name" id="name" placeholder="Volledige naam" value="{{ old('name') }}" autofocus>
                </div>

                @error('name')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" type="email" name="email" id="email" placeholder="E-mailadres" value="{{ old('email') }}" autofocus>
                </div>

                @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" type="phonenumber" name="phonenumber" id="phonenumber" placeholder="Telefoonnummer" value="{{ old('phonenumber') }}" autofocus>
                </div>

                @error('phonenumber')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" type="password" name="password" id="password" placeholder="Wachtwoord">
                </div>

                @error('password')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <input class="input" type="password" name="password_confirmation" id="password_confirmation" placeholder="Wachtwoord herhalen">
                </div>

                @error('password_confirmation')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Registreer</button>
                </div>
            </div>
        </form>

        <p>Heb je al een account? <a href="{{ route('login') }}">Log in!</a></p>
    </div>
@endsection
