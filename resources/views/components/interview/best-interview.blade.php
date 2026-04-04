@php
    // Data dummy untuk 20 interviews
    $interviews = collect(range(1, 20))->map(function ($i) {
        return [
            'title' => 'Interview ' . $i . ': Garuda Gentlemen triumphed over the Dispora India team',
            'category' => 'Matches',
            'date' => '19 JAN 2026',
            'excerpt' =>
                'In an exclusive interview, we discuss the journey, challenges faced, and the mindset that has driven success in cricket.',
            'author' => 'FARHAN DUDI',
            'views' => '1.2K',
            'read_time' => '4 Mins Read',
            'image' => 'images/dummy/commentaries/dummy-commentaries-' . (($i % 3) + 1) . '.webp',
            'author_image' => 'images/dummy/hero-home/profile-picture-dummy.webp',
        ];
    });
@endphp

<div class="2xl:flex 2xl:gap-x-6">
    {{-- Big Card (Data Pertama) --}}
    <div class="md:mb-7.5 mb-5">
        <x-cards.best-interview-big-card :interview="$interviews->first()" />
    </div>

    {{-- Small Cards Container (Data ke-2 sampai ke-20) --}}
    <div
        class="px-3.75 max-h-400 2xl:max-h-153.25 overflow-y-auto rounded-[3px] border border-[#F3F3F3] py-5 shadow-md dark:border-[#515050] dark:bg-[#353434]">
        @foreach ($interviews->skip(1) as $interview)
            <x-cards.best-interview-small-card :interview="$interview" />

            {{-- Divider - hanya muncul jika BUKAN card terakhir --}}
            @if (!$loop->last)
                <div class="my-3.75 flex">
                    <div class="w-7.5 h-px bg-[#007DFC]"></div>
                    <div class="h-px w-full bg-[#EFEFEF] dark:bg-[#DEDEDE]"></div>
                </div>
            @endif
        @endforeach
    </div>
</div>
