<x-title type="2">Table Résultats Pangolin</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="pangolinId">Identifiant Pangolin :</x-form.label>
        <x-form.input name="pangolinId" value="{{ request('pangolinId') }}" placeholder="Numéro" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="bioinfoRunId">Numéro de run bioinfo :</x-form.label>
        <x-form.input name="bioinfoRunId" value="{{ request('bioinfoRunId') }}" placeholder="Identifiant" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="lineage">lineage :</x-form.label>
        <x-form.input name="lineage" value="{{ request('lineage') }}" placeholder="lineage" />
    </x-form.field>
    
    <x-form.field>
        <x-form.label name="conflict">conflict :</x-form.label>
        <x-form.input name="conflict" value="{{ request('conflict') }}" placeholder="conflict" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ambiguity_score">ambiguity_score :</x-form.label>
        <x-form.input name="ambiguity_score" value="{{ request('ambiguity_score') }}" placeholder="ambiguity_score" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="scorpio_call">scorpio_call :</x-form.label>
        <x-form.input name="scorpio_call" value="{{ request('scorpio_call') }}" placeholder="scorpio_call" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="scorpio_support">scorpio_support :</x-form.label>
        <x-form.input name="scorpio_support" value="{{ request('scorpio_support') }}" placeholder="scorpio_support" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="scorpio_conflict">scorpio_conflict :</x-form.label>
        <x-form.input name="scorpio_conflict" value="{{ request('scorpio_conflict') }}" placeholder="scorpio_conflict" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="scorpio_notes">scorpio_notes :</x-form.label>
        <x-form.input name="scorpio_notes" value="{{ request('scorpio_notes') }}" placeholder="scorpio_notes" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_version">pangolin_version :</x-form.label>
        <x-form.input name="pangolin_version" value="{{ request('pangolin_version') }}" placeholder="pangolin_version" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_version_nb">pangolin_version_nb :</x-form.label>
        <x-form.input name="pangolin_version_nb" value="{{ request('pangolin_version_nb') }}" placeholder="pangolin_version_nb" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="scorpio_version">scorpio_version :</x-form.label>
        <x-form.input name="scorpio_version" value="{{ request('scorpio_version') }}" placeholder="scorpio_version" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="constellation_version">constellation_version :</x-form.label>
        <x-form.input name="constellation_version" value="{{ request('constellation_version') }}" placeholder="constellation_version" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="is_designated">is_designated :</x-form.label>
        <x-form.input name="is_designated" value="{{ request('is_designated') }}" placeholder="is_designated" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_status">qc_status :</x-form.label>
        <x-form.input name="qc_status" value="{{ request('qc_status') }}" placeholder="qc_status" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_notes">qc_notes :</x-form.label>
        <x-form.input name="qc_notes" value="{{ request('qc_notes') }}" placeholder="qc_notes" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_note">pangolin_note :</x-form.label>
        <x-form.input name="pangolin_note" value="{{ request('pangolin_note') }}" placeholder="pangolin_note" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samplesheets'">Réinitialiser</x-form.button>
</x-form.layout>

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
        @foreach($pangolin_results as $pangolin_result)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $pangolin_result->id_pangolin }}"/>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $pangolin_result->id_pangolin, 'tab' => 'pangolin-result']) }}">
                        {{ $pangolin_result->id_pangolin }}
                    </a>
                </x-trow>
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
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $pangolin_results->links() }}
    </x-slot>
</x-table>