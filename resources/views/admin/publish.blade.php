@section('title', 'Publicar foto')


<x-layout.admin>
    <article class="w-full flex flex-col gap-8 p-8">
        <span>
            <h1 class="text-3xl mb-2.5">
                @if($isEdit)
                    Atualize sua foto
                @else
                    Publicar novo foto
                @endif 
            </h1>
            <p class="text-xl text-muted"> Compartilhe um novo momento com sua galeria.</p>
        </span>
        <div class="max-w-275 w-full flex items-start gap-8">
            <form action="/admin/foto" method="POST" enctype="multipart/form-data" class="w-full flex flex-col gap-6">
                @csrf
                @if ($isEdit)
                    @method("PUT")
                    <input type="number" value="{{ $pictureToEdit->id }}" hidden id="pictureId" name="pictureId">
                @endif
                <div class="relative flex min-h-50 w-full flex-col gap-1 items-center justify-center border-2 border-dashed border-muted p-4">
                    <input
                        type="file"
                        id="picture"
                        name="picture"
                        accept="image/png, image/jpeg"
                        class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
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
                        @if (isset($pictureToEdit))
                            {{ $pictureToEdit->path }}
                        @else
                            Nenhum arquivo selecionado
                        @endif
                    </p>
                </div>
                <div>
                    <p>Titulo</p>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        placeholder="Escreva seu titulo" 
                        class="mt-2.5 w-full p-4 border
                        border-muted rounded-xl 
                        outline-0 focus:outline-2
                        focus:outline-primary text-sm" 
                        required maxlength="50" 
                        value="{{ $pictureToEdit?->title ?? '' }}"
                        >
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
                                        @checked($isEdit && $pictureToEdit->categories->contains('id', $category->id))
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
                    </div>
                </div>
                <div>
                    {{-- @dd($pictureToEdit) --}}
                    <p>Câmera</p>
                    <select class="mt-2.5 pl-4 pr-4 py-2 border border-muted rounded-xl outline-none" name="camera" id="camera" required>
                         @if ($cameras->isNotEmpty())
                            @foreach ($cameras as $camera)
                                @if (isset($pictureToEdit) && $pictureToEdit->camera_id == $camera->id)
                                    <option value="{{ $camera->id }}">
                                        {{ $camera->name }}
                                    </option>
                                @else
                                    <option value="{{ $camera->id }}">
                                        {{ $camera->name }}
                                    </option>
                                @endif
                            @endforeach
                        @else
                            <option selected disabled>Nenhuma câmera cadastrada</option>                            
                        @endif
                    </select>
                </div>
                <div>
                    <p>Descrição</p>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="mt-2.5 w-full h-30 resize-none outline-1 outline-muted rounded-xl p-4" placeholder="Escreva a descrição da foto" required>@if (isset($pictureToEdit)){{ $pictureToEdit->desc }}@endif</textarea>
                </div>
                <div class="flex gap-4 items-center">
                    <button type="submit" class="w-50 cursor-pointer bg-primary p-2.5 rounded-lg text-white font-light text-lg">
                        @if ($isEdit)
                            Atualizar Foto
                        @else
                            Publicar Foto
                        @endif
                    </button>
                    <button type="submit" class="w-50 cursor-pointer border border-muted  text-muted p-2.5 rounded-lg font-light text-lg">Descartar</button>
                </div>
            </form>
            <div class="w-100 border border-muted p-4 flex flex-col gap-4">
                <h1 class="text-xl">
                    Prévia
                </h1>
                @if (isset($pictureToEdit))
                    <img src="{{ asset('storage/' . $pictureToEdit->path) }}" alt="Prévia da imagem" id="preview" class="w-full h-55 bg-muted object-cover">
                @else
                    <img src="" alt="Prévia da imagem" id="preview" class="w-full h-55 bg-muted object-cover">
                @endif
                <h3 id="previewTitle">
                    @if (isset($pictureToEdit))
                        {{ $pictureToEdit->title }}
                    @else
                        Prévia
                    @endif
                </h3>
                <div id="previewCategories" class="w-full flex flex-wrap gap-2.5">
                    @if (isset($pictureToEdit))
                        @foreach ($pictureToEdit->categories->pluck('name') as $category)
                            <span>#{{ $category }}</span>
                        @endforeach
                    @else
                        Categorias
                    @endif
                </div>
            </div>
        </div>
    </article>
    <script>
        const inputImage = document.getElementById('picture');
        const inputTitle = document.getElementById('title');
        const previewTitle = document.getElementById('previewTitle');
        const previewCategories = document.getElementById('previewCategories');
        const categories = document.querySelectorAll('input[name="category[]"]');

        let categoriesSelected = [];

        const fileName = document.getElementById('file-name');
        const preview = document.getElementById('preview');

        inputTitle.addEventListener('input', function () {
            if(inputTitle.value.trim() === ""){
                previewTitle.textContent = "Titulo"
            } else {
                previewTitle.textContent = inputTitle.value
            }
        })

        inputImage.addEventListener('change', function () {
            if (this.files.length > 0) {
                const file = this.files[0];

                fileName.textContent = file.name;
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                fileName.textContent = 'Nenhum arquivo selecionado';
                preview.classList.add('hidden');
            }
        });

        categories.forEach(category => {
            category.addEventListener('change', function () {
                previewCategories.textContent = ""

                categoriesSelected = Array.from(
                    document.querySelectorAll('input[name="category[]"]:checked')
                ).map(checkbox => checkbox.id.slice(0, -1));

                if(categoriesSelected.length == 0){
                    previewCategories.innerHTML = "Categorias selecionadas"
                    return;
                }

                categoriesSelected.forEach(element => {
                    previewCategories.innerHTML += `<span>#${element} </span>`;
                });
            });
        });


    </script>
</x-layout.admin>

