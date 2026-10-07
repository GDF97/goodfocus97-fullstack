@section("title", 'Home')

<x-layout.public>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full h-fit sm:h-150 relative overflow-hidden border border-stone-500">
        <img src="{{ asset('storage/pictures/banner.jpg') }}" alt="banner" class="sm:h-full w-full object-cover">
        <div class="w-fit md:w-120 bg-white p-4 absolute right-0 top-15 font-ancizar">
            <h1 class="text-2xl mb-2">Um clique, mil histórias.</h1>
            <p>Análogico/Digital</p>
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full flex flex-col gap-4 font-ancizar" id="recent">
        <h1 class="text-2xl font-ancizar">Fotos recentes</h1>
        <x-public.carousel :pictures="$pictures" />
        {{-- @foreach ($pictures as $picture)
            <a href="{{ route('public.picture', ['picture_id'=>$picture->id])  }}" href="/picture" class="flex flex-col gap-6 max-w-160 shrink-0">
                <img
                    src="{{ asset('storage/' . $picture->path) }}"
                    alt="{{ $picture->title }}"
                    class="w-fit h-105 object-cover border"
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
            </a>
        @endforeach --}}
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="gap-8 flex flex-col-reverse lg:flex-row" id="about">
        <div class="font-ancizar shrink-0 w-full lg:w-105 flex flex-col gap-4">
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
        <div class="w-full flex justify-between lg:items-baseline">
            <img src="{{ asset('storage/pictures/pfp.jpg') }}" alt="banner" class="w-full md:w-[600px] md:h-[500px] object-cover">
            <img src="{{ asset('storage/pictures/pfp2.jpg') }}" alt="banner" class="w-[200px] h-[200px] object-cover hidden 2xl:flex">
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <x-public.footer />
</x-layout.public>

