

@section('content')
<div class="container">
    <h1>Inschrijving goedkeuren</h1>

    <p>Weet je zeker dat je <strong>{{ $school->naam }}</strong> wilt goedkeuren?</p>

    <form method="POST" action="{{ route('admin.registrations.approve', $school) }}">
        @csrf
        @method('PATCH')

        <button class="btn btn-success">Ja, goedkeuren</button>

        <a href="{{ route('admin.scholen.index') }}" class="btn btn-secondary">
            Annuleren
        </a>
    </form>
</div>

