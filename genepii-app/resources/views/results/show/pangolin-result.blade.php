<x-title type="2">Résultat de Pangolin {{ $pangolin_result->id_pangolin }}</x-title>

<x-table class="pangolinTable">
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
        <x-thead>Identifiant pangolin</x-thead>
        <x-thead>Numéro de run bioinfo</x-thead>
        <x-thead>lineage</x-thead>
        <x-thead>conflict</x-thead>
        <x-thead>ambiguity_score</x-thead>
        <x-thead>scorpio_call</x-thead>
        <x-thead>scorpio_support</x-thead>
        <x-thead>scorpio_conflict</x-thead>
        <x-thead>scorpio_notes</x-thead>
        <x-thead>pangolin_version</x-thead>
        <x-thead>pangolin_version_nb</x-thead>
        <x-thead>scorpio_version</x-thead>
        <x-thead>constellation_version</x-thead>
        <x-thead>is_designated</x-thead>
        <x-thead>qc_status</x-thead>
        <x-thead>qc_notes</x-thead>
        <x-thead>pangolin_note</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $pangolin_result->id_pangolin }}"/>
            </x-trow> -->
            <x-trow>{{ $pangolin_result->id_pangolin }}</x-trow>
            <x-trow>{{ $pangolin_result->id_bioinfo_run }}</x-trow>
            <x-trow>{{ $pangolin_result->lineage }}</x-trow>
            <x-trow>{{ $pangolin_result->conflict }}</x-trow>
            <x-trow>{{ $pangolin_result->ambiguity_score }}</x-trow>
            <x-trow>{{ $pangolin_result->scorpio_call }}</x-trow>
            <x-trow>{{ $pangolin_result->scorpio_support }}</x-trow>
            <x-trow>{{ $pangolin_result->scorpio_conflict }}</x-trow>
            <x-trow>{{ $pangolin_result->scorpio_notes }}</x-trow>
            <x-trow>{{ $pangolin_result->pangolin_version }}</x-trow>
            <x-trow>{{ $pangolin_result->pangolin_version_nb }}</x-trow>
            <x-trow>{{ $pangolin_result->scorpio_version }}</x-trow>
            <x-trow>{{ $pangolin_result->constellation_version }}</x-trow>
            <x-trow>{{ $pangolin_result->is_designated }}</x-trow>
            <x-trow>{{ $pangolin_result->qc_status }}</x-trow>
            <x-trow>{{ $pangolin_result->qc_notes }}</x-trow>
            <x-trow>{{ $pangolin_result->pangolin_note }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'pangolin-results']) }}">Retour aux résultats de Pangolin</a>
    </x-slot>
</x-table>