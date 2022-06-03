<x-title type="2">Table Dossiers GLIMS</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="fileId">Numéro de dossier :</x-form.label>
        <x-form.input name="fileId" value="{{ request('fileId') }}" placeholder="Numéro à 10 chiffres" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="patientId">Numéro de patient :</x-form.label>
        <x-form.input name="patientId" value="{{ request('patientId') }}" placeholder="Numéro" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="infoscan">Infoscan :</x-form.label>
        <x-form.input name="infoscan" value="{{ request('infoscan') }}" placeholder="Infoscan" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="infoband">Infoband :</x-form.label>
        <x-form.input name="infoband" value="{{ request('infoband') }}" placeholder="Infoband" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="flash">Enquête Flash :</x-form.label>
        <x-form.select name="flash" value="{{ request('flash') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="cluster">Cluster :</x-form.label>
        <x-form.select name="cluster" value="{{ request('cluster') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="reinfection">Réinfection :</x-form.label>
        <x-form.select name="reinfection" value="{{ request('reinfection') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinfection">Coinfection :</x-form.label>
        <x-form.select name="coinfection" value="{{ request('coinfection') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="seriousCase">Cas grave :</x-form.label>
        <x-form.select name="seriousCase" value="{{ request('seriousCase') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="epidemio">Situation épidémiologique anormale :</x-form.label>
        <x-form.select name="epidemio" value="{{ request('epidemio') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="symptoms">Symptômes :</x-form.label>
        <x-form.select name="symptoms" value="{{ request('symptoms') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="sthcov">STHCov :</x-form.label>
        <x-form.input name="sthcov" value="{{ request('sthcov') }}" placeholder="STHCov" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="extract">Extract :</x-form.label>
        <x-form.input name="extract" value="{{ request('extract') }}" placeholder="Extract" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ct">Ct :</x-form.label>
        <x-form.input name="ct" value="{{ request('ct') }}" placeholder="Nombre décimal (exemple: 19.4)" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="immunosuppressed">Immunodéprimé :</x-form.label>
        <x-form.select name="immunosuppressed" value="{{ request('immunosuppressed') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="detectionSurvey">Enquête de dépistage :</x-form.label>
        <x-form.select name="detectionSurvey" value="{{ request('detectionSurvey') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="acFailure">Echec traitement Ac :</x-form.label>
        <x-form.select name="acFailure" value="{{ request('acFailure') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="noIndication">Pas d'indication :</x-form.label>
        <x-form.select name="noIndication" value="{{ request('noIndication') }}" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/medical-files'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="medicalFilesTable">
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
        <x-thead>Numéro de dossier d'analyse</x-thead>
        <x-thead>Numéro de patient</x-thead>
        <x-thead>Infoscan</x-thead>
        <x-thead>Infoband</x-thead>
        <x-thead>Enquête Flash</x-thead>
        <x-thead>Cluster</x-thead>
        <x-thead>Réinfection</x-thead>
        <x-thead>Coinfection</x-thead>
        <x-thead>Cas grave</x-thead>
        <x-thead>Situation épidémiologique anormale</x-thead>
        <x-thead>Symptômes</x-thead>
        <x-thead>STHCov</x-thead>
        <x-thead>Extract</x-thead>
        <x-thead>Ct</x-thead>
        <x-thead>Immunodéprimé</x-thead>
        <x-thead>Enquête de dépistage</x-thead>
        <x-thead>Traitement Ac</x-thead>
        <x-thead>Pas d'indication</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($medical_files as $medical_file)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $medical_file->id_medical_file }}" />
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $medical_file->id_medical_file, 'tab' => 'medical-file']) }}">
                        {{ $medical_file->id_medical_file }}
                    </a>
                </x-trow>
                <x-trow>
                    @isset($medical_file->id_patient)
                    <a href="{{ route('results.show', ['id' => $medical_file->id_patient, 'tab' => 'patient']) }}">
                        {{ $medical_file->id_patient }}
                    </a>
                    @endisset
                </x-trow>
                <x-trow>{{ $medical_file->infoscan }}</x-trow>
                <x-trow>{{ $medical_file->infoband }}</x-trow>
                <x-trow>{{ $medical_file->flash_study }}</x-trow>
                <x-trow>{{ $medical_file->cluster }}</x-trow>
                <x-trow>{{ $medical_file->reinfection }}</x-trow>
                <x-trow>{{ $medical_file->coinfection }}</x-trow>
                <x-trow>{{ $medical_file->serious_case }}</x-trow>
                <x-trow>{{ $medical_file->abnormal_situation }}</x-trow>
                <x-trow>{{ $medical_file->symptoms }}</x-trow>
                <x-trow>{{ $medical_file->sthcov }}</x-trow>
                <x-trow>{{ $medical_file->extract }}</x-trow>
                <x-trow>{{ $medical_file->ct }}</x-trow>
                <x-trow>{{ $medical_file->immunosuppressed }}</x-trow>
                <x-trow>{{ $medical_file->detection_survey }}</x-trow>
                <x-trow>{{ $medical_file->ac_treatment }}</x-trow>
                <x-trow>{{ $medical_file->no_indication }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $medical_files->links() }}
    </x-slot>
</x-table>