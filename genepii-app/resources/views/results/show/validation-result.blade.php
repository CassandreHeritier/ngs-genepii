<x-title type="2">Résultat de validation {{ $validation_result->id_validation }}</x-title>

<x-table class="validationTable">
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
        <x-thead>Identifiant validation</x-thead>
        <x-thead>Numéro de run bioinfo</x-thead>
        <x-thead>dp</x-thead>
        <x-thead>val_varcount</x-thead>
        <x-thead>rbmcoverage</x-thead>
        <x-thead>spikecoverage</x-thead>
        <x-thead>nextclade</x-thead>
        <x-thead>pangolin</x-thead>
        <x-thead>classmatch</x-thead>
        <x-thead>classindex</x-thead>
        <x-thead>classcomment</x-thead>
        <x-thead>val_insertions</x-thead>
        <x-thead>expectedprofile</x-thead>
        <x-thead>likelyprofile</x-thead>
        <x-thead>nocovsub</x-thead>
        <x-thead>nocovins</x-thead>
        <x-thead>missingsub</x-thead>
        <x-thead>atypicsub</x-thead>
        <x-thead>atypicindel</x-thead>
        <x-thead>avisbio</x-thead>
        <x-thead>result</x-thead>
        <x-thead>commentary</x-thead>
        <x-thead>error</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $validation_result->id_validation }}"/>
            </x-trow> -->
            <x-trow>{{ $validation_result->id_validation }}</x-trow>
            <x-trow>{{ $validation_result->id_bioinfo_run }}</x-trow>
            <x-trow>{{ $validation_result->dp }}</x-trow>
            <x-trow>{{ $validation_result->val_varcount }}</x-trow>
            <x-trow>{{ $validation_result->rbmcoverage }}</x-trow>
            <x-trow>{{ $validation_result->spikecoverage }}</x-trow>
            <x-trow>{{ $validation_result->nextclade }}</x-trow>
            <x-trow>{{ $validation_result->pangolin }}</x-trow>
            <x-trow>{{ $validation_result->classmatch }}</x-trow>
            <x-trow>{{ $validation_result->classindex }}</x-trow>
            <x-trow>{{ $validation_result->classcomment }}</x-trow>
            <x-trow>{{ $validation_result->val_insertions }}</x-trow>
            <x-trow>{{ $validation_result->expectedprofile }}</x-trow>
            <x-trow>{{ $validation_result->likelyprofile }}</x-trow>
            <x-trow>{{ $validation_result->nocovsub }}</x-trow>
            <x-trow>{{ $validation_result->nocovins }}</x-trow>
            <x-trow>{{ $validation_result->missingsub }}</x-trow>
            <x-trow>{{ $validation_result->atypicsub }}</x-trow>
            <x-trow>{{ $validation_result->atypicindel }}</x-trow>
            <x-trow>{{ $validation_result->avisbio }}</x-trow>
            <x-trow>{{ $validation_result->result }}</x-trow>
            <x-trow>{{ $validation_result->commentary }}</x-trow>
            <x-trow>{{ $validation_result->error }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'validation-results']) }}">Retour aux résultats de validation</a>
    </x-slot>
</x-table>