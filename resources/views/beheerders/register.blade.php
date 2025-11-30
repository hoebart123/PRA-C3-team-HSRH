@extends('layouts.base')

@section('content')

<style>
    form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
    }

    form h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    form button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    form button:hover {
        background-color: #218838;
        cursor: pointer;
    }

    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }
</style>

<form action="{{ route('beheerder.register.submit') }}" method="POST">
    @csrf
    <h2>Nieuwe Beheerder Registratie</h2>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <label>Naam:</label>
    <input type="text" name="naam" value="{{ old('naam') }}" required>

    <label>School:</label>
    <input type="text" name="school" value="{{ old('school') }}">

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Wachtwoord:</label>
    <input type="password" name="password" required>

    <label>Bevestig wachtwoord:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Registreer</button>
</form>

<p style="text-align:center; margin-top:10px;">
    Na registratie staat je account in afwachting totdat een actieve beheerder deze goedkeurt.
</p>

@endsection
