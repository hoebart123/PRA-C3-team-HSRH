<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            {{-- <a href="{{ route('toernooi') }}">Toernooi</a>
            <a href="{{ route('regel') }}">Regels</a> --}}
            <a href="{{ route('contact') }}">Contact</a>
            <a href="#">Middelbare school</a>
            <a href="#">Basisschool</a>
            <a href="#">Info</a>
            <a href="{{ route('registrations.create') }}">Inschrijven</a>

            @if(!Auth::check() && !Auth::guard('beheerder')->check())
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}">Registreer</a>

            <a href="{{ route('beheerder.login') }}" class="button-inschrijven">
                Beheerder inloggen
            </a>
            <a href="{{ route('beheerder.register') }}" class="button-inschrijven">
                Beheerder registreren
            </a>
            @endif

            @if(Auth::guard('beheerder')->check())
            <a href="{{ route('beheerders.index') }}">Beheerders</a>
            <a href="{{ route ('beheerders.profile.edit') }}">Profiel</a>

            <a href="{{ route('beheerder.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Uitloggen
            </a>

            <form id="logout-form" action="{{ route('beheerder.logout') }}" method="POST">
                @csrf
            </form>
            @endif
        </nav>
    </header>

    <main>
        {{-- Pagina content komt hier --}}
        @yield('content')
    </main>

    <footer>
    </footer>

</body>

</html>
