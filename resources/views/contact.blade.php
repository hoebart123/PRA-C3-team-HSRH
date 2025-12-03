@extends('layouts.base')

@section('content')

<h1>Contact</h1>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<div class="contact-info">
    <h3>Contactgegevens</h3>
    <p>Algemeen e-mailadres: test@schoolentoernooi.nl</p>
    <p>Contactpersoon: Test van Test</p>
    <p>KvK-nummer: 12345678</p>
</div>

<p>Heb je nog vragen? Stel ze hier via het contactformulier en wij nemen zo snel mogelijk contact met je op.</p>

<form class="contact-form" action="{{ route('contact.send') }}" method="POST">
    @csrf
    <label>Naam:</label>
    <input type="text" name="name" placeholder="Naam" required>

    <label>Email:</label>
    <input type="email" name="email" placeholder="E-mail" required>

    <label>Bericht:</label>
    <textarea name="message" placeholder="Bericht" required></textarea>

    <button type="submit">Verstuur</button>
</form>

@endsection
