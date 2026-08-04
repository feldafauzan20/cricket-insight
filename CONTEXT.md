# Konteks Project — Cricket Insight (PCI)

Project Laravel untuk situs Persatuan Cricket Indonesia (PCI). Dokumen ini rangkuman histori kerjaan dari sesi sebelumnya, biar Claude Code bisa lanjut tanpa perlu re-explore dari nol.

Stack: Laravel 12, Blade, Alpine.js, Tailwind, Swiper.js, flatpickr, Laragon (Windows), PostgreSQL.

---

## 1. Localization (SELESAI, stabil)

- Locale: `id` (default) dan `en`, di-set via `config('app.available_locales')`.
- URL prefix based: semua route di-wrap `Route::prefix('{locale}')` di `routes/web.php`, middleware `App\Http\Middleware\SetLocale`.
- Redirect `/` → `/id/` (atau locale aktif) via route closure di luar prefix group.
- Lang files: `lang/id/*.php` dan `lang/en/*.php`, per-domain (navbar.php, footer.php, dst), short-key style (`__('navbar.home')`).
- **Custom Artisan command**: `app/Console/Commands/ScanLangKeys.php` — scan blade untuk `__()`/`trans()`/`@lang()`, auto-generate skeleton key kosong ke lang files tanpa menimpa yang udah diisi. Jalanin `php artisan lang:scan` tiap kali nambah key baru.
- Semua `route()` call di blade wajib nyertain `['locale' => app()->getLocale()]` — ini sumber bug paling sering muncul kalau ada blade baru yang lupa nambahin.
- Model binding: gunakan `{model:slug}` (misal `Article $article` bukan `$slug` polos) di route yang berada dalam prefix locale, supaya urutan parameter controller gak ketuker sama `$locale`.

## 2. Match Centre — Fixtures & Results (SELESAI, fungsional)

### File terkait
- `app/Services/CricclubsSeriesService.php` — fetch `getSeriesList`, cache per tahun.
- `app/Services/CricclubsMatchService.php` / `CricclubsMatchesService.php` — fetch `getMatches`, format match jadi struktur ringkas siap tampil.
- `app/Http/Controllers/SeriesController.php` — endpoint `/api/series?year=`.
- `app/Http/Controllers/MatchesController.php` — render halaman + endpoint `getMatchesApi()` di `/api/matches` (pagination, filter seriesId & teamId).
- `resources/views/components/fixtures-results.blade.php` — komponen filter + tabel fixtures.
- `resources/js/app.js` — `Alpine.data("fixturesFilters", ...)`.

### API eksternal cricclubs — WAJIB header ini di semua request
```php
Http::withHeaders([
    'X-Consumer-Key'  => config('app.x_consumer_key'),
    'X-API-Key'       => config('app.x_api_key'),
    'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
    'Accept'          => 'application/json, text/plain, */*',
    'Accept-Language' => 'en-US,en;q=0.9',
    'X-Timestamp'     => round(microtime(true) * 1000),
    'X-Timezone'      => 'Asia/Jakarta',
])
```
Tanpa ini API balikin `406 SEC001` (deteksi timezone/timestamp gak ada). `config('app.x_consumer_key')` dan `x_api_key` harus ada di `.env` + `config/app.php`.

`clubId` PCI selalu `18330`. Endpoint dasar: `https://core-prod-origin.cricclubs.com/core/...`

### Fitur yang udah jalan
- Filter: Year (dropdown grid tahun 2016–sekarang), Series (cascading dari Year), Teams (cascading dari Series), Days (Monday–Sunday), From/To Date (flatpickr, saling ngunci min/max).
- Filter Grounds & Clubs **sengaja di-comment-out** — Clubs gak relevan buat situs single-club (cuma akan selalu "All Clubs"), Grounds belum ada sumber data yang jelas.
- Semua dropdown pakai `x-teleport="body"` + posisi dihitung manual via `getBoundingClientRect()` (biar gak ke-clip Swiper container `overflow-hidden`).
- Swiper filter row: `observer: true, observeParents: true`, plus manual `swiperInstance.update()` dipanggil abis `selectSeries()`/`selectTeam()` (Alpine `x-text` mengubah lebar tombol, MutationObserver default swiper gak selalu nangkep perubahan teks murni).
- Pencegahan race condition: `_matchesRequestId` counter di tiap `fetchMatches()`, biar response request lama yang telat gak nimpa state kalau user ganti filter cepat.
- Pagination server-side asli (bukan dummy lagi).

