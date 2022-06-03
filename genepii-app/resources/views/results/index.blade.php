@extends('layouts.app')

@section('content')
<x-panel>
    
    <x-title>Résultats</x-title>

    <x-results.nav-bar tab="{{ $tab ?? 'infos' }}" />

    <x-results.tab-content tab="{{ $tab ?? 'infos' }}">
        @isset($tab)
            @include('results.' . $tab)
        @else
            <x-results.infos />
        @endisset
    </x-results.tab-content>

</x-panel>
@endsection