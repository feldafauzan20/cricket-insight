@props(['streamingPartners' => null])

@php
    if (empty($streamingPartners)) {
        $streamingPartners = \App\Http\Controllers\StreamingPartnerController::getActivePartners(10);
    }
@endphp

{{-- STREAMING PARTNERS START --}}
<div class="mt-12.5 md:mt-25 relative w-full overflow-hidden">

    <img src="{{ asset('images/background-image-abstract/bg-img-marquee-bbi-wbbi-light.webp') }}" alt="Marquee Background"
        width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover opacity-10 dark:hidden dark:opacity-5">
    <img src="{{ asset('images/background-image-abstract/bg-img-marquee-bbi-wbbi-dark.webp') }}" alt="Marquee Background"
        width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover opacity-10 dark:block dark:opacity-5">

    <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6">
        @foreach ($streamingPartners as $partner)
            <div
                class="py-12.5 px-12.5 md:py-12.5 md:px-16.5 2xl:py-23.25 2xl:px-13.25 h-35 flex items-center justify-center border border-[#B6B6B6] 2xl:h-60">
                <img src="{{ is_object($partner) ? $partner->image_url : (is_array($partner) ? asset($partner['src'] ?? $partner['image'] ?? '') : asset($partner)) }}"
                    alt="{{ is_object($partner) ? $partner->title : ($partner['alt'] ?? $partner['title'] ?? '') }}"
                    class="h-20 w-32 md:h-28 md:w-44 object-contain" loading="lazy">
            </div>
        @endforeach
    </div>
</div>
{{-- STREAMING PARTNERS END --}}
