<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('tytul', 'Mój Sklep')</title> <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 items-center min-h-screen flex-col">
        
        <header class="w-full lg:max-w-4xl mb-6">
            <nav class="flex justify-end gap-4">
                <a href="/">Start</a>
                <a href="/contact">Kontakt</a>
                <a href="/products">Produkty</a>
            </nav>
        </header>

        <main class="w-full lg:max-w-4xl bg-white p-10 shadow-md rounded-lg">
            @yield('tresc') </main>

    </body>
</html>