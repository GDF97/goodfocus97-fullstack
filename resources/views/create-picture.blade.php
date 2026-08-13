<x-layout>
    <h1>Publique sua Foto!</h1>
    <form method="POST" action="/store-picture" class="flex flex-col gap-4" enctype="multipart/form-data">
        @csrf
        <label for="path">
            Foto:
            <br>
            <input type="file" name="path" id="path"  class="border">
        </label>
        <label for="title">
            Titulo:
            <br>
            <input type="text" name="title" id="title" required maxlength="30" class="border w-full">
        </label>
        <label for="desc">
            Descrição:
            <br>
            <textarea type="text" name="desc" id="desc" class="border w-full"></textarea>
        </label>
        <select name="camera" id="camera" class="border" required>
            <option default>Escolha sua camera</option>
             @foreach ($cameras as $camera)
                <option value="{{ $camera->id }}">
                    {{ $camera->name }}
                </option>
            @endforeach
        </select>
        <button id="btn" class="border bg-amber-300 cursor-pointer">Publicar</button>
    </form>

</x-layout>
