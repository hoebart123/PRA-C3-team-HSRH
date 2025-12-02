@extends('layouts.base')

@section('content')

<style>
/* Algemene pagina */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Formulier */
form {
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

form label {
    font-weight: bold;
    display: block;
    margin-top: 15px;
    color: #4B0082;
}

form input,
form textarea,
form select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: vertical;
}

form button {
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

form button:hover {
    background-color: #6A0DAD;
}

/* Teams */
.team-block {
    background: #f0f0f0;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    position: relative;
}

/* Delete button voor teams */
.remove-team {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff4d4f;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 50%;
    font-weight: bold;
    cursor: pointer;
}

.remove-team:hover {
    transform: scale(1.2);
}

/* Registratie kaarten */
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

/* Uitschrijven knop */
.delete-btn {
    background-color: #ff4d4f;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #e03e3e;
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

    <div class="form-group">
        <label for="opmerking">Opmerking (optioneel)</label>
        <textarea name="opmerking" id="opmerking"></textarea>
    </div>

    <h2>Teams</h2>
    <div id="teams-container">
        <div class="team-block">
            <label>Teamnaam</label>
            <input type="text" name="teams[0][naam]" required>

            <label>Sport</label>
            <select name="teams[0][sport]" required>
                <option value="">Selecteer sport</option>
                <option value="Voetbal">Voetbal</option>
                <option value="Lijnbal">Lijnbal</option>
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
                    <strong>{{ $reg->schoolnaam }}</strong> — {{ $reg->contactpersoon }} <br>
                    @foreach(json_decode($reg->teams) as $team)
                        {{ $team->naam }} ({{ $team->sport }}) — {{ $team->aantal }} leerlingen <br>
                    @endforeach
                </div>
                <form action="{{ route('inschrijven.delete', $reg->id) }}" method="POST" style="margin-left: 20px;">
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

        <label>Sport</label>
        <select name="teams[${teamIndex}][sport]" required>
            <option value="">Selecteer sport</option>
            <option value="Voetbal">Voetbal</option>
            <option value="Lijnbal">Lijnbal</option>
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

@endsection
