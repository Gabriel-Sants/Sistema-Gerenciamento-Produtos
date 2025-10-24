@props(['title', 'count' => null, 'icon' => null, 'color' => 'bg-primary', 'link' => '#'])

{{-- group block relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 --}}

<div 
    {{ $attributes->merge(['class' => 'color cursor-pointer flex flex-col items-center justify-center p-4 rounded-xl shadow transition duration-200 hover:-translate-y-1 hover:shadow-lg transition card-link']) }}
    style="color: white;"
    data-url="{{ $link }}"
>
    @if($icon)
        <i class="{{ $icon }} "></i>
    @endif
    
    <div class="text-lg font-semibold">{{ $title }}</div>
    <div class="text-sm opacity-80">{{ $count }}</div>
</div>

