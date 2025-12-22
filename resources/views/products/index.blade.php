@extends('layout')

@section('tytul') Lista Produktów @endsection

@section('tresc')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Produkty w sklepie</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Dodaj produkt</a>
    </div>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Nazwa</th>
                <th class="border border-gray-300 p-2">Kategoria</th>
                <th class="border border-gray-300 p-2">Cena</th>
                <th class="border border-gray-300 p-2 text-center">Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 p-2 text-gray-600 italic">
                        {{ $product->category->name ?? 'Brak kategorii' }}
                    </td>
                    <td class="border border-gray-300 p-2 font-bold">{{ $product->price }} zł</td>
                    <td class="border border-gray-300 p-2 flex justify-center gap-2">
                        <a href="{{ route('products.show', $product->id) }}" class="bg-blue-400 text-white px-2 py-1 rounded text-sm">Pokaż</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edytuj</a>
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?')">
                            @csrf
                            @method('DELETE') 
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection