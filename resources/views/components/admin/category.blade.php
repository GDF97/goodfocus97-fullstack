@props(['category', 'categoryId'])

<tr class="border-t border-muted bg-white">
    <td class="min-w-55 p-2.5">{{ $category }}</td>
    <td class="flex gap-4 p-2.5">
        <a href="{{ route('admin.category.edit', $categoryId) }}">
            <input type="number" value={{ $categoryId }} hidden>
            <button class="cursor-pointer">
                <x-heroicon-o-pencil class="w-5 h-5" />
            </button>
        </a>
        <form>
            <input type="number" value={{ $categoryId }} hidden>
            <button class="cursor-pointer">
                <x-heroicon-o-trash class="w-5 h-5" />
            </button>
        </form>
    </td>
</tr>