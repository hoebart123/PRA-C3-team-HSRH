

@section('content')
<div class="container">
    <h1>Inschrijving aanpassen</h1>

    <form action="{{ route('admin.scholen.update', $school) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Schoolnaam</label>
            <input type="text" name="naam" class="form-control" value="{{ $school->naam }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Contactpersoon</label>
            <input type="text" name="contactpersoon" class="form-control" value="{{ $school->contactpersoon }}">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ $school->email }}">
        </div>

        <button class="btn btn-primary">Opslaan</button>
    </form>
</div>

