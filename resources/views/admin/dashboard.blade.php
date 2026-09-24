@section('title', 'Dashboard')

<x-layout.admin>
    <article class="w-full flex flex-col gap-8 p-8">
        <span>
            <h1 class="text-3xl mb-2.5">Olá, {{$user->name}} </h1>
            <p class="text-xl text-muted"> Aqui está o resumo do seu conteúdo.</p>
        </span>
        <div class="w-full flex gap-8">
            <div class="w-60 p-8 border border-muted rounded-lg flex gap-4 bg-white">
                <x-heroicon-o-camera class="w-6 h-6"/>
                <span>
                    <p class="text-xl">Total de fotos</p>
                    <h2 class="text-2xl">{{$picturesCount}}</h2>
                </span>
            </div>
            <div class="w-60 p-8 border border-muted rounded-lg flex gap-4 bg-white">
                <x-heroicon-o-camera class="w-6 h-6"/>
                <span>
                    <p class="text-xl">Cameras</p>
                    <h2 class="text-2xl">{{$camerasCount}}</h2>
                </span>
            </div>
            <div class="w-60 p-8 border border-muted rounded-lg flex gap-4 bg-white">
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
                <a href="{{ route("admin.picture.create") }}" class="w-fit p-4 bg-primary text-white rounded-lg cursor-pointer">+ Enviar Fotos </a>
            </span>
            <div class="w-full flex gap-8 flex-wrap">
                @if ($pictures->isNotEmpty())
                    @foreach ($pictures as $picture)
                        <div class="w-fit flex flex-col gap-2 p-4 border border-muted rounded-lg">
                            <img class="rounded-sm w-75 h-68.75 object-cover" src="{{ asset('storage/' . $picture->path) }}" alt="">
                            <h3 class="text-xl text-black">{{ $picture->title }}</h3>
                            <h4 class="text-muted text-sm">{{ $picture->created_at->format('d/m/Y') }}</h4>
                            <div class="flex gap-4">
                                <x-heroicon-o-pencil class="w-5 h-5" />
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </article> 
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