@props(['firstColor' => '#fe7754', 'lastColor' => '#fd277c', 'idGradient' => 'dislike'])

@php
    $stopFirstColor = "stop-color:{$firstColor}";
    $stopLastColor = "stop-color:{$lastColor}";
@endphp

<svg
    {{ $attributes }}
    xmlns="http://www.w3.org/2000/svg"
    fill="currentColor"
>
    <defs>
        <linearGradient
            id="{{ $idGradient }}"
            x1="{{ $x1 ?? "0%" }}"
            y1="{{ $y1 ?? "50%" }}"
            x2="{{ $x2 ?? "100%" }}"
            y2="{{ $y2 ?? "0%" }}"
        >
            <stop offset="0%" style="{{ $stopFirstColor }};stop-opacity:1" />
            <stop offset="100%" style="{{ $stopLastColor }};stop-opacity:1" />
        </linearGradient>
    </defs>
    {{ $slot }}
</svg>
