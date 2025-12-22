@extends('layout')

@section('tytul') Lista Produktów @endsection

@section('tresc')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Nasze produkty</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            Dodaj produkt
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Kategoria</th>
                <th>Cena</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td class="flex gap-2">
                        {{-- Przycisk Edytuj --}}
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">E</a>

                        {{-- Formularz Usuń --}}
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Na pewno?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-1 rounded">X</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection