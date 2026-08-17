@props(['items' => []])

<nav aria-label="Breadcrumb">
    <ol class="flex items-center text-sm">
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                @if ($index > 0)
                    <span class="mx-2 text-[#121212] text-[9px] dark:text-white">»</span>
                @endif

                @if (isset($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}"
                        class="text-[#121212] text-xs dark:text-white hover:text-red-500 dark:hover:text-red-400 transition-colors">
                        {{ $item['title'] }}
                    </a>
                @else
                    <span class="text-[#A2A6A9] text-xs dark:text-[#A2A6A9]">
                        {{ $item['title'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

@if (!empty($items))
<script type="application/ld+json">
{!! json_encode(\App\Support\Seo\JsonLd::breadcrumbList($items, url()->current()), JSON_UNESCAPED_SLASHES) !!}
</script>
@endif
