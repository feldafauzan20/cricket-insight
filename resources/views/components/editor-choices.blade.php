@php
    use App\Models\Article;
    use Illuminate\Support\Str;

    // Mengambil 1 artikel terbaru yang ditandai sebagai Editor's Choice
    $editorChoice = Article::with('uploader')
        ->where('is_editor_choice', true)
        ->where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->first();
@endphp

@if($editorChoice)
<section class="lg:flex lg:items-stretch 2xl:container 2xl:mx-auto">
    <div class="hidden md:block h-54.5 lg:h-auto lg:w-97.25 2xl:w-2/5 overflow-hidden">
        <img src="{{ $editorChoice->thumbnail ? asset('storage/' . $editorChoice->thumbnail) : asset('images/dummy/editor-choices/dummy-bg-hero-editor-choices.webp') }}"
            alt="{{ $editorChoice->title }}" class="w-full h-full object-cover">
    </div>
    <div class="relative overflow-hidden 2xl:w-3/5">
        {{-- Background Image --}}
        <img src="{{ asset('images/dummy/dummy-editor-choices.webp') }}" alt="Editor's Choices Background"
            class="absolute inset-0 z-20 h-full w-full object-cover opacity-40">
        {{-- Gradient Overlay --}}
        <div
            class="absolute inset-0 bg-linear-to-br from-[#EC0226] from-1% via-[#6A469C] via-30% to-[#007DFC] to-90% z-10">
        </div>

        {{-- Content --}}
        <div class="relative mx-6 lg:mx-0 md:mx-7.5 py-5 lg:py-13.5 lg:px-13.5 z-30">
            <div class="bg-[#D6111A]/20 px-3.5 py-1 rounded-full w-fit border-2 border-[#D6111A]/20 mb-2">
                <p class="text-white font-semibold text-[13px]">Editor's Choices</p>
            </div>
            <h1 class="text-white font-semibold text-[24px] md:text-[28px] lg:text-[35px] mb-2">
                {{ Str::words($editorChoice->title, 8, '...') }}
            </h1>
            <p class="text-[12px] md:text-[14px] leading-[129.4%] tracking-[-3%] text-white mb-5">
                {{ Str::words(strip_tags($editorChoice->description ?? $editorChoice->content), 16, '...') }}
            </p>
            <div class="w-57 md:w-63.25 lg:h-fit flex justify-between items-center mb-7">
                <div class="flex items-center text-white gap-x-2.5">
                    <div class="w-9 h-9 rounded-full overflow-hidden shrink-0 border border-white/30">
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                            alt="Profile Picture" class="w-full h-full object-cover">
                    </div>
                    <p class="font-semibold text-[10px] line-clamp-1"><span class="font-normal">By </span>{{ $editorChoice->uploader ? $editorChoice->uploader->name : 'Admin' }}</p>
                </div>
                <div class="flex items-center gap-x-2 md:gap-x-3.5 text-white shrink-0">
                    <x-letsicon-time-atack class="w-5 h-5" />
                    <span class="font-medium text-[10px] md:text-[13px]">{{ strtoupper($editorChoice->published_at ? $editorChoice->published_at->format('d M Y') : $editorChoice->created_at->format('d M Y')) }}</span>
                </div>
            </div>
            <div>
                <a href="{{ url('/news/' . $editorChoice->slug) }}" class="flex items-center w-fit gap-x-3 text-white text-[11px] font-medium group">
                    <div
                        class="w-7.5 h-7.5 md:w-6.5 md:h-6.5 shrink-0 border border-white rounded-full flex items-center justify-center transition-transform duration-300 group-hover:-rotate-45">
                        <x-fas-arrow-right class="w-3 h-3 text-white" />
                    </div>
                    READ STORY
                </a>
            </div>
        </div>
    </div>
</section>
@endif