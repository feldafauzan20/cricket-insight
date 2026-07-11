import "./bootstrap";
import Alpine from "alpinejs";
import Swiper from "swiper";
import { FreeMode, Navigation, Autoplay, Pagination } from "swiper/modules";
import { initInterviewVideosSwiper } from "./interview-videos";
import flatpickr from "flatpickr";
import initScoreCardTournamentSwiper from "./ScoreCardTournament";

// Dark Mode Store dengan localStorage persistence
Alpine.store("darkMode", {
    // Initialize dari localStorage atau system preference
    on:
        localStorage.getItem("darkMode") === "true" ||
        (!localStorage.getItem("darkMode") &&
            window.matchMedia("(prefers-color-scheme: dark)").matches),

    toggle() {
        this.on = !this.on;
        localStorage.setItem("darkMode", this.on);
        this.updateDOM();
    },

    init() {
        this.updateDOM();

        // Watch system preference changes
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (e) => {
                if (!localStorage.getItem("darkMode")) {
                    this.on = e.matches;
                    this.updateDOM();
                }
            });
    },

    updateDOM() {
        if (this.on) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    },
});

window.Alpine = Alpine;

// Alpine.js Component for Fixtures Filters
Alpine.data("fixturesFilters", () => ({
    activeTab: "women",
    selectedYear: new Date().getFullYear(),
    selectedFormat: "ODI",
    selectedTeam: "",
    openYear: false,
    // yearPicker: null,

    get yearList() {
        const current = new Date().getFullYear();
        const years = [];
        for (let y = current; y >= 2016; y--) years.push(y);
        return years;
    },

    // init() {
    //     // Initialize Flatpickr for year picker
    //     this.yearPicker = flatpickr(this.$refs.yearPicker, {
    //         mode: "single",
    //         dateFormat: "Y",
    //         defaultDate: new Date().getFullYear().toString(),
    //         minDate: "2016",
    //         maxDate: new Date().getFullYear().toString(),
    //         onChange: (selectedDates, dateStr) => {
    //             this.selectedYear = parseInt(dateStr);
    //         },
    //         onOpen: function (selectedDates, dateStr, instance) {
    //             // Switch to year mode when calendar opens
    //             instance.currentYear = instance.selectedDates[0]
    //                 ? instance.selectedDates[0].getFullYear()
    //                 : new Date().getFullYear();
    //             instance.redraw();
    //         },
    //         plugins: [
    //             function (fp) {
    //                 return {
    //                     onReady: function () {
    //                         // Custom year picker functionality
    //                         const yearSelect = fp.currentYearElement;
    //                         if (yearSelect) {
    //                             yearSelect.removeAttribute("disabled");
    //                         }
    //                     },
    //                 };
    //             },
    //         ],
    //     });
    // },

    previousYear() {
        if (this.selectedYear > 2016) {
            this.selectedYear--;
            this.openYear = false; // Close the year picker after selection
        }
    },

    nextYear() {
        const currentYear = new Date().getFullYear();
        if (this.selectedYear < currentYear) {
            this.selectedYear++;
            this.openYear = false; // Close the year picker after selection
        }
    },

    selectFormat(format) {
        this.selectedFormat = format;
    },

    selectTeam(team) {
        this.selectedTeam = team;
    },
}));

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    // Fixtures Tabs Swiper
    new Swiper(".fixtures-tabs-swiper", {
        slidesPerView: "auto",
        spaceBetween: 0,
        freeMode: true,
        grabCursor: true,
    });

    // Fixtures Filters Swiper (Year, Formats, Teams)
    new Swiper(".fixtures-filters-swiper", {
        slidesPerView: "auto",
        spaceBetween: 12,
        freeMode: true,
        grabCursor: true,
        preventClicks: false,
        preventClicksPropagation: false,
        slideToClickedSlide: false,
    });

    new Swiper(".live-score-swiper", {
        // modules: [FreeMode],
        slidesPerView: "auto",
        spaceBetween: 15,
        freeMode: true,
        grabCursor: true,
    });
    new Swiper(".latest-news-swiper", {
        modules: [Navigation],
        slidesPerView: "auto",
        spaceBetween: 16,
        navigation: {
            nextEl: ".latest-news-button-next",
            prevEl: ".latest-news-button-prev",
        },
        grabCursor: true,
    });

    // Ongoing Tournament Swiper
    new Swiper(".ongoing-tournament-swiper", {
        slidesPerView: "auto",
        spaceBetween: 29,
        grabCursor: true,
    });

    // Interview Videos Swiper
    initInterviewVideosSwiper();

    // Score Card Tournament Swiper\
    initScoreCardTournamentSwiper();

    // Featured Video Carousel
    new Swiper(".featured-video-swiper", {
        modules: [Navigation],
        loop: true,
        grabCursor: true,
        spaceBetween: 0,
        navigation: {
            nextEl: ".featured-video-button-next",
            prevEl: ".featured-video-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                centeredSlides: false,
            },
            768: {
                slidesPerView: 2,
                centeredSlides: false,
            },
            1536: {
                slidesPerView: "auto",
                centeredSlides: false,
            },
        },
    });

    // Get progress circle element (before Swiper initialization)
    const progressCircle = document.querySelector(
        ".hero-carousel-progress-circle",
    );
    const circumference = 113.097; // 2 * PI * radius (2 * 3.14159 * 18)

    // Update progress circle based on autoplay progress
    function updateProgressCircle(percentage) {
        if (progressCircle) {
            // percentage adalah 0-1, kita invert karena dari 100% ke 0%
            const offset = circumference * percentage;
            progressCircle.style.strokeDashoffset = offset;
        }
    }

    // Update news card border based on active slide
    function updateNewsCardBorder(activeIndex) {
        const newsCards = document.querySelectorAll(".hero-news-card");
        newsCards.forEach((card, index) => {
            const borderElement = card.querySelector("div");
            if (index === activeIndex) {
                borderElement.classList.remove("border-t-white");
                borderElement.classList.add("border-t-[#EC0226]");
            } else {
                borderElement.classList.remove("border-t-[#EC0226]");
                borderElement.classList.add("border-t-white");
            }
        });
    }

    // Hero Carousel
    const heroCarousel = new Swiper(".hero-carousel-swiper", {
        modules: [Navigation, Autoplay, Pagination],
        loop: true,
        grabCursor: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        speed: 800,
        navigation: {
            nextEl: ".hero-carousel-button-next",
            prevEl: ".hero-carousel-button-prev",
        },
        pagination: {
            el: ".hero-carousel-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return (
                    '<div class="' +
                    className +
                    ' w-2.5 h-2.5 rounded-full cursor-pointer transition-colors duration-300"></div>'
                );
            },
        },
        on: {
            init: function () {
                updateNewsCardBorder(this.realIndex);
                updateProgressCircle(1); // Start with full circle
            },
            slideChange: function () {
                updateNewsCardBorder(this.realIndex);
            },
            autoplayTimeLeft: function (swiper, timeLeft, percentage) {
                updateProgressCircle(percentage);
            },
        },
    });

    // News card click to navigate carousel
    const newsCards = document.querySelectorAll(".hero-news-card");
    newsCards.forEach((card) => {
        card.addEventListener("click", function () {
            const slideIndex = parseInt(this.dataset.slideIndex);
            heroCarousel.slideToLoop(slideIndex);
        });
    });

    // Social Media Card Click Handling
    const socialCards = document.querySelectorAll(".social-media-card");
    const embedContainer = document.getElementById("social-embed-container");
    const embedContent = document.getElementById("social-embed-content");

    let clickTimer = null;
    let clickCount = 0;

    // Social media embeds
    const embeds = {
        Facebook: `
            <iframe
                src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fpermalink.php%3Fstory_fbid%3Dpfbid0TMUKx6u3MfVu7JX24iSAqSYdMgrf5rCS1A9ucYudu1dSEBkeeLz818Qr4t6YQGWkl%26id%3D61560799396848&show_text=false&width=500"
                width="100%"
                height="498"
                style="border:none;overflow:hidden"
                scrolling="no"
                frameborder="0"
                allowfullscreen="true"
                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
            </iframe>
        `,
        X: `
            <blockquote class="twitter-tweet" data-width="auto" style="width:100%; width:-webkit-calc(100%);"><p lang="in" dir="ltr">Pertandingan besar menuju final! 🔥🏏<br><br>Semi-Final 2 mempertemukan India national cricket team melawan England cricket team di ICC Men's T20 World Cup 2026.<br><br>🗓 5 Maret 2026<br>⏰ 20.30 WIB<br><br>📺 Tonton LIVE dalam Bahasa Indonesia di YouTube &amp; Facebook ICC.<a href="https://t.co/1WsXgheH7f">https://t.co/1WsXgheH7f</a> <a href="https://t.co/0TuWGEMHLr">pic.twitter.com/0TuWGEMHLr</a></p>&mdash; Cricket Indonesia (@Cricket_INA) <a href="https://twitter.com/Cricket_INA/status/2029458241424625782?ref_src=twsrc%5Etfw">March 5, 2026</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        `,
        Youtube: `
            <iframe
                width="100%"
                height="315"
                src="https://www.youtube.com/embed/7AkYrJfP7Ck?si=dT9FPjC9YupvNEbL"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen>
            </iframe>
        `,
        Instagram: `
            <blockquote class="instagram-media"
                data-instgrm-permalink="https://www.instagram.com/cricket_ina/?utm_source=ig_embed&amp;utm_campaign=loading"
                data-instgrm-version="14"
                style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100%); width:100%;">
            </blockquote>
        `,
    };

    socialCards.forEach((card) => {
        card.addEventListener("click", function (e) {
            e.preventDefault();
            clickCount++;

            if (clickCount === 1) {
                clickTimer = setTimeout(() => {
                    // Single click - Show embed
                    const socialName = this.dataset.socialName;
                    const embedHtml = embeds[socialName];

                    if (embedHtml) {
                        embedContent.innerHTML = embedHtml;
                        embedContainer.classList.remove("hidden");

                        // Load external scripts for social media embeds
                        if (socialName === "Facebook") {
                            loadFacebookSDK();
                        } else if (socialName === "X") {
                            loadTwitterSDK();
                        } else if (socialName === "Instagram") {
                            loadInstagramSDK();
                        }

                        // Smooth scroll to embed
                        setTimeout(() => {
                            embedContainer.scrollIntoView({
                                behavior: "smooth",
                                block: "nearest",
                            });
                        }, 100);
                    }

                    clickCount = 0;
                }, 300);
            } else if (clickCount === 2) {
                // Double click - Open link
                clearTimeout(clickTimer);
                const url = this.dataset.socialUrl;
                window.open(url, "_blank");
                clickCount = 0;
            }
        });
    });

    // Load Facebook SDK
    function loadFacebookSDK() {
        if (!window.FB) {
            const script = document.createElement("script");
            script.async = true;
            script.defer = true;
            script.crossOrigin = "anonymous";
            script.src =
                "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0";
            document.body.appendChild(script);
        } else {
            window.FB.XFBML.parse();
        }
    }

    // Load Twitter SDK
    function loadTwitterSDK() {
        if (!window.twttr) {
            const script = document.createElement("script");
            script.async = true;
            script.src = "https://platform.twitter.com/widgets.js";
            document.body.appendChild(script);
        } else {
            window.twttr.widgets.load();
        }
    }

    // Load Instagram SDK
    function loadInstagramSDK() {
        if (!window.instgrm) {
            const script = document.createElement("script");
            script.async = true;
            script.src = "//www.instagram.com/embed.js";
            document.body.appendChild(script);
        } else {
            window.instgrm.Embeds.process();
        }
    }
});
