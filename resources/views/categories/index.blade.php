@extends('layout')

@section('title') Kategorie @endsection

@section('body')
    <h1 class="text-2xl font-bold mb-6">Kategorie</h1>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- List of Categories -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Lista Kategorii</h2>
            @if($categories->count() > 0)
                <ul class="bg-white border rounded shadow-sm divide-y">
                    @foreach($categories as $category)
                        <li class="p-4 flex justify-between items-center hover:bg-gray-50">
                            <span class="font-medium">{{ $category->name }}</span>
                            
                            @auth
                                @if(auth()->user()->is_admin)
                                    <form action="{{ route('categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę kategorię?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">Usuń</button>
                                    </form>
                                @endif
                            @endauth
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">Brak kategorii.</p>
            @endif
        </div>

        <!-- Add Category Form (Admin only) -->
        @auth
            @if(auth()->user()->is_admin)
                <div>
                    <div class="bg-gray-50 p-6 rounded-lg border shadow-sm">
                        <h2 class="text-xl font-semibold mb-4">Dodaj Nową Kategorię</h2>
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nazwa Kategorii</label>
                                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2" required>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
                                Dodaj Kategorię
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endauth
    </div>
@endsection
