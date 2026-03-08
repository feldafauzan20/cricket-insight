import "./bootstrap";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import Swiper from "swiper";
import { FreeMode } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
    new Swiper(".live-score-swiper", {
        modules: [FreeMode],
        slidesPerView: "auto",
        spaceBetween: 32,
        freeMode: true,
        grabCursor: true,
    });
});
