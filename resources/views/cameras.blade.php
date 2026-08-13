<x-layout>
    <a href="/" class="border border-solid border-black rounded-lg bg-indigo-500 text-white w-fit p-1 cursor-pointer">Voltar para as fotos</a>
    <form action="/cameras" method="POST" class="flex flex-col items-center gap-4 bg-zinc-100 p-6 border border-zinc-300">
        <label for="camera">
            @csrf
            Camera:
            <br>
            <input type="text" name="camera" id="camera" class="border">
        </label>
        <button class="border rounded-lg bg-emerald-500 w-fit p-1 cursor-pointer">Cadastrar Camera</button>
    </form>
    <div class="flex flex-col gap-5 max-h-50 overflow-auto p-6">
        @foreach ($cameras as $camera)
            <x-camera :camera="$camera"/>
        @endforeach
    </div>
</x-layout>