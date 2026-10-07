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
    <main class="w-full min-h-screen flex flex-col p-6 gap-8 bg-background relative">
        <header class="w-full inset-0 sticky z-10 bg-background py-2">
            <div class="w-full flex items-center justify-between flex-col sm:flex-row sm:gap-0 gap-4">
                <h1 class="text-2xl font-ancizar">GoodFocus97</h1>
                <nav class="flex items-center gap-8">
                    <a href="/" class="font-mono font-light">home</a>
                    <a href="/#about" class="font-mono font-light">sobre</a>
                    <a href="/#recent" class="font-mono font-light">recente</a>
                    <a href="/galeria" class="font-mono font-light">galeria</a>
                </nav>
            </div>
        </header>
        {{ $slot }}
    </main>
</body>
</html>