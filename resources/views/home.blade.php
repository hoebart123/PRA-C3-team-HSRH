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
    <title>Homepage</title>
</head>
<body>
    <h1>Welkom op de homepage</h1>
    <p>Ga naar onze <a href="{{ route('contact') }}">Contactpagina</a></p>
    <p>Ga naar onze <a href="{{ route('manage') }}">Beheerpagina</a></p>
</body>
</html>
