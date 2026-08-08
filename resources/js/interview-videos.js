import Swiper from "swiper";
import { Navigation } from "swiper/modules";

export function initInterviewVideosSwiper() {
    const swiperElement = document.querySelector(".interview-videos-swiper");

    if (swiperElement) {
        new Swiper(".interview-videos-swiper", {
            modules: [Navigation],
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    centeredSlides: false,
                },
                768: {
                    slidesPerView: "auto",
                    centeredSlides: false,
                },
                1536: {
                    slidesPerView: "auto",
                    centeredSlides: false,
                },
            },
            spaceBetween: 13,
            navigation: {
                nextEl: ".interview-videos-button-next",
                prevEl: ".interview-videos-button-prev",
            },
            grabCursor: true,
        });
    }
}
