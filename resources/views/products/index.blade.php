@extends('layout')

@section('title')
    Lista Produktów
@endsection

@section('body')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Produkty w sklepie</h1>

        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('products.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    Dodaj produkt
                </a>
            @endif
        @endauth
    </div>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    {{-- GRID KART --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">

                {{-- Obraz --}}
                <div class="h-48 bg-gray-100 overflow-hidden">
                    <img
                        src="{{ $product->image_url ?? 'https://via.placeholder.com/400x300?text=Brak+zdjęcia' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                        loading="lazy"
                    >
                </div>

                {{-- Treść --}}
                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <h3 class="font-bold text-lg mb-2 line-clamp-2">
                            {{ $product->name }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-4">
                            {{ $product->category->name ?? 'Brak kategorii' }}
                        </p>
                    </div>

                    {{-- Cena + akcje --}}
                    <div class="mt-4 text-center">
                        <span class="block font-bold text-blue-600 text-lg mb-3">
                            {{ number_format($product->price, 2) }} zł
                        </span>

                        <div class="flex flex-col gap-2 items-center">
                            {{-- Koszyk: gość lub user --}}
                            @guest
                                <a href="{{ route('cart.add', $product->id) }}"
                                   class="inline-block text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition font-medium">
                                    Do koszyka
                                </a>
                            @endguest

                            @auth
                                @if(auth()->user()->role === 'user')
                                    <a href="{{ route('cart.add', $product->id) }}"
                                       class="inline-block text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition font-medium">
                                        Do koszyka
                                    </a>
                                @endif
                            @endauth

                            <a href="{{ route('products.show', $product->id) }}"
                               class="inline-block text-sm bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded transition w-full sm:w-auto">
                                Szczegóły
                            </a>

                            @auth
                                @if(auth()->user()->is_admin)
                                    <div class="flex gap-2 flex-wrap justify-center">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="inline-block text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow transition font-medium">
                                            Edytuj
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-sm bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow transition font-medium"
                                                    title="Usuń">
                                                Usuń
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8 border-t pt-4">
        {{ $products->links() }}
    </div>
@endsection
