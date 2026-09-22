@section('title', 'Câmeras')

<x-layout.admin>
    <article class="w-full flex flex-col gap-8 p-8">
        <span>
            <h1 class="text-3xl mb-2.5">Câmeras </h1>
            <p class="text-xl text-muted"> Gerencie as câmeras das quais as fotos foram tiradas.</p>
        </span>
        <div class="w-full flex gap-8">
            <table class="flex w-fit h-fit gap-4 border border-muted rounded-2xl overflow-hidden">
                <tr class="text-left border-b border-muted">
                    <th class="p-2.5">Nome</th>
                    <th class="p-2.5">Ações</th>
                </tr>
                @if ($cameras->isNotEmpty())
                    @foreach ($cameras as $camera)
                        <x-admin.camera
                            :camera="$camera->name"
                            :cameraId="$camera->id"
                        />
                    @endforeach
                @else
                    <x-admin.camera
                        camera="Sem câmeras cadastradas"
                        :cameraId="0"
                    />
                @endif
            </table>
            <form action="/admin/cameras" method="POST" class="flex flex-col gap-6 border border-muted rounded-sm p-4">
                @csrf
                @if (isset($cameraToEdit) && isset($isEdit) && $isEdit)
                    @method("PUT")
                    <input type="number" name="cameraId" id="cameraId" value={{ $cameraToEdit->id }} hidden>
                @endif
                <h3 class="text-2xl">Cadastrar câmera</h3>
                <label for="camera" class="">
                    <p>Nome da camera *</p>
                    <input type="text" name="camera" id="camera" placeholder="Ex: Pentax K1000" required class="mt-2.5 w-75 p-4 border border-muted rounded-xl outline-0 focus:outline-2 focus:outline-primary text-sm" value="{{  isset($cameraToEdit) ?  $cameraToEdit->name : "" }}">
                </label>
                @if (isset($cameraToEdit) && isset($isEdit) && $isEdit)
                    <button type="submit" class="cursor-pointer bg-primary py-2.5 rounded-lg text-white font-light text-lg">Atualizar</button>
                @else
                    <button type="submit" class="cursor-pointer bg-primary py-2.5 rounded-lg text-white font-light text-lg">Cadastrar</button>
                @endif
            </form>
        </div>
    </article>
    
</x-layout.admin>