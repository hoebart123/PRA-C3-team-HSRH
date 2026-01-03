<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body>
<header>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('contact') }}">Contact</a>
        <a href="#">Middelbare school</a>
        <a href="#">Basisschool</a>
        <a href="#">Info</a>
        <a href="{{ route('registrations.create') }}">Inschrijven</a>
        <a href="{{ route('archief.index') }}">Archief</a>

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
            <a href="{{ route('beheerders.profile.edit') }}">Profiel</a>

            <a href="{{ route('beheerder.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Uitloggen
            </a>

            <form id="logout-form" action="{{ route('beheerder.logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @endif
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer style="margin-top: 40px; padding: 20px; background-color: #5B1A8F; color: white; text-align: center;">
    <strong>{{ config('organisatie.naam') }}</strong><br>
    Algemeen e-mailadres:
    <a href="mailto:{{ config('organisatie.email') }}" style="color: white; text-decoration: underline;">
        {{ config('organisatie.email') }}
    </a><br>
    Contactpersoon: {{ config('organisatie.contactpersoon') }}<br>
    KvK-nummer: {{ config('organisatie.kvk') }}
</footer>
</body>
</html>
