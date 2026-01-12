<x-base-layout>
<img style="width: 75px; margin-left: -300px;" src="{{ asset('img/logofr.png') }}" alt="Foto" class="logo">

<h1>Inschrijving bewerken</h1>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert error">{{ session('error') }}</div>
@endif

<form action="{{ route('admin.registrations.update', $registration) }}" method="POST" id="inschrijfForm">
    @csrf
    @method('PUT')

    <!-- School info -->
    <div class="form-group">
        <label for="schoolnaam">Schoolnaam</label>
        <input type="text" name="schoolnaam" id="schoolnaam" required value="{{ old('schoolnaam', $registration->schoolnaam) }}">
    </div>

    <div class="form-group">
        <label for="contactpersoon">Contactpersoon</label>
        <input type="text" name="contactpersoon" id="contactpersoon" required value="{{ old('contactpersoon', $registration->contactpersoon) }}">
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required value="{{ old('email', $registration->email) }}">
    </div>

    <!-- Scheidsrechter info -->
    <div class="form-group">
        <label for="referee_name">Naam scheidsrechter</label>
        <input type="text" name="referee_name" id="referee_name" required value="{{ old('referee_name', $registration->referee_name) }}">
    </div>

    <div class="form-group">
        <label for="referee_email">E-mail scheidsrechter</label>
        <input type="email" name="referee_email" id="referee_email" required value="{{ old('referee_email', $registration->referee_email) }}">
    </div>

    <h2>Teams</h2>
    <div id="teams-container">
        @foreach(json_decode($registration->teams) as $i => $team)
        <div class="team-block">
            <label>Teamnaam</label>
            <input type="text" name="teams[{{ $i }}][naam]" required value="{{ old("teams.$i.naam", $team->naam) }}">

            <label>Toernooi</label>
            <select name="teams[{{ $i }}][toernooi]" required>
                <option value="">Selecteer toernooi</option>
                <option value="voetbal_3_4" {{ old("teams.$i.toernooi", $team->toernooi) == 'voetbal_3_4' ? 'selected' : '' }}>Voetbal klas 3/4</option>
                <option value="voetbal_5_6" {{ old("teams.$i.toernooi", $team->toernooi) == 'voetbal_5_6' ? 'selected' : '' }}>Voetbal klas 5/6</option>
                <option value="voetbal_7_8" {{ old("teams.$i.toernooi", $team->toernooi) == 'voetbal_7_8' ? 'selected' : '' }}>Voetbal klas 7/8</option>
                <option value="voetbal_1_jongens" {{ old("teams.$i.toernooi", $team->toernooi) == 'voetbal_1_jongens' ? 'selected' : '' }}>Voetbal 1e klas jongens/gemengd</option>
                <option value="voetbal_1_meiden" {{ old("teams.$i.toernooi", $team->toernooi) == 'voetbal_1_meiden' ? 'selected' : '' }}>Voetbal 1e klas meiden</option>
                <option value="lijnbal_7_8" {{ old("teams.$i.toernooi", $team->toernooi) == 'lijnbal_7_8' ? 'selected' : '' }}>Lijnbal groep 7/8 meiden</option>
                <option value="lijnbal_1" {{ old("teams.$i.toernooi", $team->toernooi) == 'lijnbal_1' ? 'selected' : '' }}>Lijnbal 1e klas meiden</option>
            </select>

            <label>Aantal leerlingen</label>
            <input type="number" name="teams[{{ $i }}][aantal]" min="1" required value="{{ old("teams.$i.aantal", $team->aantal) }}">

            <button type="button" class="remove-team">✖</button>
        </div>
        @endforeach
    </div>

    <button type="button" id="add-team">+ Team toevoegen</button>
    <button type="submit">Bijwerken</button>
</form>

<!-- Voeg dezelfde JS toe als in create voor dynamisch teams toevoegen/verwijderen -->
<script>
let teamsContainer = document.getElementById('teams-container');
let addTeamBtn = document.getElementById('add-team');

addTeamBtn.addEventListener('click', function() {
    let index = teamsContainer.children.length;
    let template = `
    <div class="team-block">
        <label>Teamnaam</label>
        <input type="text" name="teams[${index}][naam]" required>

        <label>Toernooi</label>
        <select name="teams[${index}][toernooi]" required>
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
        <input type="number" name="teams[${index}][aantal]" min="1" required>

        <button type="button" class="remove-team">✖</button>
    </div>
    `;
    teamsContainer.insertAdjacentHTML('beforeend', template);
});

// Event delegation voor verwijderen
teamsContainer.addEventListener('click', function(e) {
    if(e.target.classList.contains('remove-team')) {
        e.target.parentElement.remove();
    }
});
</script>
</x-base-layout>
