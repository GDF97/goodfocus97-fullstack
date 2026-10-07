import "./bootstrap";
import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

const gallerySwiper = new Swiper(".gallerySwiper", {
    modules: [Navigation, Pagination],

    slidesPerView: 1,
    spaceBetween: 32,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    breakpoints: {
        768: {
            slidesPerView: 2,
            spaceBetween: 32,
        },

        1024: {
            slidesPerView: 3,
            spaceBetween: 32,
        },
    },
});
