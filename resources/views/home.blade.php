@extends('layouts.base')

@section('content')

<h1>Welkom bij Stichting Paastoernooien</h1>

<p>Wij organiseren voetbal- en lijnbaltoernooien voor leerlingen in Bergen op Zoom en omgeving.</p>

<p>
    <a href="{{ route('registrations.create') }}" class="btn-inschrijven">
        Inschrijven
    </a>
</p>
/
@endsection
