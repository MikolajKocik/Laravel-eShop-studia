@extends('layout')
@section('tresc')
    <h1 class="text-xl font-bold mb-4">Nowy Produkt</h1>
    <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label>Nazwa:</label>
            <input type="text" name="name" class="border w-full p-2" value="{{ old('name') }}">
            @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Kategoria:</label>
            <select name="category_id" class="border w-full p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Cena:</label>
            <input type="number" step="0.01" name="price" class="border w-full p-2">
        </div>
        <div>
            <label>Opis:</label>
            <textarea name="description" class="border w-full p-2"></textarea>
        </div>
        <button type="submit" class="bg-green-600 text-white p-2 rounded">Dodaj produkt</button>
    </form>
@endsection