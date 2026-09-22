<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GoodFocus97')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="w-full h-screen flex flex-col py-2.5 px-4 bg-background">
        <header class="w-full flex justify-between items-center border-b border-muted pb-6">
            <h1 class="text-2xl">GoodFocus97</h1>
            <form action="/logout" method="POST" class="w-fit">
                @csrf
                <button type="submit" class="bg-red-500 w-50 p-2.5 rounded-lg cursor-pointer">Sair</button>
            </form>
        </header>
        <section class="w-full h-full flex gap-8">
           <x-admin.sidebar.aside />
            {{ $slot }}
        </section>
    </main>
</body>
</html>