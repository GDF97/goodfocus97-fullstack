
@php
    $types = ['success', 'error', 'warning', 'info'];

    $styles = [
        'success' => 'border-green-500 bg-green-50 text-green-800',
        'error' => 'border-red-500 bg-red-50 text-red-800',
        'warning' => 'border-yellow-500 bg-yellow-50 text-yellow-800',
        'info' => 'border-blue-500 bg-blue-50 text-blue-800',
    ];

    $icons = [
        'success' => '✓',
        'error' => '✕',
        'warning' => '!',
        'info' => 'i',
    ];
@endphp

<div
    id="toast-container"
    class="fixed bottom-5 right-5 z-50 flex w-[calc(100%-2.5rem)] max-w-sm flex-col gap-3"
    aria-live="polite"
>
    @foreach ($types as $type)
        @if (session()->has($type))
            <div
                role="{{ $type === 'error' ? 'alert' : 'status' }}"
                class="toast flex items-start gap-3 rounded-lg border-l-4 p-4 shadow-lg {{ $styles[$type] }}"
            >
                <span class="font-bold">
                    {{ $icons[$type] }}
                </span>

                <p class="flex-1">
                    {{ session($type) }}
                </p>

                <button
                    type="button"
                    class="toast-close ml-2 cursor-pointer"
                    aria-label="Fechar notificação"
                >
                    ✕
                </button>
            </div>
        @endif
    @endforeach
</div>

<script>
    document.querySelectorAll('.toast').forEach((toast) => {
        const closeButton = toast.querySelector('.toast-close');

        const closeToast = () => {
            toast.style.transition = 'opacity 200ms ease, transform 200ms ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(20px)';

            setTimeout(() => toast.remove(), 200);
        };

        closeButton.addEventListener('click', closeToast);

        setTimeout(closeToast, 4000);
    });
</script>
