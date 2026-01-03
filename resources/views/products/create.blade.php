@extends('layout')

@section('title') 
    Dodaj Nowy Produkt 
@endsection

@section('body')
    <h1 class="text-xl font-bold mb-4">Dodawanie produktu</h1>

    <form action="{{ route('products.store') }}" method="POST" class="max-w-lg space-y-4">
        @csrf 

        <div>
            <label class="block mb-1">Nazwa produktu:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Kategoria:</label>
            <select name="category_id" class="w-full border rounded p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Cena (zł):</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block mb-1">Opis:</label>
            <textarea name="description" class="w-full border rounded p-2 h-24">{{ old('description') }}</textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">Zapisz produkt</button>
        <a href="{{ route('products.index') }}" class="block text-center text-gray-500 mt-2">Powrót</a>
    </form>
@endsection