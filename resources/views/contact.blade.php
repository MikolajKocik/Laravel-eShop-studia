@extends('layout') 

@section('title')
    Kontakt
@endsection

@section('body')
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Strona kontaktowa</h1>
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <p class="text-lg text-gray-600 mb-4">Masz pytania? Skontaktuj się z nami!</p>
            <div class="flex items-center gap-2 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <a href="mailto:sklep@example.com" class="font-semibold hover:underline">sklep@example.com</a>
            </div>
        </div>
    </div>
@endsection