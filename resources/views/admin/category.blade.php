@section('title', 'Categorias')

<x-layout.admin>
    <article class="w-full flex flex-col gap-8 p-8">
        <span>
            <h1 class="text-3xl mb-2.5">Categorias </h1>
            <p class="text-xl text-muted"> Organize suas fotos por categoria.</p>
        </span>
        <div class="w-full flex gap-8">
            <table class="flex w-fit h-fit gap-4 border border-muted rounded-2xl overflow-hidden">
                <tr class="text-left border-b border-muted">
                    <th class="p-2.5">Nome</th>
                    <th class="p-2.5">Ações</th>
                </tr>
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <x-admin.category
                            :category="$category->name"
                            :categoryId="$category->id"
                        />
                    @endforeach
                @else
                    <x-admin.category
                        category="Sem categorias cadastradas"
                        :categoryId="0"
                    />
                @endif
            </table>
            <form action="/admin/categorias" method="POST" class="flex flex-col gap-6 border border-muted rounded-sm p-4">
                @csrf
                @if (isset($categoryToEdit) && isset($isEdit) && $isEdit)
                    @method("PUT")
                    <input type="number" name="categoryId" id="categoryId" value={{ $categoryToEdit->id }} hidden>
                @endif
                <h3 class="text-2xl">Cadastrar categoria</h3>
                <label for="category" class="">
                    <p>Nome da categoria *</p>
                    <input type="text" name="category" id="category" placeholder="Ex: Montanha" required class="mt-2.5 w-75 p-4 border border-muted rounded-xl outline-0 focus:outline-2 focus:outline-primary text-sm" value="{{  isset($categoryToEdit) ?  $categoryToEdit->name : "" }}">
                </label>
                @if (isset($categoryToEdit) && isset($isEdit) && $isEdit)
                    <button type="submit" class="cursor-pointer bg-primary py-2.5 rounded-lg text-white font-light text-lg">Atualizar</button>
                @else
                    <button type="submit" class="cursor-pointer bg-primary py-2.5 rounded-lg text-white font-light text-lg">Cadastrar</button>
                @endif
            </form>
        </div>
    </article>
    
</x-layout.admin>