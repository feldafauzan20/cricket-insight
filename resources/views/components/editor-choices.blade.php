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

@if ($editorChoice)
    <section class="2xl:container lg:flex lg:items-stretch 2xl:mx-auto">
        <div class="h-54.5 lg:w-97.25 hidden overflow-hidden md:block lg:h-auto 2xl:w-2/5">
            <img src="{{ $editorChoice->thumbnail ? asset('storage/' . $editorChoice->thumbnail) : asset('images/dummy/editor-choices/dummy-bg-hero-editor-choices.webp') }}"
                alt="{{ $editorChoice->title }}" class="h-full w-full object-cover">
        </div>
        <div class="relative overflow-hidden 2xl:w-3/5">
            {{-- Background Image --}}
            <img src="{{ asset('images/dummy/dummy-editor-choices.webp') }}" alt="Editor's Choices Background"
                class="absolute inset-0 z-20 h-full w-full object-cover opacity-40">
            {{-- Gradient Overlay --}}
            <div
                class="bg-linear-to-br from-1% absolute inset-0 z-10 from-[#EC0226] via-[#6A469C] via-30% to-[#007DFC] to-90%">
            </div>

            {{-- Content --}}
            <div class="md:mx-7.5 lg:py-13.5 lg:px-13.5 relative z-30 mx-6 py-5 lg:mx-0">
                <div class="mb-2 w-fit rounded-full border-2 border-[#D6111A]/20 bg-[#D6111A]/20 px-3.5 py-1">
                    <p class="text-[13px] font-semibold text-white">Editor's Choices</p>
                </div>
                <h1 class="mb-2 text-[24px] font-semibold text-white md:text-[28px] lg:text-[35px]">
                    {{ Str::words($editorChoice->title, 8, '...') }}
                </h1>
                <p class="mb-5 text-[12px] leading-[129.4%] tracking-[-3%] text-white md:text-[14px]">
                    {{ Str::words(strip_tags($editorChoice->description ?? $editorChoice->content), 16, '...') }}
                </p>
                <div class="w-57 md:w-63.25 mb-7 flex items-center justify-between lg:h-fit">
                    <div class="flex items-center gap-x-2.5 text-white">
                        <div class="h-9 w-9 shrink-0 overflow-hidden rounded-full border border-white/30">
                            <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                alt="Profile Picture" class="h-full w-full object-cover">
                        </div>
                        <p class="line-clamp-1 text-[10px] font-semibold"><span class="font-normal">By
                            </span>{{ $editorChoice->uploader ? $editorChoice->uploader->name : 'Admin' }}</p>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-2 text-white md:gap-x-3.5">
                        <x-letsicon-time-atack class="h-5 w-5" />
                        <span
                            class="text-[10px] font-medium md:text-[13px]">{{ strtoupper($editorChoice->published_at ? $editorChoice->published_at->format('d M Y') : $editorChoice->created_at->format('d M Y')) }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ url('/news/' . $editorChoice->slug) }}"
                        class="group flex w-fit items-center gap-x-3 text-[11px] font-medium text-white">
                        <div
                            class="w-7.5 h-7.5 md:w-6.5 md:h-6.5 flex shrink-0 items-center justify-center rounded-full border border-white transition-transform duration-300 group-hover:-rotate-45">
                            <x-fas-arrow-right class="h-3 w-3 text-white" />
                        </div>
                        READ STORY
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
