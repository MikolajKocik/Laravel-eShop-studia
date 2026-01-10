@extends('layout')

@section('title')
    Szczegóły użytkownika
@endsection

@section('body')
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Szczegóły użytkownika</h1>

            <a href="{{ route('people.index') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                Powrót
            </a>
        </div>

        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white border rounded-lg shadow-sm p-6 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-500 text-sm">ID</p>
                    <p class="font-semibold text-lg">{{ $user->id }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Rola</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if($user->role === 'admin') bg-red-100 text-red-700
                        @elseif($user->role === 'assistant') bg-yellow-100 text-yellow-700
                        @else bg-blue-100 text-blue-700 @endif">
                        {{ $user->role ?? 'Brak roli' }}
                    </span>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Imię</p>
                    <p class="font-semibold text-lg">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Email</p>
                    <p class="font-semibold text-lg">{{ $user->email }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Data rejestracji</p>
                    <p class="font-semibold">
                        {{ $user->created_at->format('d.m.Y H:i') }}
                    </p>
                </div>
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="pt-6 border-t flex gap-3 flex-wrap">
                        <a href="#"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                            Zmień rolę
                        </a>

                        @if($user->role !== 'admin')
                            <form action="{{ route('people.destroy', $user->id) }}"
                                method="POST"
                                onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
                                    Usuń użytkownika
                                </button>
                            </form>
                        @else
                            <button type="button"
                                    class="bg-gray-300 text-gray-600 px-4 py-2 rounded cursor-not-allowed"
                                    title="Nie można usuwać administratora">
                                Usuń użytkownika
                            </button>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection
