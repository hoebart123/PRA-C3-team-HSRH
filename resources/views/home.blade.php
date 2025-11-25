<!DOCTYPE html>
<html lang="en">
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('home') }}
        </h2>
    </x-slot>
    </x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stichting Paastoernooien</title>
    <style>
        body {
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
            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Welkom bij Stichting Paastoernooien</h1>

    <p>Wij organiseren voetbal- en lijnbaltoernooien voor leerlingen in Bergen op Zoom en omgeving.</p>

    <p><a href="#" class="btn">Schrijf je in</a></p>

    <p>Ga naar onze <a href="{{ route('contact') }}">Contactpagina</a></p>
    <p>Ga naar onze <a href="{{ route('manage') }}">Beheerpagina</a></p>
</body>
</html>
