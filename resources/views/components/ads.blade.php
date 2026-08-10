@props(['position' => 'default'])

@php
    use App\Models\Advertisement;
    use Illuminate\Support\Str;

    $ad = Advertisement::where('position', $position)
        ->where('is_active', true)
        ->first();

    if (!$ad && $position !== 'default') {
        $ad = Advertisement::where('position', 'default')
            ->where('is_active', true)
            ->first();
    }

    $hasAdsense = !empty($ad?->adsense_code) && ($ad->is_adsense_active ?? true);
    $hasCmsImage = !empty($ad?->image);

    $imagePath = null;
    if ($hasCmsImage) {
        $imagePath = Str::startsWith($ad->image, ['http://', 'https://', 'images/']) 
            ? asset($ad->image) 
            : asset('storage/' . $ad->image);
    }
@endphp

@if ($ad && $hasAdsense)
    <div class="block w-full overflow-hidden flex items-center justify-center">
        {!! $ad->adsense_code !!}
    </div>
@elseif ($ad && $hasCmsImage)
    <a href="{{ $ad->link ?? '#' }}" 
       @if($ad->link) target="_blank" rel="noopener noreferrer" @endif 
       class="block w-full overflow-hidden flex items-center justify-center bg-gray-50">
        <img src="{{ $imagePath }}" 
             alt="{{ $ad->title }}" 
             class="w-full h-auto object-cover max-h-[120px] md:max-h-[150px] lg:max-h-[200px]" 
             fetchpriority="low">
    </a>
@else
    <div class="w-full rounded-md border border-dashed border-gray-300 bg-gray-100 p-8 text-center dark:border-[#515050] dark:bg-[#353434]">
        <p class="text-sm font-semibold text-[#A2A6A9] uppercase">
            ADS HERE ({{ str_replace('_', ' ', $position) }})
        </p>
    </div>
@endif