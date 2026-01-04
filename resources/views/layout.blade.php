<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'eShop')</title> <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 items-center min-h-screen flex-col">
        
        <header class="w-full lg:max-w-4xl mb-6 flex justify-between items-center">
            <div class="font-bold text-xl">eShop</div>
            <nav class="flex gap-4 items-center">
                <a href="/" class="hover:text-blue-600">Strona główna</a>
                <a href="{{ route('products.index') }}" class="hover:text-blue-600">Produkty</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600">Kontakt</a>
                
                @auth
                    <a href="{{ route('categories.index') }}" class="hover:text-blue-600">Kategorie</a>
                    <a href="{{ route('cart.index') }}" class="hover:text-blue-600 font-bold">
                        Koszyk ({{ count(session('cart', [])) }})
                    </a>
                    <a href="{{ route('orders.index') }}" class="hover:text-blue-600">Moje Zamówienia</a>
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Panel</a>

                    @if(auth()->user()->is_admin)
                        <div class="relative group">
                            <button class="hover:text-blue-600 font-semibold flex items-center">
                                Admin <span class="ml-1">▼</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden group-hover:block z-10">
                                <a href="{{ route('products.create') }}" class="block px-4 py-2 hover:bg-gray-100">Dodaj Produkt</a>
                                <a href="{{ route('categories.index') }}" class="block px-4 py-2 hover:bg-gray-100">Zarządzaj Kategoriami</a>
                            </div>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Wyloguj</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Logowanie</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-600">Rejestracja</a>
                @endauth
            </nav>
        </header>

        <main class="w-full lg:max-w-4xl bg-white p-10 shadow-md rounded-lg">
            @yield('body') 
        </main>
    </body>
</html>