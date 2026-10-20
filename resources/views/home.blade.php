@section("title", 'Home')

<x-layout.public>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full h-fit sm:h-150 relative overflow-hidden border border-stone-500" data-anim="hero">
        <img src="{{ asset('storage/pictures/banner.jpg') }}" alt="banner" class="sm:h-full w-full object-cover" data-anim="hero-image">
        <div class="w-fit md:w-120 bg-white p-4 absolute right-0 top-15 font-ancizar" id="heroTitle" data-anim="hero-title">
            <h1 class="text-2xl mb-2">Um clique, mil histórias.</h1>
            <p>Análogico/Digital</p>
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full flex flex-col gap-4 font-ancizar" id="recent" data-anim="section">
        <h1 class="text-2xl font-ancizar" data-anim="section-title">Fotos recentes</h1>
        <div data-anim="carousel">
            <x-public.carousel :pictures="$pictures" />
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="gap-8 flex flex-col-reverse lg:flex-row" id="about" data-anim="section">
        <div class="font-ancizar shrink-0 w-full lg:w-105 flex flex-col gap-4" data-anim="about-text">
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
        <div class="w-full flex justify-between lg:items-baseline" data-anim="about-images">
            <img src="{{ asset('storage/pictures/pfp.jpg') }}" alt="banner" class="w-full md:w-[600px] md:h-[500px] object-cover">
            <img src="{{ asset('storage/pictures/pfp2.jpg') }}" alt="banner" class="w-[200px] h-[200px] object-cover hidden 2xl:flex">
        </div>
    </section>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <x-public.footer />
</x-layout.public>

