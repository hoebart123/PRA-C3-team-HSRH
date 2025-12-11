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


    @guest
        <a href="{{ route('login') }}">Log in</a>
        <a href="{{ route('register') }}">Registreer</a>
    @endguest

   @auth
    @if(auth()->user() instanceof \App\Models\Beheerder)
        <a href="{{ route('beheerders.index') }}">Beheerder Dashboard</a>
    @endif


    <a href="{{ route('logout') }}" "
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Log uit
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
@endauth

</nav>
</header>

<main>
    {{-- Pagina content komt hier --}}
    {{ $slot }}
</main>

<footer>
</footer>

</body>
</html>
