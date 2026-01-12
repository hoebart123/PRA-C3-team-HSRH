<x-base-layout>

<style>
.info-page {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.info-page h1 {
    text-align: center;
    color: #4B0082;
    margin-bottom: 30px;
}

.info-page h2 {
    color: #333;
    margin-top: 30px;
}

.info-page ul {
    margin-left: 20px;
}

.info-page li {
    margin-bottom: 8px;
}

.highlight {
    background: #f3f0ff;
    padding: 15px;
    border-left: 5px solid #4B0082;
    margin: 20px 0;
}
</style>

<div class="info-page">

    <h1>Informatie Paastoernooi</h1>

    <div style="margin-bottom: 20px;">
        <label for="age_group">Selecteer leeftijdsgroep:</label>
        <select id="age_group" onchange="changeAgeGroup(this.value)">
            <option value="placeholder">-- Kies een optie --</option>
            <option value="algemeen" {{ $age_group == 'algemeen' ? 'selected' : '' }}>Algemeen</option>
            <option value="groep34" {{ $age_group == 'groep34' ? 'selected' : '' }}>Groep 3/4</option>
            <option value="groep56" {{ $age_group == 'groep56' ? 'selected' : '' }}>Groep 5/6</option>
            <option value="groep78" {{ $age_group == 'groep78' ? 'selected' : '' }}>Groep 7/8</option>
            <option value="middelbaar" {{ $age_group == 'middelbaar' ? 'selected' : '' }}>Middelbare school</option>
        </select>
    </div>

    <script>
    function changeAgeGroup(ageGroup) {
        window.location.href = '{{ route("informatie", ":age") }}'.replace(':age', ageGroup);
    }
    </script>

    @if($age_group == 'algemeen')
        <h2>⚽ Voetbal – Algemene regels</h2>
        <ul>
            <li>Teams bestaan uit maximaal 7 spelers (6 veldspelers + 1 keeper).</li>
            <li>Wedstrijden duren 2 × 10 minuten.</li>
            <li>Wisselen mag onbeperkt.</li>
            <li>Geen slidings toegestaan.</li>
            <li>De scheidsrechter heeft altijd het laatste woord.</li>
            <li>Bij onsportief gedrag kan een speler of team worden uitgesloten.</li>
        </ul>

        <h2>🏐 Lijnbal – Algemene regels</h2>
        <ul>
            <li>Teams bestaan uit maximaal 8 spelers.</li>
            <li>De bal mag niet worden vastgehouden of gelopen.</li>
            <li>De bal moet over de lijn van de tegenstander worden gespeeld.</li>
            <li>Fysiek contact is niet toegestaan.</li>
            <li>Na een punt serveert het scorende team.</li>
        </ul>
    @elseif($age_group == 'groep34')
        <h2>⚽ Voetbal – Groep 3/4</h2>
        <ul>
            <li>Teams bestaan uit 8 spelers.</li>
            <li>Wedstrijden duren 15 minuten.</li>
            <li>Wisselen mag onbeperkt.</li>
            <li>Geen slidings toegestaan.</li>
            <li>De scheidsrechter heeft altijd het laatste woord.</li>
            <li>Bij onsportief gedrag kan een speler of team worden uitgesloten.</li>
        </ul>

        <h2>🏐 Lijnbal – Groep 3/4</h2>
        <ul>
            <li>Teams bestaan uit 8 spelers.</li>
            <li>Wedstrijden duren 10 minuten.</li>
            <li>De bal mag niet worden vastgehouden of gelopen.</li>
            <li>De bal moet over de lijn van de tegenstander worden gespeeld.</li>
            <li>Fysiek contact is niet toegestaan.</li>
            <li>Na een punt serveert het scorende team.</li>
        </ul>
    @elseif($age_group == 'groep56')
        <h2>⚽ Voetbal – Groep 5/6</h2>
        <ul>
            <li>Teams bestaan uit 10 spelers.</li>
            <li>Wedstrijden duren 15 minuten.</li>
            <li>Wisselen mag onbeperkt.</li>
            <li>Geen slidings toegestaan.</li>
            <li>De scheidsrechter heeft altijd het laatste woord.</li>
            <li>Bij onsportief gedrag kan een speler of team worden uitgesloten.</li>
        </ul>

        <h2>🏐 Lijnbal – Groep 5/6</h2>
        <ul>
            <li>Teams bestaan uit 10 spelers.</li>
            <li>Wedstrijden duren 10 minuten.</li>
            <li>De bal mag niet worden vastgehouden of gelopen.</li>
            <li>De bal moet over de lijn van de tegenstander worden gespeeld.</li>
            <li>Fysiek contact is niet toegestaan.</li>
            <li>Na een punt serveert het scorende team.</li>
        </ul>
    @elseif($age_group == 'groep78')
        <h2>⚽ Voetbal – Groep 7/8</h2>
        <ul>
            <li>Teams bestaan uit 10 spelers.</li>
            <li>Wedstrijden duren 15 minuten.</li>
            <li>Wisselen mag onbeperkt.</li>
            <li>Geen slidings toegestaan.</li>
            <li>De scheidsrechter heeft altijd het laatste woord.</li>
            <li>Bij onsportief gedrag kan een speler of team worden uitgesloten.</li>
        </ul>

        <h2>🏐 Lijnbal – Groep 7/8</h2>
        <ul>
            <li>Teams bestaan uit 10 spelers.</li>
            <li>Wedstrijden duren 10 minuten.</li>
            <li>De bal mag niet worden vastgehouden of gelopen.</li>
            <li>De bal moet over de lijn van de tegenstander worden gespeeld.</li>
            <li>Fysiek contact is niet toegestaan.</li>
            <li>Na een punt serveert het scorende team.</li>
        </ul>
    @elseif($age_group == 'middelbaar')
        <h2>⚽ Voetbal – Middelbare school</h2>
        <ul>
            <li>Jongens: Teams bestaan uit 11 spelers.</li>
            <li>Meisjes: Teams bestaan uit 10 spelers.</li>
            <li>Wedstrijden duren 15 minuten.</li>
            <li>Wisselen mag onbeperkt.</li>
            <li>Geen slidings toegestaan.</li>
            <li>De scheidsrechter heeft altijd het laatste woord.</li>
            <li>Bij onsportief gedrag kan een speler of team worden uitgesloten.</li>
        </ul>

        <h2>🏐 Lijnbal – Middelbare school</h2>
        <ul>
            <li>Jongens: Teams bestaan uit 11 spelers.</li>
            <li>Meisjes: Teams bestaan uit 10 spelers.</li>
            <li>Wedstrijden duren 10 minuten.</li>
            <li>De bal mag niet worden vastgehouden of gelopen.</li>
            <li>De bal moet over de lijn van de tegenstander worden gespeeld.</li>
            <li>Fysiek contact is niet toegestaan.</li>
            <li>Na een punt serveert het scorende team.</li>
        </ul>
    @endif

    <h2>👕 Kleding & materiaal</h2>
    <ul>
        <li>Elk team draagt bij voorkeur dezelfde kleur shirts.</li>
        <li>Sportschoenen verplicht (geen noppen op kunstgras).</li>
        <li>Sieraden zijn niet toegestaan.</li>
    </ul>

    <h2>⏰ Aanwezigheid</h2>
    <ul>
        <li>Teams dienen minimaal 15 minuten voor hun eerste wedstrijd aanwezig te zijn.</li>
        <li>Bij te laat verschijnen kan een wedstrijd verloren worden verklaard.</li>
    </ul>

    <h2>🤝 Fair play</h2>
    <p>
        Respect voor tegenstanders, scheidsrechters en organisatie is verplicht.
        Het toernooi draait om plezier en sportiviteit.
    </p>

    <div class="highlight">
        Wij wensen alle teams veel succes en vooral veel plezier tijdens het Paastoernooi!
    </div>

</div>

</x-base-layout>
