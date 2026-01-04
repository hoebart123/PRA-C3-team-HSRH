@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Wedstrijden Beheren</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teams</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sport</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poule</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($games as $game)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $game->team1->naam }} ({{ $game->team1->school->naam }}) vs {{ $game->team2->naam }} ({{ $game->team2->school->naam }})
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $game->sport }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $game->poule ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($game->score1 !== null && $game->score2 !== null)
                            {{ $game->score1 }} - {{ $game->score2 }}
                        @else
                            Niet gespeeld
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('beheerder.games.edit', $game) }}" class="text-blue-600 hover:text-blue-900">Bewerk Score</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection