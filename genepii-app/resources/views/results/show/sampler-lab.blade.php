<x-title type="2">Laboratoire préleveur {{ $sampler_lab->name_sampler }}</x-title>

<x-table class="samplerLabTable">
    <x-slot:thead>
        <!-- <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
            <form method="post" action="{{ route('results.download') }}">
                @csrf
                <button id="exportResults" disabled="true" type="submit" name="submit" value="export">
                    <i class="fa-solid fa-download"></i>
                </button>
            </form>
        </x-thead> -->
        <x-thead>Nom du laboratoire préleveur</x-thead>
        <x-thead>Finess</x-thead>
        <x-thead>UF</x-thead>
        <x-thead>Type</x-thead>
        <x-thead>Code postal</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $sampler_lab->id_sampler_lab }}"/>
            </x-trow> -->
            <x-trow>{{ $sampler_lab->name_sampler }}</x-trow>
            <x-trow>{{ $sampler_lab->finess_sampler }}</x-trow>
            <x-trow>{{ $sampler_lab->UF_sampler }}</x-trow>
            <x-trow>{{ $sampler_lab->type_sampler }}</x-trow>
            <x-trow>{{ $sampler_lab->postal_code_sampler }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'sampler-labs']) }}">Retour aux laboratoires préleveurs</a>
    </x-slot>
</x-table>