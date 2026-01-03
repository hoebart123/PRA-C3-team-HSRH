@extends('layouts.base')

@section('content')

<style>
    body main {
        font-family: Arial, sans-serif;
        padding: 20px;
        max-width: 800px;
        margin: auto;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    .btn {
        display: inline-block;
        padding: 5px 10px;
        background-color: #007BFF;
        color: white;
        border-radius: 3px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-delete {
        background-color: red;
    }

    .status-pending {
        color: orange;
        font-weight: bold;
    }

    .status-active {
        color: green;
        font-weight: bold;
    }
</style>

<h1>Beheerder Dashboard</h1>

<p>Welkom, {{ auth()->user()->naam }}!</p>

<h2>Beheerders</h2>

<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Email</th>
            <th>School</th>
            <th>Superbeheerder</th>
            <th>Status</th>
            @if(auth()->user()->is_super)
                <th>Acties</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($beheerders as $beheerder)
            <tr>
                <td>{{ $beheerder->naam }}</td>
                <td>{{ $beheerder->email }}</td>
                <td>{{ $beheerder->school ?? '-' }}</td>
                <td>{{ $beheerder->is_super ? 'Ja' : 'Nee' }}</td>
                <td>
                    @if($beheerder->is_active)
                        <span class="status-active">Actief</span>
                    @else
                        <span class="status-pending">In afwachting</span>
                    @endif
                </td>
                @if(auth()->user()->is_super)
                    <td>
                        @if(!$beheerder->is_active)
                            <form action="{{ route('beheerders.approve', $beheerder) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">Goedkeuren</button>
                            </form>
                        @endif

                        <form action="{{ route('beheerders.destroy', $beheerder) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Verwijderen</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
