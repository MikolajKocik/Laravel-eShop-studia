@extends('layout')

@section('title') 
    {{ $product->name }} 
@endsection

@section('body')
    <div class="max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden border">
        <div class="bg-gray-100 px-6 py-4 border-b">
            <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
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
                    <form action="{{ route('orders.store', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-while px-4 py-2 rounded font-bold hover:bg-green-700">
                            Kup teraz
                        </button> 
                    </form>

                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edytuj</a>
                    <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Powrót</a>
                </div>
            </div>
        </div>
    </div>
@endsection