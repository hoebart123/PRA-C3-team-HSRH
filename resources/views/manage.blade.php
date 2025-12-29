<x-base-layout>

<img style="width: 75px; margin-left: -300px;" src="{{ asset('img/logofr.png') }}" alt="Logo" class="logo">

<style>
/* Zelfde basis styling als create page */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

/* Cards ipv tabel */
.management-card {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.management-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.management-header h2 {
    margin: 0;
    color: #4B0082;
}

.status {
    font-weight: bold;
    text-transform: capitalize;
}

.status.pending { color: #d39e00; }
.status.approved { color: #198754; }
.status.archived { color: #6c757d; }

.team-list {
    margin-top: 10px;
}

.team-list li {
    margin-bottom: 5px;
}

/* Actieknoppen */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.actions form,
.actions a {
    margin: 0;
}

.btn {
    padding: 8px 14px;
    border-radius: 5px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.btn-approve {
    background-color: #4B0082;
    color: white;
}

.btn-edit {
    background-color: #0d6efd;
    color: white;
}

.btn-delete {
    background-color: #ff4d4f;
    color: white;
}

.btn:hover {
    opacity: 0.9;
}
</style>

<h1>Inschrijvingen beheer</h1>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

@forelse($scholen as $school)
    <div class="management-card">

        <div class="management-header">
            <h2>{{ $school->naam }}</h2>
            <span class="status {{ $school->status }}">
                {{ $school->status }}
            </span>
        </div>

        <p>
            <strong>Contactpersoon:</strong> {{ $school->contactpersoon }} <br>
            <strong>E-mail:</strong> {{ $school->email }} <br>
            <strong>Scheidsrechter:</strong> {{ $school->referee_name }} ({{ $school->referee_email }})
        </p>

        <ul class="team-list">
            @foreach($school->teams as $team)
                <li>
                    {{ $team->naam }} —
                    {{ $team->toernooi }} —
                    {{ $team->aantal }} leerlingen
                </li>
            @endforeach
        </ul>

        <div class="actions">

            {{-- Goedkeuren --}}
            @if($school->status === 'pending')
                <form action="{{ route('admin.scholen.approve', $school) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-approve">Goedkeuren</button>
                </form>
            @endif

            {{-- Bewerken --}}
            <a href="{{ route('admin.scholen.edit', $school) }}" class="btn btn-edit">
                Aanpassen
            </a>

            {{-- Verwijderen --}}
            <form action="{{ route('admin.scholen.destroy', $school) }}" method="POST"
                  onsubmit="return confirm('Weet je zeker dat je deze inschrijving wilt verwijderen?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-delete">Verwijderen</button>
            </form>

        </div>
    </div>

@empty
    <p style="text-align:center;">Geen inschrijvingen gevonden.</p>
@endforelse

</x-base-layout>
