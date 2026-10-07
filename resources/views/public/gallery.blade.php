@section('title', 'Galeria')

<x-layout.public>
    <span class="w-full h-0.5 bg-stone-500"></span>
    <h1 class="text-3xl font-ancizar text-center lg:text-start">Galeria de Fotos</h1>
    <div class="w-full xl:min-h-125 flex gap-8 flex-wrap justify-center lg:justify-start">
        @foreach ($pictures as $picture)
            <a href="{{ route('public.picture', ['picture_id'=>$picture->id])  }}" class="w-fit h-fit flex flex-col gap-2 p-4 border border-muted rounded-lg bg-white">
                <img class="rounded-sm w-75 h-68.75 object-cover" src="{{ asset('storage/' . $picture->path) }}" alt="">
                <h3 class="text-xl text-black">{{ $picture->title }}</h3>
                <h4 class="text-muted text-sm">{{ $picture->created_at->format('d/m/Y') }}</h4>
                <h4> {{ $picture->camera->name }}</h4>
            </a>
        @endforeach
    </div>
    <x-public.footer/>
</x-layout.public>