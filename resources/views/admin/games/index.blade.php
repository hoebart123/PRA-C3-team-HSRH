@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Wedstrijden Beheren</h1>

        <a href="{{ route('tournaments.generateForm') }}"
           class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
            Schema’s Genereren
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @foreach($tournaments as $tournament)
        <div class="mb-10">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">
                {{ $tournament->naam }}
            </h2>

            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Teams</th>
                            <th class="px-4 py-3">Sport</th>
                            <th class="px-4 py-3">Poule</th>
                            <th class="px-4 py-3">Score</th>
                            <th class="px-4 py-3">Veld</th>
                            <th class="px-4 py-3">Tijd</th>
                            <th class="px-4 py-3">Scheidsrechter</th>
                            <th class="px-4 py-3 text-right">Actie</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($tournament->games as $game)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $game->team1->naam }}
                                    <span class="text-gray-500">
                                        ({{ $game->team1->school->naam }})
                                    </span>
                                    <br>
                                    <span class="text-gray-400">vs</span>
                                    <br>
                                    {{ $game->team2->naam }}
                                    <span class="text-gray-500">
                                        ({{ $game->team2->school->naam }})
                                    </span>
                                </td>

                                <td class="px-4 py-3">{{ $game->sport }}</td>

                                <td class="px-4 py-3">
                                    {{ $game->poule ?? '—' }}
                                </td>

                                <td class="px-4 py-3">
                                    @if($game->score1 !== null && $game->score2 !== null)
                                        <span class="font-semibold">
                                            {{ $game->score1 }} - {{ $game->score2 }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">Niet gespeeld</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    {{ $game->veld ?? '—' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $game->played_at
                                        ? \Carbon\Carbon::parse($game->played_at)->format('H:i')
                                        : '—'
                                    }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $game->scheidsrechter ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('games.edit', $game) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        Bewerk score
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    Geen wedstrijden gevonden
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
