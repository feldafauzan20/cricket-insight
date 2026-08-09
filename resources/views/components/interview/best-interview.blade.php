@props(['interviews'])

@if ($interviews->isNotEmpty())
    <div class="2xl:flex 2xl:gap-x-6">
        {{-- Big Card (Data Pertama) --}}
        <div class="md:mb-7.5 mb-5">
            <x-cards.best-interview-big-card :interview="$interviews->first()" />
        </div>

        {{-- Small Cards Container (Data ke-2 dan seterusnya) --}}
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
@endif
