<x-base-layout>

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
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    form button:hover {
        background-color: #0056b3;
        cursor: pointer;
    }

    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }
</style>

<form method="POST" action="{{ route('beheerder.login.submit') }}">
    @csrf
    <h2>Beheerder Login</h2>


    @if (session('success'))
    <div style="color: green; text-align: center; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required autofocus>

    <label for="password">Wachtwoord</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Inloggen</button>
</form>

</x-base-layout>