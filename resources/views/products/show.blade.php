@extends('layout')

@section('title')
    {{ $product->name }}
@endsection

@section('body')
    <div class="max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden border">
        <div class="bg-gray-100 px-6 py-4 border-b">
            <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
        </div>

<div class="bg-gray-100 flex justify-center items-center">
    <img
        src="{{ $product->image_url ?? 'https://via.placeholder.com/700x500?text=Brak+zdjęcia' }}"
        alt="{{ $product->name }}"
        class="w-[700px] h-[500px] object-contain"
        loading="lazy"
    >
</div>

        <div class="p-6 space-y-4">
            <p class="text-blue-600 font-semibold italic text-lg">
                Kategoria: {{ $product->category->name }}
            </p>

            <div>
                <h3 class="font-bold text-gray-700">Opis:</h3>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            <div class="flex items-center justify-between pt-4 border-t">
                <span class="text-3xl font-extrabold text-green-600">{{ $product->price }} zł</span>
                <div class="flex gap-2">
                    @auth
                        @if(auth()->user()->role === 'user')
                            <a href="{{ route('cart.add', ['id' => $product->id, 'redirect' => 'products.index']) }}"
                            class="inline-block text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition font-medium">
                                Do koszyka
                            </a>
                        @endif
                    @endauth

                    @auth
                        @if(in_array(auth()->user()->role, ['admin'], true))
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edytuj</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Na pewno usunąć ten produkt?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                    Usuń
                                </button>
                            </form>
                        @endif
                    @endauth
                    <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Powrót</a>
                </div>
            </div>
        </div>
    </div>
@endsection
