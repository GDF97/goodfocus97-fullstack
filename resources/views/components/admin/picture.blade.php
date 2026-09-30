@props(['picture'])

<div class="w-fit flex flex-col gap-2 p-4 border border-muted rounded-lg bg-white">
    <img class="rounded-sm w-75 h-68.75 object-cover" src="{{ asset('storage/' . $picture->path) }}" alt="">
    <h3 class="text-xl text-black">{{ $picture->title }}</h3>
    <h4 class="text-muted text-sm">{{ $picture->created_at->format('d/m/Y') }}</h4>
    <div class="flex gap-4">
        <a href="{{ route('admin.picture.edit', $picture->id) }}">
            <x-heroicon-o-pencil class="w-5 h-5" />
        </a>
        <a href="{{ route('admin.picture.destroy', $picture->id) }}">
            <x-heroicon-o-trash class="w-5 h-5" />
        </a>
    </div>
</div>