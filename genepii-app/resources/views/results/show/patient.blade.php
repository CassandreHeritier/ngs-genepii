<x-title type="2">Patient {{ $patient->id_patient }}</x-title>

<x-table class="patientsTable">
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
        <x-thead>Numéro de patient</x-thead>
        <!-- <x-thead>Date de naissance</x-thead> -->
        <!-- <x-thead>Âge</x-thead> -->
        <x-thead>IPP</x-thead>
        <!-- <x-thead>Sexe</x-thead> -->
        <x-thead>Nombre de doses vaccin</x-thead>
        <x-thead>Nom vaccin</x-thead>
        <x-thead>Date première dose</x-thead>
        <x-thead>Date seconde dose</x-thead>
        <x-thead>Date dernière dose</x-thead>
        <x-thead>Echec vaccination</x-thead>
        <x-thead>Vacciné</x-thead>
        <x-thead>Vaccination anti-SARS-CoV-2</x-thead>
        <x-thead>Schéma vaccinal complet</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <x-trow>{{ $patient->id_patient }}</x-trow>
            <!-- @if (!is_null($patient->birth_date))
            <x-trow>{{ $patient->birth_date }}</x-trow>
            @else
            <x-trow>{{ $patient->birth_year }}</x-trow>
            @endif -->
            <!-- <x-trow>{{ $patient->age }}</x-trow> -->
            <x-trow>{{ $patient->ipp }}</x-trow>
            <!-- <x-trow>{{ $patient->sex }}</x-trow> -->
            <x-trow>{{ $patient->nb_vaccine_doses }}</x-trow>
            <x-trow>{{ $patient->vaccine_name }}</x-trow>
            <x-trow>{{ $patient->date_first_dose }}</x-trow>
            <x-trow>{{ $patient->date_second_dose }}</x-trow>
            <x-trow>{{ $patient->date_last_dose }}</x-trow>
            <x-trow>{{ $patient->vaccine_failure }}</x-trow>
            <x-trow>{{ $patient->vaccinated }}</x-trow>
            <x-trow>{{ $patient->vaccination }}</x-trow>
            <x-trow>{{ $patient->complete_scheme }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'patients']) }}">Retour aux patients</a>
    </x-slot>
</x-table>

<x-title type="3">Dossier(s) associé(s)</x-title>

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
        @foreach($patient->medicalFiles as $medical_file)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $medical_file->id_medical_file }}" />
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $medical_file->id_medical_file, 'tab' => 'medical-file']) }}">
                        {{ $medical_file->id_medical_file }}
                    </a>
                </x-trow>
                <x-trow>{{ $medical_file->id_patient }}</x-trow>
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
        <a href="{{ route('results', ['tab' => 'medical-files']) }}">Retour aux dossiers</a>
    </x-slot>
</x-table>