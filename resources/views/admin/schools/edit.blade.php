@extends('layouts.base')

@section('content')

<style>
    .admin-page {
        max-width: 700px;
        margin: 40px auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }

    .admin-title {
        font-size: 28px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"], select {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .btn-row {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }

    .btn-primary { background: #007bff; color: white; padding: 10px 20px; border-radius: 6px; text-decoration:none; }
    .btn-success { background: #28a745; color: white; padding: 10px 20px; border-radius: 6px; }
    .btn-secondary { background: #6c757d; color: white; padding: 10px 20px; border-radius: 6px; }
    .btn-primary:hover { background: #0069d9; }
    .btn-success:hover { background: #218838; }
    .btn-secondary:hover { background: #5a6268; }
</style>


<div class="admin-page">

    <h1 class="admin-title">Schoolbewerking: {{ $school->naam }}</h1>

    <form action="{{ route('admin.scholen.update', $school) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- SCHOOLNAAM --}}
        <div class="form-group">
            <label for="naam">Schoolnaam</label>
            <input type="text" id="naam" name="naam" value="{{ old('naam', $school->naam) }}" required>
        </div>

        {{-- STATUS --}}
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="pending" {{ $school->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $school->status === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $school->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        {{-- KNOPPEN --}}
        <div class="btn-row">

            <a href="{{ route('admin.scholen.index') }}" class="btn-secondary">
                Terug
            </a>

            <button type="submit" class="btn-success">
                Opslaan
            </button>

        </div>

    </form>

</div>

@endsection
