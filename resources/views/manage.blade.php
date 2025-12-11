@extends('layouts.base')

@section('content')

<style>
    .admin-page {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }

    .admin-title {
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    table.admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 16px;
    }

    table.admin-table thead {
        background: #f1f1f1;
    }

    table.admin-table th,
    table.admin-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #ddd;
    }

    table.admin-table tr:hover {
        background: #fafafa;
    }

    .admin-actions {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 14px;
        border-radius: 6px;
    }

    .btn-primary { background: #007bff; color: white; }
    .btn-success { background: #28a745; color: white; }
    .btn-danger { background: #dc3545; color: white; }
    .btn-primary:hover { background: #0069d9; }
    .btn-success:hover { background: #218838; }
    .btn-danger:hover { background: #c82333; }

</style>


<div class="admin-page">

    <h1 class="admin-title">Inschrijvingen beheer</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="admin-table">
        <thead>
        <tr>
            <th>School</th>
            <th>Teams</th>
            <th>Status</th>
            <th>Acties</th>
        </tr>
        </thead>

        <tbody>

        @foreach($scholen as $school)
            <tr>
                <td>{{ $school->naam }}</td>

                <td>
                    <ul style="padding-left:18px;">
                        @foreach($school->teams as $team)
                            <li>{{ $team->naam }} ({{ $team->leden }} leden)</li>
                        @endforeach
                    </ul>
                </td>

                <td>{{ ucfirst($school->status) }}</td>

                <td>
                    <div class="admin-actions">

                        {{-- GOEDKEUREN --}}
                        @if($school->status === 'pending')
                            <form method="POST" action="{{ route('admin.scholen.approve', $school) }}">
                                @csrf
                                @method('PATCH')
                                <button class="btn-success btn-sm">Goedkeuren</button>
                            </form>
                        @endif

                        {{-- AANPASSEN --}}
                        <a href="{{ route('admin.scholen.edit', $school) }}" class="btn-primary btn-sm">
                            Aanpassen
                        </a>

                        {{-- VERWIJDEREN --}}
                        <form method="POST" action="{{ route('admin.scholen.destroy', $school) }}"
                              onsubmit="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-danger btn-sm">Verwijderen</button>
                        </form>

                    </div>
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>

</div>

@endsection
