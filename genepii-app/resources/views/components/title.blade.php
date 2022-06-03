@props(['type' => '1'])

@if ($type == 1)
    <h1 {{ $attributes->merge(['class' => 'display-4 my-2 text-center']) }} >{{ $slot }}</h1>
@elseif ($type == 2)
    <h3 {{ $attributes->merge(['class' => 'm-4']) }} >{{ $slot }}</h3>
@elseif ($type == 3)
    <h4  {{ $attributes->merge(['class' => 'text-info row m-2']) }} >{{ $slot }}</h4>
@else
    <h4 {{ $attributes->merge(['class' => 'text-sm row']) }}>{{ $slot }}</h4>
@endif