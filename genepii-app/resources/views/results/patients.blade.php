<x-title type="2">Table Patients</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="patientId">Numéro de patient :</x-form.label>
        <x-form.input name="patientId" value="{{ request('patientId') }}" placeholder="Numéro" />
    </x-form.field>

<!--     <x-form.field>
        <x-form.label name="birthDate1">Date de naissance (début) :</x-form.label>
        <x-form.input name="birthDate1" value="{{ request('birthDate1') }}" type="date" />
        <x-form.label name="birthDate2">Date de naissance (fin) :</x-form.label>
       <x-form.input name="birthDate2" value="{{ request('birthDate2') }}" type="date" />
    </x-form.field> -->

<!--     <x-form.field>
        <x-form.label name="age">Âge :</x-form.label>
        <x-form.input name="age" value="{{ request('age') }}" placeholder="Âge" />
    </x-form.field> -->

    <x-form.field>
        <x-form.label name="ipp">IPP :</x-form.label>
        <x-form.input name="ipp" value="{{ request('ipp') }}" placeholder="Numéro" />
    </x-form.field>

<!--     <x-form.field>
        <x-form.label name="sex">Sexe :</x-form.label>
        <select id="sex" name="sex" class="form-select mb-1">
            <option value="" @if (request('sex') == '') selected @endif>Sélectionner</option>
            <option value="male" @if (request('sex') == 'male') selected @endif>Homme</option>
            <option value="female" @if (request('sex') == 'female') selected @endif>Femme</option>
        </select>
    </x-form.field> -->

    <x-form.field>
        <x-form.label name="nbDoses">Nombre de doses vaccin :</x-form.label>
        <x-form.input name="nbDoses" value="{{ request('nbDoses') }}" placeholder="Nombre de doses" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="firstDose1">Date de première dose (début) :</x-form.label>
        <x-form.input name="firstDose1" value="{{ request('firstDose1') }}" type="date" />
        <x-form.label name="firstDose2">Date de première dose (fin) :</x-form.label>
       <x-form.input name="firstDose2" value="{{ request('firstDose2') }}" type="date" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="secondDose1">Date de seconde dose (début) :</x-form.label>
        <x-form.input name="secondDose1" value="{{ request('secondDose1') }}" type="date" />
        <x-form.label name="secondDose2">Date de seconde dose (fin) :</x-form.label>
       <x-form.input name="secondDose2" value="{{ request('secondDose2') }}" type="date" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="lastDose1">Date de dernière dose (début) :</x-form.label>
        <x-form.input name="lastDose1" value="{{ request('lastDose1') }}" type="date" />
        <x-form.label name="lastDose2">Date de dernière dose (fin) :</x-form.label>
       <x-form.input name="lastDose2" value="{{ request('lastDose2') }}" type="date" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="vaccineFailure">Echec à la vaccination :</x-form.label>
        <x-form.select name="vaccineFailure" value="{{ request('vaccineFailure') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="vaccinated">Vacciné :</x-form.label>
        <x-form.select name="vaccinated" value="{{ request('vaccinated') }}" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="vaccination">Vaccination anti-SARS-CoV-2 :</x-form.label>
        <x-form.input name="vaccination" value="{{ request('vaccination') }}" placeholder="Vaccination" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="completeScheme">Schéma vaccinal complet :</x-form.label>
        <x-form.select name="completeScheme" value="{{ request('completeScheme') }}" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/patients'">Réinitialiser</x-form.button>
</x-form.layout>

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
        @foreach($patients as $patient)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $patient->id_patient }}"/>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $patient->id_patient, 'tab' => 'patient']) }}">
                        {{ $patient->id_patient }}
                    </a>
                </x-trow>
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
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $patients->links() }}
    </x-slot>
</x-table>