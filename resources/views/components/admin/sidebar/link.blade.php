@props([
    'href',
    'icon',
    'route',
])

@php
    $active = request()->routeIs($route);
@endphp

<a
    href="{{ $href }}"
    class="
        p-3 rounded-lg 
        flex items-center gap-2.5

        {{ $active
            ? 'bg-terceary text-secondary'
            : 'text-muted'
        }}
    "
>
    <x-dynamic-component
        :component="$icon"
        class="w-5 h-5"
    />

    <span>{{ $slot }}</span>
</a>    