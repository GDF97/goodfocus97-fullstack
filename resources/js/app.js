import "./bootstrap";
import Swiper from "swiper";
import { Navigation, Pagination } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

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

gsap.registerPlugin(ScrollTrigger);

function initHomeAnimations() {
    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;

    if (reduceMotion) return;

    // HERO: fotografia sendo revelada
    const heroImage = document.querySelector('[data-anim="hero-image"]');

    const heroTitle = document.querySelector('[data-anim="hero-title"]');

    if (heroImage) {
        gsap.fromTo(
            heroImage,
            {
                scale: 1.12,
                filter: "brightness(1.8)",
                clipPath: "inset(8% 8% 8% 8%)",
            },
            {
                scale: 1,
                filter: "brightness(1)",
                clipPath: "inset(0% 0% 0% 0%)",
                duration: 1.6,
                ease: "power3.out",
            },
        );
    }

    if (heroTitle) {
        gsap.fromTo(
            heroTitle,
            {
                x: 70,
                opacity: 0,
            },
            {
                x: 0,
                opacity: 1,
                duration: 1,
                delay: 0.35,
                ease: "power3.out",
            },
        );
    }

    // Seções: entrada conforme a rolagem
    gsap.utils.toArray('[data-anim="section"]').forEach((section) => {
        const title = section.querySelector('[data-anim="section-title"]');

        const carousel = section.querySelector('[data-anim="carousel"]');

        const aboutText = section.querySelector('[data-anim="about-text"]');

        const aboutImages = section.querySelector('[data-anim="about-images"]');

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 82%",
                once: true,
            },
        });

        if (title) {
            tl.fromTo(
                title,
                {
                    y: 25,
                    opacity: 0,
                },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.65,
                    ease: "power2.out",
                },
            );
        }

        if (carousel) {
            tl.fromTo(
                carousel,
                {
                    y: 45,
                    opacity: 0,
                },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.85,
                    ease: "power3.out",
                },
                "-=0.25",
            );
        }

        if (aboutText) {
            tl.fromTo(
                aboutText,
                {
                    x: -40,
                    opacity: 0,
                },
                {
                    x: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: "power3.out",
                },
            );
        }

        if (aboutImages) {
            const images = aboutImages.querySelectorAll("img");

            tl.fromTo(
                images,
                {
                    y: 35,
                    opacity: 0,
                    scale: 1.04,
                    filter: "brightness(1.5)",
                },
                {
                    y: 0,
                    opacity: 1,
                    scale: 1,
                    filter: "brightness(1)",
                    duration: 1,
                    stagger: 0.2,
                    ease: "power3.out",
                },
                aboutText ? "-=0.45" : 0,
            );
        }
    });
}

function initGalleryAnimations() {
    const gallery = document.querySelector("[data-gallery]");
    // const gallerylength = document.querySelector['[data-gallery-item]']

    if (!gallery) return;

    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        return;
    }

    const cards = gsap.utils.toArray("[data-gallery-item]");

    if (!cards.length) return;

    // Título da galeria
    gsap.from("[data-gallery-title]", {
        y: 20,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
    });

    // Cada card aparece individualmente conforme entra na tela
    cards.forEach((card, index) => {
        gsap.fromTo(
            card,
            {
                y: 35,
                opacity: 0,
            },
            {
                y: 0,
                opacity: 1,
                duration: 0.7,
                delay: (index % cards.length) * 0.1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 92%",
                    once: true,
                },
            },
        );
    });

    // Zoom discreto nas fotografias ao passar o mouse
    cards.forEach((card) => {
        const image = card.querySelector(".gallery-image");

        if (!image) return;

        const enter = () => {
            gsap.to(image, {
                scale: 1.06,
                duration: 0.45,
                ease: "power2.out",
                overwrite: true,
            });
        };

        const leave = () => {
            gsap.to(image, {
                scale: 1,
                duration: 0.45,
                ease: "power2.out",
                overwrite: true,
            });
        };

        card.addEventListener("mouseenter", enter);
        card.addEventListener("mouseleave", leave);
    });
}

function initPictureAnimations() {
    const page = document.querySelector("[data-picture-info]");
    const photo = document.querySelector("[data-photo]");

    if (!page || !photo) return;

    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;

    if (reduceMotion) return;

    const image = photo.querySelector("img");
    const textElements = page.querySelectorAll("[data-write]");

    // Animação da fotografia
    gsap.fromTo(
        photo,
        { opacity: 0, y: 20 },
        {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power2.out",
        },
    );

    if (image) {
        gsap.fromTo(
            image,
            {
                scale: 1.04,
                filter: "brightness(1.5)",
            },
            {
                scale: 1,
                filter: "brightness(1)",
                duration: 1.4,
                ease: "power2.out",
            },
        );
    }

    // Efeito de escrita
    const timeline = gsap.timeline({ delay: 0.25 });

    textElements.forEach((element) => {
        const originalText = element.textContent.trim();

        if (!originalText) return;

        element.textContent = "";

        const textNode = document.createTextNode("");
        const cursor = document.createElement("span");

        cursor.className = "typing-cursor";
        cursor.setAttribute("aria-hidden", "true");
        cursor.textContent = "|";

        element.appendChild(textNode);
        element.appendChild(cursor);

        const state = { progress: 0 };

        timeline.to(state, {
            progress: originalText.length,
            duration: Math.min(
                Math.max(originalText.length * 0.025, 0.35),
                2.5,
            ),
            ease: "none",

            onUpdate: () => {
                textNode.textContent = originalText.slice(
                    0,
                    Math.floor(state.progress),
                );
            },

            onComplete: () => {
                textNode.textContent = originalText;
                cursor.remove();
            },
        });

        timeline.to({}, { duration: 0.18 });
    });

    // Animação da seção de fotos recentes
    const recent = document.querySelector("[data-recent]");

    if (recent) {
        const title = recent.querySelector("h2");

        if (title) {
            gsap.from(title, {
                y: 20,
                opacity: 0,
                duration: 0.6,
                ease: "power2.out",

                scrollTrigger: {
                    trigger: recent,
                    start: "top 85%",
                    once: true,
                },
            });
        }
    }
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initHomeAnimations, {
        once: true,
    });
    document.addEventListener("DOMContentLoaded", initGalleryAnimations, {
        once: true,
    });
    document.addEventListener("DOMContentLoaded", initPictureAnimations, {
        once: true,
    });
} else {
    initHomeAnimations();
    initGalleryAnimations();
    initPictureAnimations();
}
