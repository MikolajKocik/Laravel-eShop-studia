@extends('layout')

@section('tytul') Edycja: {{ $product->name }} @endsection

@section('tresc')
    <h1 class="text-xl font-bold mb-4">Edytuj dane produktu</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="max-w-lg space-y-4">
        @csrf
        @method('PUT') 

        <div>
            <label class="block mb-1">Nazwa:</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Kategoria:</label>
            <select name="category_id" class="w-full border rounded p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

<<<<<<< HEAD
        <div>
            <label class="block mb-1">Cena:</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Opis:</label>
            <textarea name="description" class="w-full border rounded p-2 h-24">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Zapisz zmiany</button>
    </form>
@endsection