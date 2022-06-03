<x-title type="2">Extraction {{ $extraction->id_extraction }}</x-title>

<x-table class="extractionsTable">
    <!-- <x-slot:thead>
        <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
            <form method="post" action="{{ route('results.download') }}">
                @csrf
                <button id="exportResults" disabled="true" type="submit" name="submit" value="export">
                    <i class="fa-solid fa-download"></i>
                </button>
            </form>
        </x-thead> -->
        <x-thead>Numéro d'extraction</x-thead>
        <x-thead>Plaque</x-thead>
        <x-thead>Prélèvement</x-thead>
        <x-thead>TRackBC</x-thead>
        <x-thead>TLabwareId</x-thead>
        <x-thead>TPositionId</x-thead>
        <x-thead>TPositionBC</x-thead>
        <x-thead>TStatusSummary</x-thead>
        <x-thead>TSumStateDescription</x-thead>
        <x-thead>TVolume</x-thead>
        <x-thead>SRackBC</x-thead>
        <x-thead>SLabwareId</x-thead>
        <x-thead>SPositionId</x-thead>
        <x-thead>SPositionBC</x-thead>
        <x-thead>Date d'extraction</x-thead>
        <x-thead>Automate</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $extraction->id_extraction }}"/>
            </x-trow> -->
            <x-trow>{{ $extraction->id_extraction }}</x-trow>
            <x-trow>{{ $extraction->id_plate }}</x-trow>
            <x-trow>{{ $extraction->id_sample }}</x-trow>
            <x-trow>{{ $extraction->track_bc }}</x-trow>
            <x-trow>{{ $extraction->tlabware_id }}</x-trow>
            <x-trow>{{ $extraction->tposition_id }}</x-trow>
            <x-trow>{{ $extraction->tposition_bc }}</x-trow>
            <x-trow>{{ $extraction->tstatus_summary }}</x-trow>
            <x-trow>{{ $extraction->tsum_state_description }}</x-trow>
            <x-trow>{{ $extraction->tvolume }}</x-trow>
            <x-trow>{{ $extraction->srack_bc }}</x-trow>
            <x-trow>{{ $extraction->slabware_id }}</x-trow>
            <x-trow>{{ $extraction->sposition_id}}</x-trow>
            <x-trow>{{ $extraction->sposition_bc}}</x-trow>
            <x-trow>{{ $extraction->action_date_time}}</x-trow>
            <x-trow>{{ $extraction->user_name}}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'extractions']) }}">Retour aux extractions</a>
    </x-slot>
</x-table>