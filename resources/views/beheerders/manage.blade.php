<x-base-layout>

<img style="width: 75px; margin-left: -300px;" src="{{ asset('img/logofr.png') }}" alt="Logo" class="logo">

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

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

.actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    flex-wrap: wrap;
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

.btn-archive {
    background-color: #6c757d;
    color: white;
}
</style>

<h1>Inschrijvingen beheer</h1>

@if(session('success'))
    <div class="alert success" style="background:#d4edda;color:#155724;padding:10px;margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif

@forelse($registrations as $registration)
    <div class="management-card">

        <div class="management-header">
            <h2>{{ $registration->schoolnaam }}</h2>
            <span class="status {{ $registration->status }}">
                {{ $registration->status }}
            </span>
        </div>

        <p>
            <strong>Contactpersoon:</strong> {{ $registration->contactpersoon }} <br>
            <strong>E-mail:</strong> {{ $registration->email }} <br>
            <strong>Scheidsrechter:</strong> {{ $registration->referee_name ?? '-' }}
            ({{ $registration->referee_email ?? '-' }})
        </p>

        <ul class="team-list">
            @foreach(json_decode($registration->teams) as $team)
                <li>
                    {{ $team->naam }} — {{ $team->toernooi ?? 'Geen toernooi' }} — {{ $team->aantal }} leerlingen
                </li>
            @endforeach
        </ul>

        <div class="actions">

            {{-- Goedkeuren --}}
            @if($registration->status === 0) {{-- Alleen tonen als status 'pending' is --}}
                <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-approve">Goedkeuren</button>
                </form>
            @endif

            {{-- Bewerken --}}
            <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-edit">
                Aanpassen
            </a>

            {{-- Verwijderen --}}
            <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze inschrijving wilt verwijderen?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Verwijderen</button>
            </form>

            {{-- Archiveren --}}
            <form action="{{ route('admin.registrations.archive', $registration) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze inschrijving wilt archiveren?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-archive">Archiveren</button>
            </form>

        </div>
    </div>

@empty
    <p style="text-align:center;">Geen inschrijvingen gevonden.</p>
@endforelse

</x-base-layout>
