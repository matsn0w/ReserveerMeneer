<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item is-size-4" href="{{ route('home') }}">
                <strong>{{ env('APP_NAME' )}}</strong>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbar" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="{{ route('restaurants.index') }}">Restaurants</a>
                <a class="navbar-item" href="{{ route('cinemas.index') }}">Bioscopen</a>

                @can('viewAny', App\Models\Hall::class)
                    <a class="navbar-item" href="{{ route('halls.index') }}">Zalen</a>
                @endcan

                @can('viewAny', App\Models\Movie::class)
                    <a class="navbar-item" href="{{ route('movies.index') }}">Films</a>
                @endcan

                @can('viewAny', App\Models\Event::class)
                    <a class="navbar-item" href="{{ route('events.index') }}">Evenementen</a>
                @endcan

                @can('viewAny', App\Models\FilmEvent::class)
                    <a class="navbar-item" href="{{ route('filmevents.index') }}">Filmavonden</a>
                @endcan
            </div>

            <div class="navbar-end">

                @auth
                    @if (auth()->user()->hasRole('ADMIN'))
                        <a class="navbar-item" href="{{ route('dashboard.index') }}">Dashboard</a>
                    @endif

                    <a class="navbar-item" href="{{ route('reservations.index') }}">Mijn Reserveringen</a>
                @endauth

                <div class="navbar-item">
                    <div class="buttons">
                        @auth
                            <a data-action="logout" class="button is-link" href="{{ route('logout') }}">Log uit</a>
                        @endauth

                        @guest
                            <a class="button is-link" href="{{ route('login') }}">Inloggen</a>
                            <a class="button is-link" href="{{ route('register') }}">Registreren</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
