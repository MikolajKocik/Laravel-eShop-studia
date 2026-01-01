@extends('layout')

@section('tytul') Strona Główna @endsection

@section('tresc')
    <!-- Hero Section -->
    <div class="text-center py-12 bg-gray-50 rounded-lg mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Witaj w naszym sklepie!</h1>
        <p class="text-xl text-gray-600 mb-8">Najlepsze produkty w najniższych cenach. Sprawdź naszą ofertę już dziś.</p>
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
            Rozpocznij Zakupy
        </a>
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 text-center">
        <div class="p-6 border rounded-lg shadow-sm">
            <div class="text-blue-600 text-4xl mb-4">🚀</div>
            <h3 class="font-bold text-lg mb-2">Szybka Dostawa</h3>
            <p class="text-gray-600">Wysyłamy zamówienia w ciągu 24 godzin.</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm">
            <div class="text-blue-600 text-4xl mb-4">💎</div>
            <h3 class="font-bold text-lg mb-2">Najwyższa Jakość</h3>
            <p class="text-gray-600">Gwarantujemy jakość naszych produktów.</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm">
            <div class="text-blue-600 text-4xl mb-4">🛡️</div>
            <h3 class="font-bold text-lg mb-2">Bezpieczne Zakupy</h3>
            <p class="text-gray-600">Twoje dane są u nas w pełni bezpieczne.</p>
        </div>
    </div>

    <!-- Latest Products Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Najnowsze Produkty</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                        <!-- Placeholder for image -->
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $product->category->name ?? 'Ogólne' }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold text-blue-600">{{ $product->price }} zł</span>
                            <a href="{{ route('products.show', $product->id) }}" class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded">Szczegóły</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('products.index') }}" class="text-blue-600 font-semibold hover:underline">Zobacz wszystkie produkty &rarr;</a>
        </div>
    </div>
@endsection