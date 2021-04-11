<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }} | {{ env('APP_NAME') }}</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
</head>
<body>
    <x-navbar />

    <div class="container">
        <section class="section">
            @if (session()->has('error'))
                <div class="notification is-danger is-light">{{ session('error') }}</div>
            @endif

            @if (session()->has('success'))
                <div class="notification is-success is-light">{{ session('success') }}</div>
            @endif

            <div class="level">
                <div class="level-left">
                    <h1 class="title">{{ $title }}</h1>
                </div>

                <div class="level-right">
                    @yield('top-right')
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="has-text-centered">
                <p>&copy; {{ date('Y') }} Niels van Hal en Bart Scholtus</p>
                <a href="https://github.com/matsn0w/ReserveerMeneer" target="_blank">GitHub</a>
            </div>
        </div>
    </footer>

    <x-logoutform />
</body>
</html>