### Known gaps / belum dikerjakan
- Filter Day & Date Range masih **client-side filtering** dari data yang udah di-fetch per-series (API gak confirmed dukung parameter day/date langsung).
- Field `type` di card match pakai `matchType` API yang isinya kode singkat (misal "l") — kurang informatif, belum diputusin mau diganti `seriesType` atau enggak.

## 3. Points Table (SELESAI, fungsional)

### File terkait
- `app/Services/CricclubsPointsTableService.php` — fetch `getPointsTable?clubId=&seriesId=`, group per `groupName`, hitung ranking per grup (points desc, tie-break NRR desc).
- `app/Http/Controllers/PointsTableController.php` — endpoint `/api/points-table?seriesId=`.
- `resources/views/components/points-table.blade.php` (atau nama file sejenis) — filter Year/Series/Group + tabel per grup.
- `app.js` — `Alpine.data("pointsTable", ...)`, terpisah dari `fixturesFilters`.

### Kolom tabel
RANK, TEAM, MAT, WON, LOST, N/R, **WIN%** (dihitung manual `won/matches*100`, API sering ngasih `winPercentage: 0` yang salah), **NRR** (dibulatkan ke atas 2 desimal pakai `ceil($value*100)/100` — **catatan: user minta literal "dibulatkan ke atas", bukan pembulatan matematis biasa, kalau ternyata maksudnya beda perlu dikonfirmasi ulang**), PTS.

### Filter Group
Grup (Group A/B/C, dst) di-extract dari response yang sama (gak perlu endpoint terpisah), filter dikerjain client-side via getter `filteredGroups`.

## 4. Player Stats (BELUM SELESAI — perlu dilanjutkan)

Section ini masih dummy di `points-table.blade.php` bagian bawah (BATTING/BOWLING/RANKING pakai `collect([...])` hardcoded). User sudah share 3 sample response tapi belum sempat dikerjain servicenya:

### Endpoint & field kunci

**Batting** — `getBattingStats?v=5.0.29&X-Auth-Token=null&clubId=18330&seriesId={id}`
Field penting: `playerID`, `encryptedPlayerId`, `firstName`, `lastName`, `runsScored`, `ballsFaced`, `matches`, `innings`, `highestScore`, `teamName`, `profilepic_file_path`, `points`.

**Bowling** — `getBowlingStats?v=5.0.29&X-Auth-Token=null&clubId=18330&seriesId={id}`
Field penting: `playerID`, `encryptedPlayerId`, `firstName`, `lastName`, `wickets`, `runsGiven`, `matches`, `economy`, `teamName`, `points`.

**Fielding** — `getFeildingStats` (perhatikan API-nya salah eja "Feilding", bukan "Fielding" — jangan dikoreksi pas manggil endpoint) `?v=5.0.29&X-Auth-Token=null&clubId=18330&seriesId={id}`
Field penting: `playerID`, `encryptedPlayerId`, `firstName`, `lastName`, `catches`, `wkcatches`, `stumpings`, `total` (total dismissal), `teamName`, `points`.

### Link "See All" per kategori
Format: `https://cricclubs.com/PCI/user/{encryptedPlayerId}?playerName={First+Last}`

Contoh dari user:
- Batting: `https://cricclubs.com/PCI/user/PJl4LvQdGsDOXXyR6uUITA?playerName=Andreas+Syahbudiman+Sadaroha`
- Bowling: `https://cricclubs.com/PCI/user/GYK0WgFRwFblQR7vNAibhg?playerName=Jupiter+Sadaroha`
- Fielding: `https://cricclubs.com/PCI/user/n7-bTCnx76ZIymnSmy63qA?playerName=Zen%20Lugo+Sibolis`

