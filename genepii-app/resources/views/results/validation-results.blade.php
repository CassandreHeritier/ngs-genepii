<x-title type="2">Table Résultats de validation</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="validationId">Identifiant validation :</x-form.label>
        <x-form.input name="validationId" value="{{ request('validationId') }}" placeholder="Numéro" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="bioinfoRunId">Numéro de run bioinfo :</x-form.label>
        <x-form.input name="bioinfoRunId" value="{{ request('bioinfoRunId') }}" placeholder="Identifiant" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="dp">dp :</x-form.label>
        <x-form.input name="dp" value="{{ request('dp') }}" placeholder="dp" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="val_varcount">val_varcount :</x-form.label>
        <x-form.input name="val_varcount" value="{{ request('val_varcount') }}" placeholder="val_varcount" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="rbmcoverage">rbmcoverage :</x-form.label>
        <x-form.input name="rbmcoverage" value="{{ request('rbmcoverage') }}" placeholder="rbmcoverage" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="spikecoverage">spikecoverage :</x-form.label>
        <x-form.input name="spikecoverage" value="{{ request('spikecoverage') }}" placeholder="spikecoverage" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade">nextclade :</x-form.label>
        <x-form.input name="nextclade" value="{{ request('nextclade') }}" placeholder="nextclade" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin">pangolin :</x-form.label>
        <x-form.input name="pangolin" value="{{ request('pangolin') }}" placeholder="pangolin" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="classmatch">classmatch :</x-form.label>
        <x-form.input name="classmatch" value="{{ request('classmatch') }}" placeholder="classmatch" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="classindex">classindex :</x-form.label>
        <x-form.input name="classindex" value="{{ request('classindex') }}" placeholder="classindex" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="classcomment">classcomment :</x-form.label>
        <x-form.input name="classcomment" value="{{ request('classcomment') }}" placeholder="classcomment" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="val_insertions">val_insertions :</x-form.label>
        <x-form.input name="val_insertions" value="{{ request('val_insertions') }}" placeholder="val_insertions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="expectedprofile">expectedprofile :</x-form.label>
        <x-form.input name="expectedprofile" value="{{ request('expectedprofile') }}" placeholder="expectedprofile" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="likelyprofile">likelyprofile :</x-form.label>
        <x-form.input name="likelyprofile" value="{{ request('likelyprofile') }}" placeholder="likelyprofile" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nocovsub">nocovsub :</x-form.label>
        <x-form.input name="nocovsub" value="{{ request('nocovsub') }}" placeholder="nocovsub" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nocovins">nocovins :</x-form.label>
        <x-form.input name="nocovins" value="{{ request('nocovins') }}" placeholder="nocovins" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="missingsub">missingsub :</x-form.label>
        <x-form.input name="missingsub" value="{{ request('missingsub') }}" placeholder="missingsub" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="atypicsub">atypicsub :</x-form.label>
        <x-form.input name="atypicsub" value="{{ request('atypicsub') }}" placeholder="atypicsub" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="atypicindel">atypicindel :</x-form.label>
        <x-form.input name="atypicindel" value="{{ request('atypicindel') }}" placeholder="atypicindel" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="avisbio">avisbio :</x-form.label>
        <x-form.input name="avisbio" value="{{ request('avisbio') }}" placeholder="avisbio" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="result">result :</x-form.label>
        <x-form.input name="result" value="{{ request('result') }}" placeholder="result" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="commentary">commentary :</x-form.label>
        <x-form.input name="commentary" value="{{ request('commentary') }}" placeholder="commentary" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="error">error :</x-form.label>
        <x-form.input name="error" value="{{ request('error') }}" placeholder="error" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samplesheets'">Réinitialiser</x-form.button>
</x-form.layout>

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
        @foreach($validation_results as $validation_result)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $validation_result->id_validation }}"/>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $validation_result->id_validation, 'tab' => 'validation-result']) }}">
                        {{ $validation_result->id_validation }}
                    </a>
                </x-trow>
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
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $validation_results->links() }}
    </x-slot>
</x-table>