@props(['pictures'])

<div class="swiper gallerySwiper">
    <div class="swiper-wrapper">

        @foreach ($pictures as $picture)
            <div class="swiper-slide">
                <a href="{{ route('public.picture', ['picture_id' => $picture->id]) }}">
                    <img
                        src="{{ asset('storage/' . $picture->path) }}"
                        alt="{{ $picture->title }}"
                        class="w-full h-96 object-cover rounded-sm"
                        loading="lazy"
                    >
                </a>
            </div>
        @endforeach

    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <div class="swiper-pagination"></div>
</div>