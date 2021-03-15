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
                <a class="navbar-item" href="{{ route('cinemas.index') }}">Bioscopen</a>
                <a class="navbar-item" href="{{ route('restaurants.index') }}">Restaurants</a>
                <a class="navbar-item" href="{{ route('events.index') }}">Evenementen</a>
                <a class="navbar-item" href="{{ route('movies.index') }}">Films</a>
                <a class="navbar-item" href="{{ route('halls.index') }}">Zalen</a>
            </div>

            {{-- TODO: add later --}}
            {{-- <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary">
                            <strong>Sign up</strong>
                        </a>

                        <a class="button is-light">Log in</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</nav>
