@extends('layout')

@section('tytul') Twój Koszyk @endsection

@section('tresc')
    <h1 class="text-2xl font-bold mb-6">Twój Koszyk</h1>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if(session('cart'))
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">Produkt</th>
                    <th class="border border-gray-300 p-2">Cena</th>
                    <th class="border border-gray-300 p-2">Ilość</th>
                    <th class="border border-gray-300 p-2">Suma</th>
                    <th class="border border-gray-300 p-2">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr rowId="{{ $id }}">
                        <td class="border border-gray-300 p-2">
                            <div class="flex items-center gap-4">
                                @if(isset($details['image']))
                                    <img src="{{ $details['image'] }}" class="w-16 h-16 object-cover" />
                                @endif
                                <span>{{ $details['name'] }}</span>
                            </div>
                        </td>
                        <td class="border border-gray-300 p-2">{{ $details['price'] }} zł</td>
                        <td class="border border-gray-300 p-2">
                            <div class="flex items-center justify-center">
                                {{ $details['quantity'] }}
                            </div>
                        </td>
                        <td class="border border-gray-300 p-2 text-center">{{ $details['price'] * $details['quantity'] }} zł</td>
                        <td class="border border-gray-300 p-2 text-center">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="text-red-600 hover:text-red-900">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right p-4 font-bold text-xl">
                        Razem: {{ $total }} zł
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right p-4">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Kontynuuj zakupy</a>
                        <form action="{{ route('orders.store') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Złóż zamówienie</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
    @else
        <div class="text-center py-10">
            <p class="text-xl text-gray-600 mb-4">Twój koszyk jest pusty.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Wróć do sklepu</a>
        </div>
    @endif
@endsection
