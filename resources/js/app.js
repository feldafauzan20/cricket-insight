import "./bootstrap";
import Alpine from "alpinejs";
import Swiper from "swiper";
import { FreeMode, Navigation, Autoplay, Pagination } from "swiper/modules";
import { initInterviewVideosSwiper } from "./interview-videos";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import initScoreCardTournamentSwiper from "./ScoreCardTournament";

document.addEventListener("alpine:init", () => {
    Alpine.data("heroCarousel", (slides) => ({
        slides,
        active: 0,
        playing: false,
        players: {},
        ytApiLoading: false,

        next() {
            this.pauseCurrent();
            this.active = (this.active + 1) % this.slides.length;
        },
        prev() {
            this.pauseCurrent();
            this.active =
                (this.active - 1 + this.slides.length) % this.slides.length;
        },
        goTo(index) {
            if (index === this.active) return;
            this.pauseCurrent();
            this.active = index;
        },
        pauseCurrent() {
            if (this.playing) this.pauseVideo(this.active);
        },
        togglePlay() {
            this.playing
                ? this.pauseVideo(this.active)
                : this.playVideo(this.active);
        },
        playVideo(index) {
            const slide = this.slides[index];
            if (slide.video.type === "youtube") {
                this.loadYouTubeApi().then(() => this.playYouTube(index));
            } else if (slide.video.type === "mp4") {
                const el = document.getElementById("video-" + index);
                if (el) {
                    el.play();
                    this.playing = true;
                }
            }
        },
        pauseVideo(index) {
            const slide = this.slides[index];
            if (slide.video.type === "youtube") {
                const player = this.players[index];
                if (player && player.pauseVideo) player.pauseVideo();
            } else if (slide.video.type === "mp4") {
                const el = document.getElementById("video-" + index);
                if (el) el.pause();
            }
            this.playing = false;
        },
        playYouTube(index) {
            const slide = this.slides[index];
            if (this.players[index]) {
                this.players[index].playVideo();
                return;
            }
            this.players[index] = new YT.Player("yt-player-" + index, {
                videoId: slide.video.id,
                playerVars: {
                    autoplay: 1,
                    controls: 0,
                    modestbranding: 1,
                    rel: 0,
                    playsinline: 1,
                },
                events: {
                    onReady: (e) => {
                        e.target.playVideo();
                        this.playing = true;
                    },
                    onStateChange: (e) => {
                        if (e.data === YT.PlayerState.PLAYING)
                            this.playing = true;
                        if (e.data === YT.PlayerState.PAUSED)
                            this.playing = false;
                        if (e.data === YT.PlayerState.ENDED)
                            this.playing = false;
                    },
                },
            });
        },
        loadYouTubeApi() {
            if (window.YT && window.YT.Player) return Promise.resolve();
            if (this.ytApiLoading) {
                return new Promise((resolve) => {
                    const check = setInterval(() => {
                        if (window.YT && window.YT.Player) {
                            clearInterval(check);
                            resolve();
                        }
                    }, 50);
                });
            }
            this.ytApiLoading = true;
            return new Promise((resolve) => {
                window.onYouTubeIframeAPIReady = () => resolve();
                const tag = document.createElement("script");
                tag.src = "https://www.youtube.com/iframe_api";
                document.head.appendChild(tag);
            });
        },
    }));
});

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
Alpine.data(
    "fixturesFilters",
    (initialSeriesList = [], initialYear = new Date().getFullYear()) => ({
        _matchesRequestId: 0,
        activeTab: "results",
        selectedYear: new Date().getFullYear(),
        selectedFormat: "All Series",
        selectedSeriesId: null,
        seriesList: initialSeriesList,
        seriesLoading: false,
        selectedTeam: "",
        selectedTeamId: null,
        selectedTeamName: "",
        teamsList: [],
        teamsLoading: false,
        openYear: false,
        yearDropdownStyle: {},
        fromDate: "",
        toDate: "",
        fromDatePicker: null,
        toDatePicker: null,
        selectedDay: null,
        allMatches: [],
        matchesGroups: [],
        matchesLoading: false,
        currentPage: 1,
        perPage: 10,
        pagination: {
            current_page: 1,
            last_page: 1,
            total: 0,
            per_page: 10,
            from: 0,
            to: 0,
        },

        get dayList() {
            return [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday",
            ];
        },

        refreshFiltersSwiper() {
            this.$nextTick(() => {
                window.fixturesFiltersSwiper?.update();
            });
        },

        get yearList() {
            const current = new Date().getFullYear();
            const years = [];
            for (let y = current; y >= 2016; y--) years.push(y);
            return years;
        },

        closeDropdowns() {
            window.dispatchEvent(new CustomEvent("fixtures-filters-reset"));
        },

        resetDateFilters() {
            this.selectedDay = null;
            this.fromDate = "";
            this.toDate = "";

            if (this.fromDatePicker) {
                this.fromDatePicker.clear();
                this.fromDatePicker.set("minDate", null);
            }

            if (this.toDatePicker) {
                this.toDatePicker.clear();
                this.toDatePicker.set("maxDate", null);
            }

            if (this.$refs?.fromDateInput) {
                this.$refs.fromDateInput.value = "";
            }

            if (this.$refs?.toDateInput) {
                this.$refs.toDateInput.value = "";
            }
        },

        resetFiltersForYearChange(year = null) {
            if (year !== null) {
                this.selectedYear = year;
            }

            this.selectedFormat = "All Series";
            this.selectedSeriesId = null;
            this.selectedTeam = "";
            this.selectedTeamId = null;
            this.selectedTeamName = "";
            this.teamsList = [];
            this.teamsLoading = false;
            this.resetDateFilters();
            this.resetMatchesState();
            this.closeDropdowns();
        },

        resetMatchesState() {
            this.allMatches = [];
            this.matchesGroups = [];
            this.pagination = {
                current_page: 1,
                last_page: 1,
                total: 0,
                per_page: this.perPage,
                from: 0,
                to: 0,
            };
        },

        buildFixtureGroups(matches) {
            const grouped = {};

            matches.forEach((match) => {
                const key = match.date || "Date TBA";
                if (!grouped[key]) grouped[key] = [];
                grouped[key].push(match);
            });

            return Object.entries(grouped).map(([date, items]) => ({
                date,
                matches: items,
            }));
        },

        get paginationPages() {
            if (!this.pagination.last_page) return [];
            const pages = [];
            const start = Math.max(1, this.currentPage - 2);
            const end = Math.min(this.pagination.last_page, start + 4);

            for (let i = start; i <= end; i++) {
                pages.push(i);
            }

            return pages;
        },

        get filteredMatchesGroups() {
            let filtered = this.allMatches;

            if (this.selectedDay) {
                filtered = filtered.filter((match) => {
                    // match.date sekarang string "27 JUNE, 2026" (hasil format server)
                    // butuh raw date buat hitung nama hari — lihat catatan di bawah
                    const d = new Date(match.rawDate);
                    const dayName = d.toLocaleDateString("en-US", {
                        weekday: "long",
                    });
                    return dayName === this.selectedDay;
                });
            }

            if (this.fromDate) {
                const from = new Date(this.fromDate);
                filtered = filtered.filter(
                    (match) => new Date(match.rawDate) >= from,
                );
            }

            if (this.toDate) {
                const to = new Date(this.toDate);
                filtered = filtered.filter(
                    (match) => new Date(match.rawDate) <= to,
                );
            }

            return this.buildFixtureGroups(filtered);
        },

        async fetchMatches(page = 1) {
            const requestId = ++this._matchesRequestId;
            this.matchesLoading = true;
            this.currentPage = page;
            this.resetMatchesState();

            try {
                const params = new URLSearchParams();

                if (this.selectedSeriesId) {
                    params.set("seriesId", this.selectedSeriesId);
                }

                if (this.selectedTeamId) {
                    params.set("teamId", this.selectedTeamId);
                }

                params.set("page", String(page));
                params.set("limit", String(this.perPage));

                const res = await fetch(`/api/matches?${params.toString()}`);
                const data = await res.json();

                if (requestId !== this._matchesRequestId) return;

                this.allMatches = data.matches ?? [];
                this.pagination = data.pagination ?? {
                    current_page: 1,
                    last_page: 1,
                    total: 0,
                    per_page: this.perPage,
                    from: 0,
                    to: 0,
                };
                this.matchesGroups = this.buildFixtureGroups(this.allMatches);
            } catch (error) {
                if (requestId !== this._matchesRequestId) return;
                console.error("Failed to fetch matches data", error);
                this.allMatches = [];
            } finally {
                if (requestId === this._matchesRequestId) {
                    this.matchesLoading = false;
                }
            }
        },

        goToPage(page) {
            if (page < 1 || page > this.pagination.last_page) return;
            this.fetchMatches(page);
        },

        prevPage() {
            if (this.currentPage > 1) {
                this.goToPage(this.currentPage - 1);
            }
        },

        nextPage() {
            if (this.currentPage < this.pagination.last_page) {
                this.goToPage(this.currentPage + 1);
            }
        },

        async fetchSeries(year) {
            this.seriesLoading = true;
            this.seriesList = [];
            this.resetFiltersForYearChange(year);

            try {
                const res = await fetch(`/api/series?year=${year}`);
                const data = await res.json();
                this.seriesList = data.seriesList ?? [];
                this.fetchMatches(1);
            } catch (error) {
                console.error("Failed to fetch series data", error);
                this.seriesList = [];
            } finally {
                this.seriesLoading = false;
            }
        },

        async fetchTeams(seriesId) {
            this.teamsList = [];

            if (!seriesId) {
                this.teamsLoading = false;
                this.selectedTeamId = null;
                this.selectedTeamName = "";
                return;
            }

            this.teamsLoading = true;
            try {
                const res = await fetch(`/api/teams?seriesId=${seriesId}`);
                const data = await res.json();
                this.teamsList = data.teamsList ?? [];
            } catch (error) {
                console.error("Failed to fetch teams data", error);
                this.teamsList = [];
            } finally {
                this.teamsLoading = false;
            }
        },

        selectSeries(series) {
            this.selectedSeriesId = series ? series.seriesID : null;
            this.selectedFormat = series ? series.seriesName : "All Series";

            this.selectedTeam = "";
            this.selectedTeamId = null;
            this.selectedTeamName = "";
            this.closeDropdowns();
            this.fetchTeams(series ? series.seriesID : null);
            this.fetchMatches(1);
            this.refreshFiltersSwiper();
        },

        init() {
            this.$nextTick(() => this.fetchMatches());

            this.fromDatePicker = flatpickr(this.$refs.fromDateInput, {
                dateFormat: "d M Y",
                appendTo: document.body,
                onChange: (selectedDate, dateStr) => {
                    ((this.fromDate = dateStr),
                        this.toDatePicker?.set("minDate", dateStr || null));
                },
            });

            this.toDatePicker = flatpickr(this.$refs.toDateInput, {
                dateFormat: "d M Y",
                appendTo: document.body,
                onChange: (selectedDates, dateStr) => {
                    this.toDate = dateStr;
                    this.fromDatePicker?.set("maxDate", dateStr || null);
                },
            });
        },

        toggleYearDropdown() {
            this.openYear = !this.openYear;
            if (this.openYear) {
                const rect = this.$refs.yearBtn.getBoundingClientRect();
                this.yearDropdownStyle = {
                    top: rect.bottom + window.scrollY + 8 + "px",
                    left: rect.left + window.scrollX + "px",
                    width: rect.width + "px",
                };
            }
        },

        previousYear() {
            if (this.selectedYear > 2016) {
                this.selectedYear--;
                this.fetchSeries(this.selectedYear);
            }
        },

        nextYear() {
            const currentYear = new Date().getFullYear();
            if (this.selectedYear < currentYear) {
                this.selectedYear++;
                this.fetchSeries(this.selectedYear);
            }
        },

        selectDay(day) {
            // BARU
            this.selectedDay = day;
        },

        selectFormat(format) {
            this.selectedFormat = format;
        },

        selectTeam(team) {
            this.selectedTeam = team ? team.teamName : "";
            this.selectedTeamId = team ? team.teamID : null;
            this.selectedTeamName = team ? team.teamName : "";
            this.fetchMatches(1);
            this.refreshFiltersSwiper();
        },
    }),
);

