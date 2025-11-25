@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Beheer Inschrijvingen</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border-b">School</th>
                <th class="p-3 border-b">Team</th>
                <th class="p-3 border-b">Status</th>
                <th class="p-3 border-b">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
            <tr class="hover:bg-gray-50">
                <td class="p-3 border-b">{{ $registration->school }}</td>
                <td class="p-3 border-b">{{ $registration->team }}</td>
                <td class="p-3 border-b">
                    {{ $registration->approved ? 'Goedgekeurd' : 'In afwachting' }}
                </td>
                <td class="p-3 border-b flex gap-2">
                    @unless($registration->approved)
                    <form action="{{ route('admin.registrations.approve', $registration) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Goedkeuren</button>
                    </form>
                    @endunless

                    <a href="{{ route('admin.registrations.edit', $registration) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Aanpassen</a>

                    <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze registratie wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Verwijderen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
