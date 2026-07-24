import Swiper from "swiper";

export default function initScoreCardTournamentSwiper() {
    const swiperElement = document.querySelector(
        ".score-card-tournament-swiper",
    );

    if (swiperElement) {
        new Swiper(swiperElement, {
            slidesPerView: "auto",
            spaceBetween: 20,
        });
    } else {
        console.warn(
            "Swiper element with class 'score-card-tournament-swiper' not found.",
        );
    }
}
