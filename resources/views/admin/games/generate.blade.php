@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Speelschema genereren</h1>

    <form method="POST" action="{{ route('tournaments.generate') }}">
        @csrf

        <!-- STANDAARD WAARDES -->
        <div class="bg-gray-100 p-4 rounded mb-6">
            <h2 class="font-bold mb-2">Standaard instellingen</h2>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block">Starttijd</label>
                    <input type="time" name="default_start_time" value="09:00" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block">Eindtijd</label>
                    <input type="time" name="default_end_time" value="15:00" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block">Aantal velden</label>
                    <input type="number" name="default_velden" value="2" min="1" class="w-full border rounded p-2">
                </div>
            </div>
        </div>

        <!-- PER CATEGORIE -->
        @foreach($tournaments as $tournament)
            <div class="border rounded p-4 mb-4">
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="tournaments[{{ $tournament->id }}][active]" checked>
                    <h2 class="font-bold text-lg">{{ $tournament->naam }}</h2>
                </div>

                <div class="mt-3 ml-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="tournaments[{{ $tournament->id }}][custom_time]">
                        Eigen tijden / velden gebruiken
                    </label>

                    <div class="grid grid-cols-3 gap-4 mt-3">
                        <div>
                            <label>Starttijd</label>
                            <input type="time" name="tournaments[{{ $tournament->id }}][start_time]" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Eindtijd</label>
                            <input type="time" name="tournaments[{{ $tournament->id }}][end_time]" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label>Velden</label>
                            <input type="number" name="tournaments[{{ $tournament->id }}][velden]" min="1" class="w-full border rounded p-2">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Schema genereren
        </button>
    </form>
</div>
@endsection
