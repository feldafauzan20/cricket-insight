@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center rounded-[3px] md:w-96">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span
                class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 text-[14px] font-medium border border-[#CFD6DC] dark:border-[#CFD6DC] bg-white dark:bg-[#1F1F1F] text-[#121212] dark:text-gray-600 cursor-not-allowed opacity-50">
                <x-ri-arrow-left-s-line class="w-4 h-4" />
                <span>Previous</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 text-[14px] font-medium border border-[#CFD6DC] dark:border-[#CFD6DC] bg-white dark:bg-[#1F1F1F] text-[#121212] dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#2A2A2A] transition-colors duration-150">
                <x-ri-arrow-left-s-line class="w-4 h-4" />
                <span>Previous</span>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($pages as $page)
            @if ($page === '...')
                {{-- Ellipsis --}}
                <span
                    class="inline-flex items-center justify-center w-full py-2 md:px-3 text-[14px] font-medium  border border-[#CFD6DC] dark:border-[#CFD6DC] bg-white dark:bg-[#1F1F1F] text-gray-500 dark:text-white cursor-default"
                    aria-hidden="true">
                    &hellip;
                </span>
            @elseif ($page == $currentPage)
                {{-- Active Page --}}
                <span
                    class="inline-flex items-center justify-center w-full py-2 md:px-3 text-[14px] font-semibold  border border-[#CFD6DC] dark:border-[#CFD6DC] bg-[#FFBAC5] text-[#EC0226]"
                    aria-current="page" aria-label="Page {{ $page }}, current page">
                    {{ $page }}
                </span>
            @else
                {{-- Regular Page Link --}}
                <a href="{{ $paginator->url($page) }}"
                    class="inline-flex items-center justify-center w-full py-2 md:px-3 text-[14px] font-medium  border border-[#CFD6DC] dark:border-[#CFD6DC] bg-white dark:bg-[#1F1F1F] text-[#121212] dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#2A2A2A] transition-colors duration-150"
                    aria-label="Go to page {{ $page }}">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 text-[14px] font-medium border border-[#CFD6DC] dark:border-[#CFD6DC] bg-white dark:bg-[#1F1F1F] text-[#121212] dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#2A2A2A] transition-colors duration-150">
                <span>Next</span>
                <x-ri-arrow-right-s-line class="w-4 h-4" />
            </a>
        @else
            <span
                class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 text-[14px] font-medium border border-[#CFD6DC] dark:border-[#CFD6DC] bg-white dark:bg-[#1F1F1F] text-gray-400 dark:text-gray-600 cursor-not-allowed opacity-50">
                <span>Next</span>
                <x-ri-arrow-right-s-line class="w-4 h-4" />
            </span>
        @endif
    </nav>
@endif
