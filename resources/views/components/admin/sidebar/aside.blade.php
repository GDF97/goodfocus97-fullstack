<aside class="min-w-70 min-h-screen border-r border-muted px-4 py-8 ">

    <nav class="flex flex-col gap-4">

        <x-admin.sidebar.link
            href="{{ route('admin.dashboard') }}"
            icon="heroicon-o-home"
            route="admin.dashboard"
        >
            Dashboard
        </x-admin.sidebar.link>

        <x-admin.sidebar.link
            href="{{ route('admin.gallery') }}"
            icon="heroicon-o-document"
            route="admin.gallery"
        >
            Publicações
        </x-admin.sidebar.link>

        <x-admin.sidebar.link
            href="{{ route('admin.picture.create') }}"
            icon="heroicon-o-photo"
            route="admin.picture.create"
        >
            Postar Foto
        </x-admin.sidebar.link>

        <x-admin.sidebar.link
            href="{{ route('admin.cameras.index') }}"
            icon="heroicon-o-camera"
            route="admin.cameras.*"
        >
            Câmeras
        </x-admin.sidebar.link>

        <x-admin.sidebar.link
            href="{{ route('admin.category.index') }}"
            icon="heroicon-o-tag"
            route="admin.category.*"
        >
            Categorias
        </x-admin.sidebar.link>

    </nav>

</aside>