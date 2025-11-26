@extends('layouts.base')

@section('content')

<style>
    body main {
        font-family: Arial, sans-serif;
        padding: 20px;
        max-width: 600px;
        margin: auto;
    }
    h1 {
        text-align: center;
    }
    p {
        margin-bottom: 20px;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border-radius: 5px;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    @media (max-width: 400px) {
        body main {
            padding: 10px;
        }
    }
</style>

<h1>Welkom bij Stichting Paastoernooien</h1>

<p>Wij organiseren voetbal- en lijnbaltoernooien voor leerlingen in Bergen op Zoom en omgeving.</p>

<p><a href="#" class="btn">Schrijf je in</a></p>

@endsection
