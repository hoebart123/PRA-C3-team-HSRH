<x-base-layout>

<style>
/* JE ORIGINELE CSS BLIJFT HIER OOK ALLEMAAL */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
}

h1, h2 {
    text-align: center;
}

form#inschrijfForm {
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

form#inschrijfForm label {
    font-weight: bold;
    display: block;
    margin-top: 15px;
    color: #4B0082;
}

form#inschrijfForm input,
form#inschrijfForm textarea,
form#inschrijfForm select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: vertical;
}

form#inschrijfForm button {
    margin-top: 20px;
    background-color: #4B0082;
    color: #fff;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s ease;
}

form#inschrijfForm button:hover {
    background-color: #6A0DAD;
}

.team-block {
    background: #f0f0f0;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    position: relative;
}

.remove-team {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff4d4f;
    color: #fff;
    border: none;
    padding: 5px 8px;
    border-radius: 50%;
    font-weight: bold;
    cursor: pointer;
    font-size: 0.9em;
    line-height: 1;
}

.remove-team:hover {
    transform: scale(1.2);
}

.registratie-card {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.registratie-info {
    flex: 1;
}

.delete-btn {
    background-color: #ff4d4f;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: inline-block;
}

.delete-btn:hover {
    background-color: #e03e3e;
}

.alert {
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.alert.success {
    background-color: #d1e7dd;
    color: #0f5132;
    border: 1px solid #badbcc;
}

.alert.error {
    background-color: #f8d7da;
    color: #842029;
    border: 1px solid #f5c2c7;
}
</style>

<h1>Inschrijven</h1>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert error">{{ session('error') }}</div>
@endif

<form action="{{ route('registrations.store') }}" method="POST" id="inschrijfForm">
    @csrf

    <!-- School info -->
    <div class="form-group">
        <label for="schoolnaam">Schoolnaam</label>
        <input type="text" name="schoolnaam" id="schoolnaam" required>
    </div>

    <div class="form-group">
        <label for="contactpersoon">Contactpersoon</label>
        <input type="text" name="contactpersoon" id="contactpersoon" required>
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required value="{{ auth()->user()->email }}">
    </div>

    <!-- Scheidsrechter info -->
    <div class="form-group">
        <label for="referee_name">Naam scheidsrechter</label>
        <input type="text" name="referee_name" id="referee_name" required>
    </div>

    <div class="form-group">
        <label for="referee_email">E-mail scheidsrechter</label>
        <input type="email" name="referee_email" id="referee_email" required>
    </div>

    <h2>Teams</h2>
    <div id="teams-container">
        <div class="team-block">
            <label>Teamnaam</label>
            <input type="text" name="teams[0][naam]" required>

            <label>Toernooi</label>
            <select name="teams[0][toernooi]" required>
                <option value="">Selecteer toernooi</option>
                <option value="voetbal_3_4">Voetbal klas 3/4</option>
                <option value="voetbal_5_6">Voetbal klas 5/6</option>
                <option value="voetbal_7_8">Voetbal klas 7/8</option>
                <option value="voetbal_1_jongens">Voetbal 1e klas jongens/gemengd</option>
                <option value="voetbal_1_meiden">Voetbal 1e klas meiden</option>
                <option value="lijnbal_7_8">Lijnbal groep 7/8 meiden</option>
                <option value="lijnbal_1">Lijnbal 1e klas meiden</option>
            </select>

            <label>Aantal leerlingen</label>
            <input type="number" name="teams[0][aantal]" min="1" required>

            <button type="button" class="remove-team">✖</button>
        </div>
    </div>

    <button type="button" id="add-team">+ Team toevoegen</button>
    <button type="submit">Inschrijven</button>
</form>

<hr>

<h2>Jouw inschrijvingen</h2>
@if($registrations->isEmpty())
    <p>Je hebt nog geen inschrijvingen.</p>
@else
    <div class="registraties">
        @foreach($registrations as $reg)
            <div class="registratie-card">
                <div class="registratie-info">
                    <strong>{{ $reg->schoolnaam }}</strong> — Contactpersoon: {{ $reg->contactpersoon }} <br>
                    Scheidsrechter: {{ $reg->referee_name }} ({{ $reg->referee_email }}) <br>
                    @foreach(json_decode($reg->teams) as $team)
                        {{ $team->naam }} ({{ $team->toernooi ?? 'Geen toernooi geselecteerd' }}) — {{ $team->aantal }} leerlingen <br>
                    @endforeach
                </div>
                
                <form action="{{ route('inschrijven.delete', $reg->id) }}" method="POST" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Uitschrijven</button>
                </form>
            </div>
        @endforeach
    </div>
@endif

<script>
let teamIndex = 1;

document.getElementById('add-team').addEventListener('click', function () {
    let container = document.getElementById('teams-container');

    let block = document.createElement('div');
    block.classList.add('team-block');

    block.innerHTML = `
        <label>Teamnaam</label>
        <input type="text" name="teams[${teamIndex}][naam]" required>

        <label>Toernooi</label>
        <select name="teams[${teamIndex}][toernooi]" required>
            <option value="">Selecteer toernooi</option>
            <option value="voetbal_3_4">Voetbal klas 3/4</option>
            <option value="voetbal_5_6">Voetbal klas 5/6</option>
            <option value="voetbal_7_8">Voetbal klas 7/8</option>
            <option value="voetbal_1_jongens">Voetbal 1e klas jongens/gemengd</option>
            <option value="voetbal_1_meiden">Voetbal 1e klas meiden</option>
            <option value="lijnbal_7_8">Lijnbal groep 7/8 meiden</option>
            <option value="lijnbal_1">Lijnbal 1e klas meiden</option>
        </select>

        <label>Aantal leerlingen</label>
        <input type="number" name="teams[${teamIndex}][aantal]" min="1" required>

        <button type="button" class="remove-team">✖</button>
    `;

    container.appendChild(block);
    teamIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-team')) {
        e.target.parentElement.remove();
    }
});
</script>

</x-base-layout>
