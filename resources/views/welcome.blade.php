@extends('layout')

@section('title')
    Bucik
@endsection

@section('body')
    <!-- Hero Section -->
    <div class="text-center py-12 bg-gray-50 rounded-lg mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4 text-lg">Witaj w e-Bucik!</h1>
        <p class="text-xl text-gray-600 mb-8">Najlepsze buty w najniższych cenach. Sprawdź naszą ofertę już dziś.</p>
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
            Rozpocznij Zakupy
        </a>
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="p-6 border rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-lg mb-2">Szybka Dostawa</h3>
            <p class="text-gray-600">Wysyłamy zamówienia w ciągu 24 godzin.</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-lg mb-2">Najwyższa Jakość</h3>
            <p class="text-gray-600">Gwarantujemy jakość naszych produktów.</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm text-center">
            <h3 class="font-bold text-lg mb-2">Bezpieczne Zakupy</h3>
            <p class="text-gray-600">Twoje dane są u nas w pełni bezpieczne.</p>
        </div>
    </div>

    <!-- Latest Products Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2 py-6">Najnowsze Produkty</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <div class="h-48 bg-gray-100 overflow-hidden">
                        <img
                            src="{{ $product->image_url ?? 'https://via.placeholder.com/400x300?text=Brak+zdjęcia' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                    </div>
                    <div class="p-6 flex flex-col justify-between flex-1">
                        <div>
                            <h3 class="font-bold text-lg mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-4">
                                {{ $product->category->name ?? 'Ogólne' }}
                            </p>
                        </div>
                        <div class="mt-4 text-center">
                            <span class="block font-bold text-blue-600 text-lg mb-2">
                                {{ number_format($product->price, 2) }} zł
                            </span>

                            <a href="{{ route('products.show', $product->id) }}"
                            class="inline-block text-sm bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded transition">
                                Szczegóły
                            </a>
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
