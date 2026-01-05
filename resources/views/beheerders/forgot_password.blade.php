<x-base-layout>
    
<main style="text-align: center;">
    <h1>Wachtwoord vergeten</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('beheerder.password.email') }}">
        @csrf
        <label>Email van uw account:</label>
        <input type="email" name="email" required>

        <button type="submit">Verstuur tijdelijk wachtwoord</button>
    </form>
</main>

</x-base-layout>
