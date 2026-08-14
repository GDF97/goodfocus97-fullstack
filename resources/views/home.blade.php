<x-layout>
    <div class="flex flex-col gap-2 w-100 p-2 h-125 overflow-auto">
        @foreach ($pictures as $picture)
            <x-picture :picture="$picture"/>
        @endforeach
    </div>
    <a href="/create-picture" class='border bg-emerald-500 p-2 rounded-lg'>Publicar foto</a>
    <a href="/cameras" class='border bg-indigo-500 p-2 rounded-lg'>Ver Cameras</a>
    <a href="/login" class='border bg-zinc-500  text-white p-2 rounded-lg'>Login</a>
</x-layout>
