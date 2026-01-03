@extends('layouts.base')

@section('content')

@if(session('success'))
<div style="color: green">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div style="color: red;">
    <div class="error">{{ $errors->first() }}</div>
</div>
@endif

<h1>Profiel bewerken</h1>

<form method="POST" action="{{ route('beheerders.profile.update') }}">
    @csrf
    @method('PATCH')

    <div style="font-weight: bold;"><label>Naam</label></div>
    <input type="text" name="naam" value="{{ $beheerder->naam }}">

    <br><br>

    <div style="font-weight: bold;"><label>Email</label></div>
    <input type="email" name="email" value="{{ $beheerder->email }}">

    <br><br>

    <div style="font-weight: bold;"><label>School</label></div>
    <input type="text" name="school" value="{{ $beheerder->school }}">

    <br><br>

    <div style="font-weight: bold;"><label>Nieuw wachtwoord (optioneel)</label></div>
    <input type="password" name="password">

    <br><br>

    <div style="font-weight: bold;"><label>Wachtwoord bevestigen</label></div>
    <input type="password" name="password_confirmation">

    <br><br>

    <button type="submit">Opslaan</button>
</form>

@endsection