// Alpine.js Component for Points Table
Alpine.data(
    "pointsTable",
    (initialSeriesList = [], initialYear = new Date().getFullYear()) => ({
        _pointsTableRequestId: 0,
        _playerStatsRequestId: 0,
        _seriesDetailsRequestId: 0,
        selectedYear: initialYear,
        seriesList: initialSeriesList,
        seriesLoading: false,
        selectedSeriesId: null,
        selectedSeriesName: "All Series",
        openYear: false,
        yearDropdownStyle: {},
        groups: [],
        groupsLoading: false,
        selectedGroupName: null,

        playerStatsLoading: false,
        battingStats: [],
        bowlingStats: [],
        fieldingStats: [],
        encryptedSeriesId: null,
        encryptedClubId: null,

        get yearList() {
            const current = new Date().getFullYear();
            const years = [];
            for (let y = current; y >= 2016; y--) years.push(y);
            return years;
        },

        get groupNameList() {
            const names = this.groups.map((g) => g.groupName);
            return [...new Set(names)];
        },

        get filteredGroups() {
            if (!this.selectedGroupName) return this.groups;
            return this.groups.filter(
                (g) => g.groupName === this.selectedGroupName,
            );
        },

        buildRecordsUrl(endpoint, filter) {
            if (!this.selectedSeriesId || !this.encryptedSeriesId || !this.encryptedClubId) return "#";

            const params = new URLSearchParams({
                filter,
                leagueId: this.encryptedClubId,
                matchType: "All",
                year: this.selectedYear,
                series: this.encryptedSeriesId,
                seriesName: this.selectedSeriesName,
            });

            return `https://cricclubs.com/PCI/statistics/${endpoint}-records?${params}`;
        },

        get battingSeeAllUrl() {
            return this.buildRecordsUrl("batting", "Most Runs");
        },

        get bowlingSeeAllUrl() {
            return this.buildRecordsUrl("bowling", "Most Wickets");
        },

        get fieldingSeeAllUrl() {
            if (!this.selectedSeriesId || !this.encryptedSeriesId || !this.encryptedClubId) return "#";

            return (
                "https://cricclubs.com/PCI/statistics/fielding-records" +
                "?filter=Most%20Catches" +
                `&series=${this.encryptedSeriesId}` +
                "&division=undefined" +
                `&leagueId=${this.encryptedClubId}` +
                "&matchType=All"
            );
        },

        toggleYearDropdown() {
            this.openYear = !this.openYear;
            if (this.openYear) {
                const rect = this.$refs.ptYearBtn.getBoundingClientRect();
                this.yearDropdownStyle = {
                    top: rect.bottom + window.scrollY + 8 + "px",
                    left: rect.left + window.scrollX + "px",
                    width: rect.width + "px",
                };
            }
        },

        async fetchSeries(year) {
            this.selectedYear = year;
            this.seriesLoading = true;
            this.seriesList = [];
            this.selectSeries(null);

            try {
                const res = await fetch(`/api/series?year=${year}`);
                const data = await res.json();
                this.seriesList = data.seriesList ?? [];
            } catch (error) {
                console.error("Failed to fetch series data", error);
                this.seriesList = [];
            } finally {
                this.seriesLoading = false;
            }
        },

        selectSeries(series) {
            this.selectedSeriesId = series ? series.seriesID : null;
            this.selectedSeriesName = series ? series.seriesName : "All Series";
            this.selectedGroupName = null;
            this.fetchPointsTable(series ? series.seriesID : null);
            this.fetchPlayerStats(series ? series.seriesID : null);
            this.fetchSeriesDetails(series ? series.seriesID : null);
        },

        selectGroup(name) {
            this.selectedGroupName = name;
        },

        async fetchPointsTable(seriesId) {
            const requestId = ++this._pointsTableRequestId;
            this.groups = [];

            if (!seriesId) {
                this.groupsLoading = false;
                return;
            }

            this.groupsLoading = true;
            try {
                const res = await fetch(
                    `/api/points-table?seriesId=${seriesId}`,
                );
                const data = await res.json();

                if (requestId !== this._pointsTableRequestId) return;

                this.groups = data.groups ?? [];
            } catch (error) {
                if (requestId !== this._pointsTableRequestId) return;
                console.error("Failed to fetch points table data", error);
                this.groups = [];
            } finally {
                if (requestId === this._pointsTableRequestId) {
                    this.groupsLoading = false;
                }
            }
        },

        async fetchPlayerStats(seriesId) {
            const requestId = ++this._playerStatsRequestId;
            this.battingStats = [];
            this.bowlingStats = [];
            this.fieldingStats = [];

            if (!seriesId) {
                this.playerStatsLoading = false;
                return;
            }

            this.playerStatsLoading = true;
            try {
                const res = await fetch(
                    `/api/player-stats?seriesId=${seriesId}`,
                );
                const data = await res.json();

                if (requestId !== this._playerStatsRequestId) return;

                this.battingStats = data.batting ?? [];
                this.bowlingStats = data.bowling ?? [];
                this.fieldingStats = data.fielding ?? [];
            } catch (error) {
                if (requestId !== this._playerStatsRequestId) return;
                console.error("Failed to fetch player stats data", error);
            } finally {
                if (requestId === this._playerStatsRequestId) {
                    this.playerStatsLoading = false;
                }
            }
        },

        async fetchSeriesDetails(seriesId) {
            const requestId = ++this._seriesDetailsRequestId;
            this.encryptedSeriesId = null;
            this.encryptedClubId = null;

            if (!seriesId) return;

            try {
                const res = await fetch(
                    `/api/series-details?seriesId=${seriesId}`,
                );
                const data = await res.json();

                if (requestId !== this._seriesDetailsRequestId) return;

                this.encryptedSeriesId = data.encryptedLeagueId ?? null;
                this.encryptedClubId = data.encryptedClubId ?? null;
            } catch (error) {
                if (requestId !== this._seriesDetailsRequestId) return;
                console.error("Failed to fetch series details data", error);
            }
        },
    }),
);

Alpine.start();

let fixturesFiltersSwiperInstance = null;
document.addEventListener("DOMContentLoaded", () => {
    // Fixtures Tabs Swiper
    new Swiper(".fixtures-tabs-swiper", {
        slidesPerView: "auto",
        spaceBetween: 0,
        freeMode: true,
        grabCursor: true,
    });

    new Swiper(".points-table-filters-swiper", {
        slidesPerView: "auto",
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
    });

    // Fixtures Filters Swiper (Year, Formats, Teams)
    fixturesFiltersSwiperInstance = new Swiper(".fixtures-filters-swiper", {
        modules: [FreeMode],
        slidesPerView: "auto",
        spaceBetween: 12,
        freeMode: true,
        grabCursor: true,
        observer: true,
        observeParents: true,
        preventClicks: false,
        preventClicksPropagation: false,
        slideToClickedSlide: false,
    });

    window.fixturesFiltersSwiper = fixturesFiltersSwiperInstance;

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
