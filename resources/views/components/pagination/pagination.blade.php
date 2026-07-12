@if ($paginator && $paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center rounded-[3px] md:w-96">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span
                class="inline-flex w-full cursor-not-allowed items-center justify-center gap-1.5 border border-[#CFD6DC] bg-white px-3 py-2 text-[14px] font-medium text-[#121212] opacity-50 dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-600">
                <x-ri-arrow-left-s-line class="h-4 w-4" />
                <span>Previous</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="inline-flex w-full items-center justify-center gap-1.5 border border-[#CFD6DC] bg-white px-3 py-2 text-[14px] font-medium text-[#121212] transition-colors duration-150 hover:bg-gray-50 dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-300 dark:hover:bg-[#2A2A2A]">
                <x-ri-arrow-left-s-line class="h-4 w-4" />
                <span>Previous</span>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($pages as $page)
            @if ($page === '...')
                {{-- Ellipsis --}}
                <span
                    class="inline-flex w-full cursor-default items-center justify-center border border-[#CFD6DC] bg-white py-2 text-[14px] font-medium text-gray-500 md:px-3 dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-white"
                    aria-hidden="true">
                    &hellip;
                </span>
            @elseif ($page == $currentPage)
                {{-- Active Page --}}
                <span
                    class="inline-flex w-full items-center justify-center border border-[#CFD6DC] bg-[#FFBAC5] py-2 text-[14px] font-semibold text-[#EC0226] md:px-3 dark:border-[#CFD6DC]"
                    aria-current="page" aria-label="Page {{ $page }}, current page">
                    {{ $page }}
                </span>
            @else
                {{-- Regular Page Link --}}
                <a href="{{ $paginator->url($page) }}"
                    class="inline-flex w-full items-center justify-center border border-[#CFD6DC] bg-white py-2 text-[14px] font-medium text-[#121212] transition-colors duration-150 hover:bg-gray-50 md:px-3 dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-300 dark:hover:bg-[#2A2A2A]"
                    aria-label="Go to page {{ $page }}">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="inline-flex w-full items-center justify-center gap-1.5 border border-[#CFD6DC] bg-white px-3 py-2 text-[14px] font-medium text-[#121212] transition-colors duration-150 hover:bg-gray-50 dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-300 dark:hover:bg-[#2A2A2A]">
                <span>Next</span>
                <x-ri-arrow-right-s-line class="h-4 w-4" />
            </a>
        @else
            <span
                class="inline-flex w-full cursor-not-allowed items-center justify-center gap-1.5 border border-[#CFD6DC] bg-white px-3 py-2 text-[14px] font-medium text-gray-400 opacity-50 dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-600">
                <span>Next</span>
                <x-ri-arrow-right-s-line class="h-4 w-4" />
            </span>
        @endif
    </nav>
@endif
