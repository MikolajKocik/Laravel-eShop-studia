@extends('layout')

@section('body')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Użytkownicy</h1>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('register') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                        Dodaj użytkownika
                    </a>
                @endif
            @endauth
        </div>

        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border border-gray-300 p-4 font-semibold">ID</th>
                    <th class="border border-gray-300 p-4 font-semibold">Imię</th>
                    <th class="border border-gray-300 p-4 font-semibold">Email</th>
                    <th class="border border-gray-300 p-4 font-semibold">Rola</th>
                    <th class="border border-gray-300 p-4 text-center font-semibold">Akcje</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 p-4">{{ $user->id }}</td>
                        <td class="border border-gray-300 p-4">{{ $user->name }}</td>
                        <td class="border border-gray-300 p-4 text-gray-600 italic">{{ $user->email }}</td>
                        <td class="border border-gray-300 p-4 font-semibold">
                            {{ $user->role ?? 'Brak roli' }}
                        </td>

                        <td class="border border-gray-300 p-4">
                            <div class="flex justify-center items-center gap-3 flex-wrap">
                                <a href="{{ route('people.show', $user->id) }}"
                                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded shadow transition text-sm font-medium">
                                    Szczegóły
                                </a>
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('people.changeRole', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded shadow transition text-sm font-medium">
                                                Zmień rolę
                                            </button>
                                        </form>
                                        <form action="{{ route('people.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded shadow transition text-sm font-medium">
                                                Usuń
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
            </tbody>
        </table>

        <div class="mt-8 border-t pt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
