@section('title', 'Dashboard')

<x-layout.admin>
    <header class="w-full flex justify-between items-center border-b border-muted pb-6">
        <h1 class="text-2xl">GoodFocus97</h1>
        <form action="/logout" method="POST" class="w-fit">
            <button type="submit" class="bg-red-500 w-50 p-2.5 rounded-lg cursor-pointer">Sair</button>
        </form>
    </header>
    <section class="w-full h-full flex gap-8">
        <aside class="w-60 h-full flex flex-col gap-4 border-r border-muted px-4 py-8 ">
            <button class="p-3 bg-terceary text-secondary rounded-lg flex items-center gap-2.5">
                <x-heroicon-o-home class="w-5 h-5" />
                Inicio
            </button>
            <button class="p-3 text-muted rounded-lg flex items-center gap-2.5">
                <x-heroicon-o-document class="w-5 h-5" />
                Publicações
            </button>
            <button class="p-3 text-muted rounded-lg flex items-center gap-2.5">
                <x-heroicon-o-photo class="w-5 h-5" />
                Postar Foto
            </button>
            <button class="p-3 text-muted rounded-lg flex items-center gap-2.5">
                <x-heroicon-o-camera class="w-5 h-5" />
                Câmeras
            </button>
            <button class="p-3 text-muted rounded-lg flex items-center gap-2.5">
                <x-heroicon-o-tag class="w-5 h-5" />
                Categorias
            </button>
        </aside>
        <article class="w-full flex flex-col gap-8 p-8">
            <span>
                <h1 class="text-3xl mb-2.5">Olá, {{$user->name}} </h1>
                <p class="text-xl text-muted"> Aqui está o resumo do seu conteúdo.</p>
            </span>
            <div class="w-full flex gap-8">
                <div class="w-60 p-8 border border-muted rounded-lg flex gap-4">
                    <x-heroicon-o-camera class="w-6 h-6"/>
                    <span>
                        <p class="text-xl">Total de fotos</p>
                        <h2 class="text-2xl">{{$picturesCount}}</h2>
                    </span>
                </div>
                <div class="w-60 p-8 border border-muted rounded-lg flex gap-4">
                    <x-heroicon-o-camera class="w-6 h-6"/>
                    <span>
                        <p class="text-xl">Cameras</p>
                        <h2 class="text-2xl">{{$camerasCount}}</h2>
                    </span>
                </div>
                <div class="w-60 p-8 border border-muted rounded-lg flex gap-4">
                    <x-heroicon-o-camera class="w-6 h-6"/>
                    <span>
                        <p class="text-xl">Categorias</p>
                        <h2 class="text-2xl">{{$categoryCount}}</h2>
                    </span>
                </div>
            </div>
            <div class="w-full flex flex-col gap-6">
                <span class="w-full flex justify-between items-center">
                    <p class="text-2xl">Suas fotos</p>
                    <button class="w-fit p-4 bg-primary text-white rounded-lg cursor-pointer">+ Enviar Fotos </button>
                </span>
                <div class="w-full flex gap-8 flex-wrap">
                    @foreach ($pictures as $picture)
                        <h1>{{$picture->title}}</h1>
                    @endforeach
                </div>
            </div>
        </article>
    </section>
</x-layout.admin>










































{{-- <x-layout.admin>

    <form action="/logout" method="POST">
        @csrf

        <button type="submit">
            SAIR
        </button>
    </form>


    <h1>Olá, {{ $user->name }}</h1>

    <p>Fotos: {{ $picturesCount }}</p>

    <p>Câmeras: {{ $camerasCount }}</p>

    @dd($pictures)


</x-layout.admin> --}}