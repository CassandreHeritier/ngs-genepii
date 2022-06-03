<x-title type="2">Table Samplesheets</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="samplesheetId">Numéro de samplesheet :</x-form.label>
        <x-form.input name="samplesheetId" value="{{ request('samplesheetId') }}" placeholder="2" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="seqRunId">Numéro de run de séquençage :</x-form.label>
        <x-form.input name="seqRunId" value="{{ request('seqRunId') }}" placeholder="220506_A01413_0146_AH3LF3DRX2" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="sampleId">Numéro de prélèvement :</x-form.label>
        <x-form.input name="sampleId" value="{{ request('sampleId') }}" placeholder="022055698601" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="plateId">Numéro de plaque :</x-form.label>
        <x-form.input name="plateId" value="{{ request('plateId') }}" placeholder="Pl071" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="platewell">Numéro de puits :</x-form.label>
        <x-form.input name="platewell" value="{{ request('platewell') }}" placeholder="S07" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="lane">Lane :</x-form.label>
        <x-form.input name="lane" value="{{ request('lane') }}" placeholder="1" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="index1">Index 1 :</x-form.label>
        <x-form.input name="index1" value="{{ request('index1') }}" placeholder="ATTCGCACTA" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="index2">Index 2 :</x-form.label>
        <x-form.input name="index2" value="{{ request('index2') }}" placeholder="TCTGTATGGT" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="setIndex">Set index :</x-form.label>
        <x-form.input name="setIndex" value="{{ request('setIndex') }}" placeholder="IDT1" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="protocol">Protocole :</x-form.label>
        <x-form.input name="protocol" value="{{ request('protocol') }}" placeholder="covidseq" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="primers">Primers :</x-form.label>
        <x-form.input name="primers" value="{{ request('primers') }}" placeholder="articV4.1" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="sampleProject">Sample project :</x-form.label>
        <x-form.input name="sampleProject" value="{{ request('sampleProject') }}" placeholder="SARSCOV2-ARTIC" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="bioinfoProject">Bioinfo project :</x-form.label>
        <x-form.input name="bioinfoProject" value="{{ request('bioinfoProject') }}" placeholder="ncov" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samplesheets'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="samplesheetsTable">
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
        <x-thead>Samplesheet</x-thead>
        <x-thead>Run de séquençage</x-thead>
        <x-thead>Prélèvement</x-thead>
        <x-thead>Plaque</x-thead>
        <x-thead>Puits</x-thead>
        <x-thead>Lane</x-thead>
        <x-thead>Index 1</x-thead>
        <x-thead>Index 2</x-thead>
        <x-thead>Set index</x-thead>
        <x-thead>Protocole</x-thead>
        <x-thead>Primers</x-thead>
        <x-thead>Samples project</x-thead>
        <x-thead>Bioinfo project</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($samplesheets as $samplesheet)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $samplesheet->id_samplesheet }}"/>
                </x-trow> -->
                <x-trow>
                    <!-- <a href="{{ route('results.show', ['id' => $samplesheet->id_samplesheet, 'tab' => 'samplesheet']) }}"> -->
                        {{ $samplesheet->id_samplesheet }}
                    <!-- </a> -->
                </x-trow>
                <x-trow>{{ $samplesheet->id_seq_run }}</x-trow>
                <x-trow>{{ $samplesheet->id_sample }}</x-trow>
                <x-trow>{{ $samplesheet->id_plate }}</x-trow>
                <x-trow>{{ $samplesheet->platewell }}</x-trow>
                <x-trow>{{ $samplesheet->lane }}</x-trow>
                <x-trow>{{ $samplesheet->index_1 }}</x-trow>
                <x-trow>{{ $samplesheet->index_2 }}</x-trow>
                <x-trow>{{ $samplesheet->set_index }}</x-trow>
                <x-trow>{{ $samplesheet->protocol }}</x-trow>
                <x-trow>{{ $samplesheet->primers }}</x-trow>
                <x-trow>{{ $samplesheet->sample_project }}</x-trow>
                <x-trow>{{ $samplesheet->bioinfo_project }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $samplesheets->links() }}
    </x-slot>
</x-table>