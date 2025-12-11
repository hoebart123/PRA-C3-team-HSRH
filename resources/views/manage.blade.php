<x-base-layout>

<div class="container">

    <h1 class="mb-4">Inschrijvingen beheer</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>School</th>
                <th>Teams</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>

        <tbody>
        @foreach($scholen as $school)
            <tr>
                <td>{{ $school->naam }}</td>

                <td>
                    <ul>
                        @foreach($school->teams as $team)
                            <li>{{ $team->naam }} ({{ $team->leden }} leden)</li>
                        @endforeach
                    </ul>
                </td>

                <td>{{ ucfirst($school->status) }}</td>

                <td class="d-flex gap-2">

                    {{-- GOEDKEUREN --}}
                    @if($school->status === 'pending')
                        <form action="{{ route('admin.scholen.approve', $school) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Goedkeuren</button>
                        </form>
                    @endif

                    {{-- AANPASSEN --}}
                    <a href="{{ route('admin.scholen.edit', $school) }}" class="btn btn-primary btn-sm">
                        <button class="btn btn-danger btn-sm">Aanpassen</button>
                    </a>

                    {{-- VERWIJDEREN --}}
                    <form action="{{ route('admin.scholen.destroy', $school) }}" method="POST"
                          onsubmit="return confirm('Weet je zeker dat je wilt verwijderen?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Verwijderen</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

<x-base-layout>

