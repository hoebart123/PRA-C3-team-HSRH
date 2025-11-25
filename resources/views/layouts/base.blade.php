<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('toernooi') }}">Toernooi</a>
            <a href="{{ route('regel') }}">Regels</a>
            <a href="{{ route('beheerder') }}">Beheerders Pagina</a>
            <a href="{{ route('contact') }}">Contact</a>

            @guest
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Registreer</a>
            @endguest

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Log uit</a>
            </form>
            @endauth

        </nav>
    </header>
    <main>

    </main>
    <footer>

    </footer>
</body>
</html>