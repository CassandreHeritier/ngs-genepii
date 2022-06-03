@props(['name', 'tab'])

<li class="nav-item">
    @isset($name)
    <a href="{{ route('results', ['tab' => $name]) }}" id="{{ $name }}-tab" role="nav-link"
        {{ $attributes->class(['nav-link', 'active' => $tab == $name]) }}
    >
        {{ $slot }}
    </a>
    @else
    <a href="{{ route('results') }}" id="infos-tab" role="nav-link"
        {{ $attributes->class(['nav-link', 'active' => $tab == 'infos']) }}
    >
        <i class="fa-solid fa-circle-info"></i>
    </a>
    @endisset
</li>