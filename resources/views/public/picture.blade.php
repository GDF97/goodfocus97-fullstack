<?php
    $teste = "Foto tal"
?>

@section('title', $teste)


<x-layout.public>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <button class="w-fit cursor-pointer" onclick="history.back()">
            Voltar
    </button>
    <div class="flex max-sm:flex-col items-start gap-8">
        <img src="{{ asset('storage/' . $picture->path) }}" alt="" class="w-full sm:w-fit sm:max-w-125 md:max-w-150 lg:max-w-200 object-cover rounded-sm">
        <div class="flex flex-col gap-8">
            <p class="text-3xl">{{ $picture->title }}</p>
            <span>
                <b> Descrição da foto: </b>
                <p class="mt-4">{{ $picture->desc }}</p>
            </span>
            <span>
                <b> Categorias: </b>
                <p class="mt-4">
                    @foreach ($picture->categories->pluck('name') as $category)
                        #{{ $category }}
                    @endforeach
                </p>
            </span>
            <span>
                <b> Câmera: </b>
                <p class="mt-4">{{ $picture->camera->name }}</p>
            </span>
        </div>
    </div>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <section class="w-full flex flex-col gap-4 font-ancizar" id="recent">
        <h1 class="text-2xl font-ancizar">Fotos recentes</h1>
        <x-public.carousel :pictures="$pictures" />
    </section>
    <x-public.footer/>
</x-layout.public>
