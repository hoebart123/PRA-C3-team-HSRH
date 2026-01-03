<x-base-layout>

@section('content')
<img style="width: 75px; margin-left: -300px;" src="{{ asset('img/logofr.png') }}" alt="Foto" class="logo">
<div class="admin-page">
    <h1 class="admin-title">Archief — Oude deelnemende scholen</h1>

    @if($archivedSchools->isEmpty())
        <p>Er staan nog geen scholen in het archief.</p>
    @else

        <table class="admin-table">
            <thead>
                <tr>
                    <th>School</th>
                    <th>Teams</th>
                    <th>Laatste wijziging</th>
                </tr>
            </thead>

            <tbody>
                @foreach($archivedSchools as $school)
                    <tr>
                        <td>{{ $school->naam }}</td>

                        <td>
                            <ul>
                                @foreach($school->teams as $team)
                                    <li>{{ $team->naam }} ({{ $team->leden }} leden)</li>
                                @endforeach
                            </ul>
                        </td>

                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>
</x-base-layout>