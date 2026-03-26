@props(['galleries' => []])

<div class="gap-y-6.25 md:gap-x-4.5 grid grid-cols-1 md:grid-cols-2 lg:gap-y-10 2xl:grid-cols-3">
    @foreach ($galleries as $index => $gallery)
        <div x-show="itemsToShow > {{ $index }}" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100">

            <x-cards.gallery.gallery-card :title="$gallery['title']" :description="$gallery['description']" :image-url="$gallery['image_url']" :year="$gallery['year']"
                :views="$gallery['views']" />
        </div>
    @endforeach
</div>
