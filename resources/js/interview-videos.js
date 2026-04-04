import Swiper from "swiper";
import { Navigation } from "swiper/modules";

// Array untuk menyimpan semua YouTube player instances
let youtubePlayers = [];
let isYouTubeAPIReady = false;

// Load YouTube IFrame API
function loadYouTubeAPI() {
    if (window.YT) {
        isYouTubeAPIReady = true;
        return;
    }

    const tag = document.createElement("script");
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

// Callback ketika YouTube API sudah ready
window.onYouTubeIframeAPIReady = function () {
    isYouTubeAPIReady = true;
    initYouTubePlayers();
};

// Initialize semua YouTube players
function initYouTubePlayers() {
    const iframes = document.querySelectorAll(".youtube-player");

    iframes.forEach((iframe) => {
        const player = new YT.Player(iframe.id, {
            events: {
                onStateChange: onPlayerStateChange,
            },
        });

        youtubePlayers.push({
            id: iframe.id,
            player: player,
        });
    });
}

// Handler ketika state video berubah
function onPlayerStateChange(event) {
    // YT.PlayerState.PLAYING = 1
    if (event.data === YT.PlayerState.PLAYING) {
        // Pause semua video lain
        youtubePlayers.forEach(({ player }) => {
            if (player !== event.target) {
                player.pauseVideo();
            }
        });
    }
}

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

        // Load YouTube API dan initialize players
        loadYouTubeAPI();

        // Jika API sudah ready, langsung initialize
        if (isYouTubeAPIReady) {
            initYouTubePlayers();
        }
    }
}
