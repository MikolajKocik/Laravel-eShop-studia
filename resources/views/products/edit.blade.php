@extends('layout')

@section('tresc')
    <h1 class="text-xl font-bold mb-4">Edytuj produkt: {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Kluczowe dla metody update --}}

        <div class="mb-3">
            <label>Nazwa:</label>
            <input type="text" name="name" value="{{ $product->name }}" class="border w-full p-2">
        </div>

        <div class="mb-3">
            <label>Kategoria:</label>
            <select name="category_id" class="border w-full p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Cena:</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="border w-full p-2">
        </div>

        <div class="mb-3">
            <label>Opis:</label>
            <textarea name="description" class="border w-full p-2">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white p-2 rounded">Zapisz zmiany</button>
    </form>
@endsection