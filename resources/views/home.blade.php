<x-base-layout>
<img style="width: 75px; margin-left: -300px;" src="{{ asset('img/logofr.png') }}" alt="Foto" class="logo">
<h1>Welkom bij Stichting Paastoernooien</h1>

<p>Wij organiseren voetbal- en lijnbaltoernooien voor leerlingen in Bergen op Zoom en omgeving.</p>

<p>
    <a href="{{ route('registrations.create') }}" class="btn-inschrijven">
        Inschrijven
    </a>
</p>

<p>
    <a href="{{ route('scores') }}" class="btn-scores">
        Live Scores Bekijken
    </a>
    <a href="{{ route('standen') }}" class="btn-standen">
        Standen Bekijken
    </a>
</p>
</x-base-layout>
