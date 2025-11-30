<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Gebruik asset() i.p.v. ../../../ --}}
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

    @guest
        <a href="{{ route('login') }}">Log in</a>
        <a href="{{ route('register') }}">Registreer</a>
        <a href="{{ route('beheerder.login') }}">Beheerder Login</a>
        <a href="{{ route('beheerder.register') }}">Beheerder registreren</a>
    @endguest

    @auth
        @if(auth()->user() instanceof \App\Models\Beheerder)
            <a href="{{ route('beheerders.index') }}">Beheerder Dashboard</a>
        @endif

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Log uit</a>
        </form>
    @endauth
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
