@extends('layout')

@section('title')
    Edycja: {{ $product->name }}
@endsection

@section('body')
    <h1 class="text-xl font-bold mb-4">Edytuj dane produktu</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="max-w-lg space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Nazwa:</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $product->name) }}"
                   class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Kategoria:</label>
            <select name="category_id" class="w-full border rounded p-2 @error('category_id') border-red-500 @enderror">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (int)old('category_id', $product->category_id) === $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Cena:</label>
            <input type="number"
                   step="0.01"
                   min="1"
                   name="price"
                   value="{{ old('price', $product->price) }}"
                   class="w-full border rounded p-2 @error('price') border-red-500 @enderror">
            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Opis:</label>
            <textarea name="description"
                      class="w-full border rounded p-2 h-24 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
            Zapisz zmiany
        </button>
    </form>
@endsection
