@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Score Bewerken</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">
            {{ $game->team1->naam }} ({{ $game->team1->school->naam }}) vs {{ $game->team2->naam }} ({{ $game->team2->school->naam }})
        </h2>

        <form action="{{ route('beheerder.games.update', $game) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="score1" class="block text-sm font-medium text-gray-700">{{ $game->team1->naam }}</label>
                    <input type="number" name="score1" id="score1" value="{{ old('score1', $game->score1) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" min="0" required>
                </div>
                <div>
                    <label for="score2" class="block text-sm font-medium text-gray-700">{{ $game->team2->naam }}</label>
                    <input type="number" name="score2" id="score2" value="{{ old('score2', $game->score2) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" min="0" required>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('beheerder.games.index') }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Annuleren</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
            </div>
        </form>
    </div>
</div>
@endsection