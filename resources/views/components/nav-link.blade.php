@props(['href', 'active' => false])

@php
$classes = ($active ?? false)
? 'rounded-md px-3 py-2 font-medium text-white underline decoration-2 underline-offset-4'
: 'rounded-md px-3 py-2 font-medium text-sky-100 hover:text-white transition-colors duration-200';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }} style="font-size: 17px;">
    {{ $slot }}
</a>