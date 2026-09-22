@props(['camera', 'cameraId'])

<tr class="border-t border-muted bg-white">
    <td class="min-w-55 p-2.5">{{ $camera }}</td>
    <td class="flex gap-4 p-2.5">
        <a href="{{ route('admin.cameras.edit', $cameraId) }}">
            <input type="number" value={{ $cameraId }} hidden>
            <button class="cursor-pointer">
                <x-heroicon-o-pencil class="w-5 h-5" />
            </button>
        </a>
        <a href="{{ route('admin.cameras.destroy', $cameraId) }}">
            <input type="number" value={{ $cameraId }} hidden>
            <button class="cursor-pointer">
                <x-heroicon-o-trash class="w-5 h-5" />
            </button>
        </a>
    </td>
</tr>