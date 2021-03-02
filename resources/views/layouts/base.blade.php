<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }} | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</head>
<body>
    <section class="section">
        <h1 class="title">{{ $title }}</h1>

        @yield('content')
    </section>
</body>
</html>
