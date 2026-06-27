@props(['position' => 'default'])

@php
    use App\Models\Advertisement;
    use Illuminate\Support\Str;

    $ad = Advertisement::where('position', $position)
        ->where('is_active', true)
        ->first();

    $imagePath = null;
    if ($ad) {
        $imagePath = Str::startsWith($ad->image, 'images/') 
            ? asset($ad->image) 
            : asset('storage/' . $ad->image);
    }
@endphp

@if($ad)

    <a href="{{ $ad->link ?? '#' }}" 
       @if($ad->link) target="_blank" rel="noopener noreferrer" @endif 
       class="block w-full overflow-hidden flex items-center justify-center bg-gray-50">
        
        <img src="{{ $imagePath }}" 
             alt="{{ $ad->title }}" 
             class="w-full h-auto object-cover max-h-[120px] md:max-h-[150px] lg:max-h-[200px]" 
             fetchpriority="low">
    </a>
@else
    <div class="bg-gray-200 flex items-center justify-center py-12 w-full">
        <p class="text-gray-500 font-semibold text-lg">
            ADS HERE ({{ str_replace('_', ' ', strtoupper($position)) }})
        </p>
    </div>
@endif