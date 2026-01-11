@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Wedstrijd Bewerken</h1>

    <div class="bg-white shadow-md rounded-lg p-6">

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('games.update', $game) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Teams select -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="team1_id" class="block text-sm font-medium text-gray-700">Team 1</label>
                    <select name="team1_id" id="team1_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ $team->id == old('team1_id', $game->team1_id) ? 'selected' : '' }}>
                                {{ $team->naam }} ({{ $team->school->naam }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="team2_id" class="block text-sm font-medium text-gray-700">Team 2</label>
                    <select name="team2_id" id="team2_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ $team->id == old('team2_id', $game->team2_id) ? 'selected' : '' }}>
                                {{ $team->naam }} ({{ $team->school->naam }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Scores -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="score1" class="block text-sm font-medium text-gray-700">Score {{ $game->team1->naam }}</label>
                    <input type="number" name="score1" id="score1" value="{{ old('score1', $game->score1) }}" class="mt-1 block w-full border-gray-300 rounded-md" min="0">
                </div>

                <div>
                    <label for="score2" class="block text-sm font-medium text-gray-700">Score {{ $game->team2->naam }}</label>
                    <input type="number" name="score2" id="score2" value="{{ old('score2', $game->score2) }}" class="mt-1 block w-full border-gray-300 rounded-md" min="0">
                </div>
            </div>

            <!-- Poule, Veld, Scheidsrechter, Tijd -->
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div>
                    <label for="poule" class="block text-sm font-medium text-gray-700">Poule</label>
                    <input type="text" name="poule" id="poule" value="{{ old('poule', $game->poule) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="veld" class="block text-sm font-medium text-gray-700">Veld</label>
                    <input type="text" name="veld" id="veld" value="{{ old('veld', $game->veld) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="scheidsrechter" class="block text-sm font-medium text-gray-700">Scheidsrechter</label>
                    <input type="text" name="scheidsrechter" id="scheidsrechter" value="{{ old('scheidsrechter', $game->scheidsrechter) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="played_at" class="block text-sm font-medium text-gray-700">Tijd</label>
                    <input type="datetime-local" name="played_at" id="played_at" value="{{ old('played_at', $game->played_at->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end">
                <a href="{{ route('games.index') }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Annuleren</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
            </div>
        </form>
    </div>
</div>
@endsection
