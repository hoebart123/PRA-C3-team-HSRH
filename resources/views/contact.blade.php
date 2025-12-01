<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <h1>Scholen Toernooi</h1>
            <nav>
                <a href="{{ route('home') }}">Home</a>

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
        </div>
    </header>

    <main class="contact-page container">
        <h2>Contact</h2>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <div class="contact-info">
            <h3>Contactgegevens</h3>
            <p>Algemeen e-mailadres: test@schoolentoernooi.nl</p>
            <p>Contactpersoon: Test van Test</p>
            <p>KvK-nummer: 12345678</p>
        </div>

        <p>Heb je nog vragen? Stel ze hier via het contactformulier en wij nemen zo snel mogelijk contact met je op.</p>

        <form class="contact-form" action="{{ route('contact.send') }}" method="POST">
            @csrf
            <label>Naam:</label>
            <input type="text" name="name" placeholder="Naam" required>

            <label>Email:</label>
            <input type="email" name="email" placeholder="E-mail" required>

            <label>Bericht:</label>
            <textarea name="message" placeholder="Bericht" required></textarea>

            <button type="submit">Verstuur</button>
        </form>
    </main>

    <footer>
        &copy; 2025 Scholen Toernooi
    </footer>
</body>
</html>
