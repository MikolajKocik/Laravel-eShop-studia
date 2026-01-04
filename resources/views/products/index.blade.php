@extends('layout')

@section('title') 
    Lista Produktów 
@endsection

@section('body')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Produkty w sklepie</h1>
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Dodaj produkt</a>
            @endif
        @endauth
    </div>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300 shadow-sm">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border border-gray-300 p-4 font-semibold">Nazwa</th>
                <th class="border border-gray-300 p-4 font-semibold">Kategoria</th>
                <th class="border border-gray-300 p-4 font-semibold">Cena</th>
                <th class="border border-gray-300 p-4 text-center font-semibold">Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 p-4">{{ $product->name }}</td>
                    <td class="border border-gray-300 p-4 text-gray-600 italic">
                        {{ $product->category->name ?? 'Brak kategorii' }}
                    </td>
                    <td class="border border-gray-300 p-4 font-bold text-lg">{{ $product->price }} zł</td>
                    <td class="border border-gray-300 p-4">
                        <div class="flex justify-center items-center gap-3 flex-wrap">
                            <a href="{{ route('cart.add', $product->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded shadow transition text-sm font-medium">Do koszyka</a>
                            <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded shadow transition text-sm font-medium">Szczegóły</a>
                            
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded shadow transition text-sm font-medium">Edytuj</a>
                                    
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?')" class="inline">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded shadow transition text-sm font-medium" title="Usuń">Usuń</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- pagination -->
    <div class="mt-8 border-t pt-4">
        {{ $products->links() }}
    </div>
@endsection