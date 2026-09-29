@section('title', 'Publicações')


<x-layout.admin>
    <article class="w-full flex flex-col gap-8 p-8">
        <span>
            <h1 class="text-3xl mb-2.5">Suas Publicações </h1>
            <p class="text-xl text-muted"> De uma olhada no que publicou.</p>
        </span>
        <div class="w-full flex gap-8 flex-wrap max-h-150 overflow-y-auto">
            @if ($pictures->isNotEmpty())
                @foreach ($pictures as $picture)
                    <x-admin.picture :picture="$picture" />
                @endforeach
            @endif
        </div>
    </article>
</x-layout.admin>