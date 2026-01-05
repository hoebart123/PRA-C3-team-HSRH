<x-base-layout>
    <img style="width: 75px; margin-left: -300px;"
         src="{{ asset('img/logofr.png') }}"
         alt="Logo"
         class="logo">

    <h1>Contact</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="contact-info">
        <h3>Contactgegevens</h3>

        <p>
            Algemeen e-mailadres:
            <a href="mailto:{{ config('organisatie.email') }}">
                {{ config('organisatie.email') }}
            </a>
        </p>

        <p>
            Contactpersoon: {{ config('organisatie.contactpersoon') }}
        </p>

        <p>
            KvK-nummer: {{ config('organisatie.kvk') }}
        </p>
    </div>

    <p>
        Heb je nog vragen? Stel ze hier via het contactformulier en wij nemen zo snel mogelijk contact met je op.
    </p>

    <form class="contact-form" action="{{ route('contact.send') }}" method="POST">
        @csrf

        <label>Naam:</label>
        <input type="text" name="name" placeholder="Naam" required>

        <label>E-mail:</label>
        <input type="email" name="email" placeholder="E-mail" required>

        <label>Bericht:</label>
        <textarea name="message" placeholder="Bericht" required></textarea>

        <button type="submit">Verstuur</button>
    </form>
</x-base-layout>
