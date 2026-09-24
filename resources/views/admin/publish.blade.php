@section('title', 'Publicar foto')


<x-layout.admin>
    <article class="w-full flex flex-col gap-8 p-8">
        <span>
            <h1 class="text-3xl mb-2.5">Publicar nova foto </h1>
            <p class="text-xl text-muted"> Compartilhe um novo momento com sua galeria.</p>
        </span>
        <div class="w-full flex items-start gap-8">
            <form action="/admin/publicar-foto" method="POST" enctype="multipart/form-data" class="w-full flex flex-col gap-6">
                @csrf
                <div class="relative flex min-h-50 w-full flex-col gap-1 items-center justify-center border-2 border-dashed border-muted p-4">
                    <input
                        type="file"
                        id="picture"
                        name="picture"
                        accept="image/png, image/jpeg"
                        class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                        required
                    >

                    <x-heroicon-o-cloud-arrow-up class="h-10 w-10"/>

                    <h3 class="flex flex-col text-center">
                        Arraste e solte sua foto aqui

                        <span class="text-sm text-muted">
                            ou clique para selecionar
                        </span>
                    </h3>

                    
                    <p class="text-center text-sm text-muted">
                        Formatos aceitos: JPG e PNG. Tamanho máximo: 10MB
                    </p>

                    <p
                        id="file-name"
                        class="mt-1 text-sm text-muted"
                    >
                        Nenhum arquivo selecionado
                    </p>
                </div>
                <div>
                    <p>Titulo</p>
                    <input type="text" name="title" placeholder="Escreva seu titulo" class="mt-2.5 w-full p-4 border border-muted rounded-xl outline-0 focus:outline-2 focus:outline-primary text-sm" required>
                </div>
                <div>
                    <p>Categorias</p>
                    <div class="mt-2.5 w-full flex flex-wrap items-center gap-2.5">
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                
                                <label for="{{ $category->name }}{{ $category->id }}" class="cursor-pointer">
                                    <input
                                        type="checkbox"
                                        name="category[]"
                                        id="{{ $category->name }}{{ $category->id }}"
                                        value="{{ $category->id }}"
                                        class="peer sr-only"
                                    >

                                    <div
                                        class="min-w-30 text-center px-4 py-2 border border-muted opacity-50 rounded-xl peer-checked:border-terceary peer-checked:text-primary peer-checked:opacity-100 peer-checked:bg-terceary transition"
                                    >
                                        {{ $category->name }}
                                    </div>
                                </label>
                            @endforeach
                        @else
                            <h1>Nenhuma categoria cadastrada</h1>                            
                        @endif
                        
                        {{-- <div class="min-w-30 text-center px-4 py-2 border border-muted opacity-50 rounded-xl cursor-pointer">Montanha</div>
                        <div class="min-w-30 text-center px-4 py-2 text-primary bg-terceary rounded-xl cursor-pointer">Montanha</div> --}}
                    </div>
                </div>
                <div>
                    <p>Câmera</p>
                    <select class="mt-2.5 pl-4 pr-4 py-2 border border-muted rounded-xl outline-none" name="camera" id="camera" required>
                         @if ($cameras->isNotEmpty())
                            @foreach ($cameras as $camera)
                                <option value="{{ $camera->id }}">
                                    {{ $camera->name }}
                                </option>      
                            @endforeach
                        @else
                            <option selected disabled>Nenhuma câmera cadastrada</option>                            
                        @endif
                    </select>
                </div>
                <div>
                    <p>Descrição</p>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="mt-2.5 w-full h-30 resize-none outline-1 outline-muted rounded-xl p-4" placeholder="Escreva a descrição da foto" required></textarea>
                </div>
                <div class="flex gap-4 items-center">
                    <button type="submit" class="w-50 cursor-pointer bg-primary p-2.5 rounded-lg text-white font-light text-lg">Publicar Foto</button>
                    <button type="submit" class="w-50 cursor-pointer border border-muted  text-muted p-2.5 rounded-lg font-light text-lg">Descartar</button>
                </div>
            </form>
            <div class="w-85"></div>
        </div>
    </article>
    <script>
        const input = document.getElementById('picture');
        const fileName = document.getElementById('file-name');

        input.addEventListener('change', function () {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'Nenhum arquivo selecionado';
            }
        });
    </script>
</x-layout.admin>

