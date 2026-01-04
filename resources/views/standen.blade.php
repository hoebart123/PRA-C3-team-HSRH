<x-base-layout>
<h1>Poule Standen</h1>

@if(empty($standen))
    <p>Er zijn nog geen standen beschikbaar.</p>
@else
    @foreach($standen as $poule => $teams)
        <h2>Poule {{ $poule }}</h2>
        <table class="standen-table">
            <thead>
                <tr>
                    <th>Team</th>
                    <th>Gespeeld</th>
                    <th>Gewonnen</th>
                    <th>Gelijk</th>
                    <th>Verloren</th>
                    <th>Doelpunten</th>
                    <th>Punten</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $stat)
                    <tr>
                        <td>{{ $stat['team']->naam }} ({{ $stat['team']->school->naam }})</td>
                        <td>{{ $stat['gespeeld'] }}</td>
                        <td>{{ $stat['gewonnen'] }}</td>
                        <td>{{ $stat['gelijk'] }}</td>
                        <td>{{ $stat['verloren'] }}</td>
                        <td>{{ $stat['doelpunten_voor'] }} - {{ $stat['doelpunten_tegen'] }}</td>
                        <td><strong>{{ $stat['punten'] }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endif

<style>
    .standen-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 40px;
    }

    .standen-table th, .standen-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .standen-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .standen-table td:first-child {
        text-align: left;
    }

    h2 {
        margin-top: 30px;
        margin-bottom: 10px;
        color: #007BFF;
    }
</style>
</x-base-layout>