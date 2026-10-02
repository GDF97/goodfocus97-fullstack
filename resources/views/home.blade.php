@section("title", 'Home')

<x-layout.public>
    <header class="flex items-center justify-between">
        <h1 class="text-2xl font-ancizar">GoodFocus97</h1>
        <div class="flex items-center gap-8">
            <a href="" class="font-mono font-light">home</a>
            <a href="" class="font-mono font-light">sobre</a>
            <a href="" class="font-mono font-light">recente</a>
            <a href="" class="font-mono font-light">galeria</a>
        </div>
    </header>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full h-150 relative overflow-hidden border border-stone-500">
        <img src="{{ asset('storage/pictures/banner.jpg') }}" alt="banner" class="h-full w-full object-cover">
        <div class="w-120 bg-white p-4 absolute right-0 top-15 font-ancizar">
            <h1 class="text-2xl mb-2">Um clique, mil histórias.</h1>
            <p>Análogico/Digital</p>
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full flex flex-col gap-4 font-ancizar">
        <h1 class="text-2xl font-ancizar">Fotos recentes</h1>
        <div class="w-full overflow-x-auto flex gap-8">
        @foreach ($pictures as $picture)
            <div class="flex flex-col gap-6 w-160 shrink-0">
                <img
                    src="{{ asset('storage/' . $picture->path) }}"
                    alt="{{ $picture->title }}"
                    class="w-full h-105 object-cover drop-shadow-[8px_12px_12px_rgba(0,0,0,0.25)]"
                >

                <span class="flex items-start justify-between">
                    <h2 class="text-xl">
                        /{{ $picture->id < 10 ? '0' . $picture->id : $picture->id }}
                    </h2>

                    <span>
                        <h2 class="text-xl">{{ $picture->title }}</h2>
                        <h3 class="text-sm text-muted">{{ $picture->camera->name }}</h3>
                    </span>
                </span>
            </div>
        @endforeach
    </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="gap-8 flex">
        <div class="font-ancizar shrink-0 w-105 flex flex-col gap-4">
            <h1 class="text-3xl">Olá, eu sou o PH!</h1>
            <p>Fotógrafo amador, apaixonado por câmeras analógicas! Capturando com analógicas à digitais</p>
            <p>
                Seja bem vindo ao meu acervo digital da fotografia, aqui você irá encontrar fotografias tanto analógicas como digitais. Não trabalho com fotografia, me concentro em capturar cenas que acho fascinantes, especialmente paisagens ensolaradas.
            </p>
            <p>
                O meu arsenal de câmeras: 
                @foreach ($cameras as $camera)
                    {{ $camera->name }}
                @endforeach
            </p>
            <a href="{{ route('public.gallery') }}" class="text-xl text-primary underline">Veja meu acervo </a>
        </div>
        <div class="w-full flex justify-between items-baseline">
            <img src="{{ asset('storage/pictures/pfp.jpg') }}" alt="banner" class="w-[600px] h-[500px] object-cover">
            <img src="{{ asset('storage/pictures/pfp2.jpg') }}" alt="banner" class="w-[200px] h-[200px] object-cover">
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <footer class="bg-[#191516] p-4 text-center text-white rounded-lg">
        <p class="mb-4">
            &copy; 2026 Pedro Silva. All Rights Reserved.
        </p>
        <div class="w-full flex items-center justify-center gap-8">
            <a href="" class="font-mono font-light">home</a>
            <a href="" class="font-mono font-light">sobre</a>
            <a href="" class="font-mono font-light">recente</a>
            <a href="" class="font-mono font-light">galeria</a>
        </div>
        <p class="mt-4">@GoodFocus97</p>
    </footer>
</x-layout.public>

