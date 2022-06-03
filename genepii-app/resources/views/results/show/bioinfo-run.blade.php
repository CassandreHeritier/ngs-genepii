<x-title type="2">Run bioinformatique {{ $bioinfo_run->id_bioinfo_run }}</x-title>

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
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $bioinfo_run->id_bioinfo_run }}"/>
            </x-trow> -->
            <x-trow>{{ $bioinfo_run->id_bioinfo_run }}</x-trow>
            <x-trow>{{ $bioinfo_run->id_seq_run }}</x-trow>
            <x-trow>{{ $bioinfo_run->id_set }}</x-trow>
            <x-trow>{{ $bioinfo_run->bioinfo_run_date }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'bioinfo-runs']) }}">Retour aux runs bioinformatiques</a>
    </x-slot>
</x-table>

<x-title type="3">Résultats d'analyse :</x-title>
<ul>
    <li>
        <a href="{{ route('results', ['tab' => 'nextclade-results', 'bioinfoRunId' => '220506_ncov']) }}">
            Résultats Nextclade
        </a>
    </li>
    <li>
        <a href="{{ route('results', ['tab' => 'pangolin-results', 'bioinfoRunId' => '220506_ncov']) }}">
            Résultats Pangolin
        </a>
    </li>
    <li>
        <a href="{{ route('results', ['tab' => 'summary-results', 'bioinfoRunId' => '220506_ncov']) }}">
            Résultats de summary
        </a>
    </li>
    <li>
        <a href="{{ route('results', ['tab' => 'validation-results', 'bioinfoRunId' => '220506_ncov']) }}">
            Résultats de validation
        </a>
    </li>
</ul>