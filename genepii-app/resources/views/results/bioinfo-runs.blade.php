<x-title type="2">Table runs bioinformatiques</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="bioinfoRunId">Identifiant de run bioinformatique :</x-form.label>
        <x-form.input name="bioinfoRunId" value="{{ request('bioinfoRunId') }}" placeholder="220506_ncov" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="seqRunId">Identifiant de run de séquençage :</x-form.label>
        <x-form.input name="seqRunId" value="{{ request('seqRunId') }}" placeholder="" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="setId">Numéro du set de paramètres pipeline :</x-form.label>
        <x-form.input name="setId" value="{{ request('setId') }}" placeholder="setId" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="bioinfoRunDate">Date du run bioinformatique :</x-form.label>
        <x-form.input name="bioinfoRunDate" value="{{ request('bioinfoRunDate') }}" placeholder="2022-05-06" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/bioinfo-runs'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="bioinfoRunsTable">
    <x-slot:thead>
        <!-- <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
        </x-thead> -->
        <x-thead>Identifiant de run bioinformatique</x-thead>
        <x-thead>Identifiant de run de séquençage</x-thead>
        <x-thead>Numéro du set de paramètres pipeline</x-thead>
        <x-thead>Date du run bioinformatique</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($bioinfo_runs as $bioinfo_run)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $bioinfo_run->id_bioinfo_run }}"/>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $bioinfo_run->id_bioinfo_run, 'tab' => 'bioinfo-run']) }}">
                        {{ $bioinfo_run->id_bioinfo_run }}
                    </a>
                </x-trow>
                <x-trow>{{ $bioinfo_run->id_seq_run }}</x-trow>
                <x-trow>{{ $bioinfo_run->id_set }}</x-trow>
                <x-trow>{{ $bioinfo_run->bioinfo_run_date }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $bioinfo_runs->links() }}
    </x-slot>
</x-table>