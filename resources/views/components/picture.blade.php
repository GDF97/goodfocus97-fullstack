@props(['picture'])

<div class="w-full h-fit border-2 bg-amber-50 gap-2 p-2">
    <img src="{{ asset('storage/' . $picture->path) }}" alt="{{ $picture->title }}" >
    <h3>Autor: {{ $picture->user ? $picture->user->name : "Anonimo" }}</h3>
    <h1>Titulo: {{ $picture->title}}</h1>
    <h2>Câmera: {{ $picture->camera->name}}</h2>
    <h2>Descrição: {{ $picture->desc}}</h2>
    <h2>Publicado: {{ $picture->created_at->diffForHumans()}}</h2>
</div>