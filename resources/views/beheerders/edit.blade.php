<x-base-layout>

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

.btn-success {
    background: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.btn-secondary {
    background: #6c757d;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
}

.btn-success:hover { background: #218838; }
.btn-secondary:hover { background: #5a6268; }
</style>

<div class="admin-page">

    <h1 class="admin-title">
        Inschrijving bewerken: {{ $registration->schoolnaam }}
    </h1>

    <form action="{{ route('admin.registrations.update', $registration) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- SCHOOLNAAM --}}
        <div class="form-group">
            <label for="schoolnaam">Schoolnaam</label>
            <input
                type="text"
                id="schoolnaam"
                name="schoolnaam"
                value="{{ old('schoolnaam', $registration->schoolnaam) }}"
                required
            >
        </div>

        {{-- STATUS --}}
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="pending" {{ $registration->status === 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
                <option value="approved" {{ $registration->status === 'approved' ? 'selected' : '' }}>
                    Approved
                </option>
                <option value="rejected" {{ $registration->status === 'rejected' ? 'selected' : '' }}>
                    Rejected
                </option>
            </select>
        </div>

        {{-- KNOPPEN --}}
        <div class="btn-row">

            <a href="{{ route('beheerders.index') }}" class="btn-secondary">
                Terug
            </a>

            <button type="submit" class="btn-success">
                Opslaan
            </button>

        </div>

    </form>

</div>

</x-base-layout>
