@extends('layouts.base', [
    'title' => 'Inloggen'
])

@section('content')
    <div class="box">
        <form class="block" action="{{ route('login') }}" method="POST">
            @csrf

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
                    <input class="input" type="password" name="password" id="password" placeholder="Wachtwoord">
                </div>

                @error('password')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="remember" id="remember" @if(old('remember')) checked @endif>
                        Houd mij ingelogd
                    </label>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Inloggen</button>
                </div>
            </div>
        </form>

        <p>Nog geen account? <a href="{{ route('register') }}">Registreer je hier!</a></p>
    </div>
@endsection
