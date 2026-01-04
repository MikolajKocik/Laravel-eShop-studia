@extends('layout')

@section('title') 
    Moje Zamówienia 
@endsection

@section('body')
    <h1 class="text-2xl font-bold mb-6">Moje Zamówienia</h1>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="border border-gray-300 rounded-lg p-6 shadow-sm bg-white">
                    <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-4">
                        <div>
                            <span class="font-bold text-xl">Zamówienie #{{ $order->id }}</span>
                            <span class="text-gray-500 text-sm ml-3">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($order->status == 'Nowe') bg-blue-100 text-blue-800
                                @elseif($order->status == 'Zrealizowane') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                    
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b border-gray-100">
                                <th class="pb-3 pl-2">Produkt</th>
                                <th class="pb-3">Cena</th>
                                <th class="pb-3">Ilość</th>
                                <th class="pb-3 pr-2 text-right">Suma</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-b border-gray-50 last:border-0">
                                    <td class="py-3 pl-2">{{ $item->product->name }}</td>
                                    <td class="py-3">{{ $item->price }} zł</td>
                                    <td class="py-3">{{ $item->quantity }}</td>
                                    <td class="py-3 pr-2 text-right">{{ $item->price * $item->quantity }} zł</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-gray-200">
                                <td colspan="3" class="pt-4 text-right font-bold text-gray-700">Łącznie:</td>
                                <td class="pt-4 pr-2 text-right font-bold text-xl text-blue-600">{{ $order->total_price }} zł</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-10">
            <p class="text-xl text-gray-600 mb-4">Nie masz jeszcze żadnych zamówień.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Zrób zakupy</a>
        </div>
    @endif
@endsection
