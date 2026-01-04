<x-base-layout>

<img style="width: 75px; margin-left: -300px;" src="{{ asset('img/logofr.png') }}" alt="Foto" class="logo">

<div class="admin-page">
    <h1 class="admin-title">Archief — Oude deelnemende scholen</h1>

    @if($archivedRegistrations->isEmpty())
        <p>Er staan nog geen inschrijvingen in het archief.</p>
    @else

        <table class="admin-table">
            <thead>
                <tr>
                    <th>School</th>
                    <th>Teams</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($archivedRegistrations as $registration)
                    <tr>
                        <td>{{ $registration->schoolnaam }}</td>

                        <td>
                            <ul>
                                @foreach(json_decode($registration->teams) as $team)
                                    <li>
                                        {{ $team->naam }}
                                        ({{ $team->aantal }} leerlingen)
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                        <td>{{ ucfirst($registration->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>

</x-base-layout>