**PENTING**: link ini per-**pemain** (top performer individual), BUKAN link ke halaman daftar records season kayak yang sempat dibahas sebelumnya (`/statistics/batting-records?...`) yang butuh `leagueId`/`series` terenkripsi yang gak ada di response manapun. Jadi "See All" kemungkinan besar cukup pakai `encryptedPlayerId` dari **data urutan #1** di tiap kategori (top performer), bukan navigasi ke halaman rekap yang lebih rumit. **Perlu dikonfirmasi ke user**: apakah "See All" itu maksudnya link ke profil top player (data teratas di array), atau butuh sesuatu yang lain.

### Yang perlu dikerjakan
1. `app/Services/CricclubsPlayerStatsService.php` — 3 method: `getBattingStats($seriesId)`, `getBowlingStats($seriesId)`, `getFieldingStats($seriesId)` (ingat: endpoint asli "Feilding" typo, method PHP boleh dieja benar).
2. Controller endpoint AJAX, atau reuse `PointsTableController` — kemungkinan `/api/player-stats?seriesId=&type=batting|bowling|fielding`.
3. Ganti dummy `$statTables` di blade jadi data real, hubungkan ke Series filter yang sama dengan Points Table (satu section, dua sumber data berbeda tapi seriesId sama).
4. Bangun URL "See All" pakai `encryptedPlayerId` milik top performer di tiap kategori.

## 5. Aturan/Preferensi User (berlaku ke semua kerjaan lanjutan)

- User (ojan) minta feedback blak-blakan, gak perlu basa-basi validasi ("bagus banget!") — langsung ke masalah, tunjukin akar sebab sebelum kasih fix.
- Prefer breakdown step-by-step yang jelas kalau ada instruksi setup baru.
- Kalau ada asumsi yang diambil karena spesifikasi kurang jelas, WAJIB di-flag eksplisit ke user, jangan diam-diam nebak.
- Environment: Windows + Laragon, PowerShell (bukan bash) — kalau kasih command shell, sesuaikan syntax PowerShell.
- User masih belajar async/await, arsitektur besar, dan debugging — kalau ngejelasin root cause, jelasin JUGA "kenapa" bukan cuma "apa fix-nya" (dia lagi belajar system thinking).

## 6. Struktur Route API (semua di luar prefix locale)

```php
Route::get('/api/series', [SeriesController::class, 'index'])->name('api.series');
Route::get('/api/matches', [MatchesController::class, 'getMatchesApi'])->name('api.matches');
Route::get('/api/points-table', [PointsTableController::class, 'getPointsTableApi'])->name('api.points-table');
// BELUM ADA: Route::get('/api/player-stats', ...)
// BELUM ADA (disebut user, belum pernah dibahas detail): Route::get('/api/teams', ...) — endpoint ini dipakai JS (fetchTeams) tapi controller/service-nya user bikin sendiri di luar sesi ini, perlu dicek isinya kalau ada bug terkait Team filter.
```

## 7. Next Steps (urutan yang disarankan)

1. **Klarifikasi ke user**: apakah "See All" Player Stats itu ke profil top performer (pakai `encryptedPlayerId` data index 0), lalu lanjut implementasi kalau sudah confirmed.
2. Bikin `CricclubsPlayerStatsService` (3 method, pola sama persis `CricclubsPointsTableService` — header auth sama, cache per seriesId).
3. Wire ke blade `points-table.blade.php` bagian Player Stats, reuse `selectedSeriesId` dari komponen `pointsTable` yang udah ada (jangan bikin filter Series baru lagi di section ini).
4. Setelah Player Stats kelar, cek ulang apakah field `type` di Fixtures card mau diganti (masih pending dari sesi sebelumnya).
5. Endpoint `/api/teams` — user based bilang mereka bikin sendiri, minta user share isi controller/service-nya untuk direview (khawatir ada silent bug soal `teamId` matching antara response `getMatches` dan `getTeams`).
