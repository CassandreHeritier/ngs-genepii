@props(['panel' => 'false'])

@if ($panel == 'true')
<div class="px-5">
    <form {{ $attributes->merge(['method' => 'get', 'class' => 'form-inline']) }} >
        {{ $slot }}
    </form>
</div>
@else
<form {{ $attributes->merge(['method' => 'get', 'class' => 'form-inline']) }} >
    {{ $slot }}
</form>
@endif