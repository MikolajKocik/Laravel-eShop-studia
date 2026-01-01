@extends('layout')

@section('tytul') Panel Użytkownika @endsection

@section('tresc')
    <h1 class="text-2xl font-bold mb-6">Panel Użytkownika</h1>

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ __("Zalogowano pomyślnie!") }}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="border p-4 rounded shadow hover:bg-gray-50">
            <h2 class="font-bold text-lg mb-2">Moje Zamówienia</h2>
            <p class="text-gray-600 mb-4">Sprawdź status swoich zamówień i historię zakupów.</p>
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline">Przejdź do zamówień &rarr;</a>
        </div>

        <div class="border p-4 rounded shadow hover:bg-gray-50">
            <h2 class="font-bold text-lg mb-2">Ustawienia Konta</h2>
            <p class="text-gray-600 mb-4">Zmień swoje dane, hasło lub usuń konto.</p>
            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Edytuj profil &rarr;</a>
        </div>
    </div>
@endsection
