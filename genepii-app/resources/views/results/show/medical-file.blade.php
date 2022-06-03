<x-title type="2">Dossier GLIMS {{ $medical_file->id_medical_file }}</x-title>

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
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $medical_file->id_medical_file }}" />
            </x-trow> -->
            <x-trow>{{ $medical_file->id_medical_file }}</x-trow>
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
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'medical-files']) }}">Retour aux dossiers</a>
    </x-slot>
</x-table>

<x-title type="3">Prélèvement(s) associé(s)</x-title>

<x-table class="samplesTable">
    <x-slot:thead>
        <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
            <form method="post" action="{{ route('results.download') }}">
                @csrf
                <button id="exportResults" disabled="true" type="submit" name="submit" value="export">
                    <i class="fa-solid fa-download"></i>
                </button>
            </form>
        </x-thead>
        <x-thead>Numéro de prélèvement</x-thead>
        <x-thead>Numéro de dossier d'analyse</x-thead>
        <x-thead>Envoyé par le laboratoire</x-thead>
        <x-thead>Type de prélèvement</x-thead>
        <x-thead>Date du prélèvement</x-thead>
        <x-thead>Date d'enregistrement</x-thead>
        <x-thead>Date de validation</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($medical_file->samples as $sample)
            <tr>
                <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $sample->id_sample }}" />
                </x-trow>
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $sample->id_sample, 'tab' => 'sample']) }}">
                        {{ $sample->id_sample }}
                    </a>
                </x-trow>
                <x-trow>{{ $sample->id_medical_file }}</x-trow>
                <x-trow>@if (isset($sample->laboratory)) {{ $sample->laboratory->name_sender }} @endif</x-trow>
                <x-trow>{{ $sample->sampling_type }}</x-trow>
                <x-trow>{{ $sample->sampling_date }}</x-trow>
                <x-trow>{{ $sample->registration_date }}</x-trow>
                <x-trow>{{ $sample->validation_date }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'samples']) }}">Retour aux prélèvements</a>
    </x-slot>
</x-table>