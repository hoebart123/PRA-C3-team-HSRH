@extends('layouts.app')

@section('content')
<h1>Alle Inschrijvingen</h1>

@foreach($schools as $school)
    <h2>{{ $school->name }} ({{ $school->city }})</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Team</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
        @foreach($school->teams as $team)
            <tr>
                <td>{{ $team->team_name }}</td>
                <td>
                    @if($team->approved)
                        ✔️ Goedgekeurd
                    @else
                        ❌ Niet goedgekeurd
                    @endif
                </td>
                <td>
                    @if(!$team->approved)
                         <form action="{{ route('admin.registrations.approve', $team) }}" method="post" style="display:inline;">
                            @csrf @method('PUT')
                            <button class="btn btn-success">Goedkeuren</button>
                        </form>
                    @endif

                    <a href="{{ route('admin.registrations.edit', $team) }}" class="btn btn-primary">Aanpassen</a>

                    <form action="{{ route('admin.registrations.destroy', $team) }}" method="post" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endforeach

@endsection