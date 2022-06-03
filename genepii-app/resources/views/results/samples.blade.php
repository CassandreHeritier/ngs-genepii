<x-title type="2">Table Prélèvements</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="sampleId">Numéro de prélèvement :</x-form.label>
        <x-form.input name="sampleId" value="{{ request('sampleId') }}" placeholder="Numéro à 12 chiffres" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="fileId">Numéro de dossier :</x-form.label>
        <x-form.input name="fileId" value="{{ request('fileId') }}" placeholder="Numéro à 10 chiffres" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="labExp">Laboratoire expéditeur :</x-form.label>
        <x-form.input name="labExp" value="{{ request('labExp') }}" placeholder="Nom du laboratoire" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="samplingType">Type de prélèvement :</x-form.label>
        <x-form.input name="samplingType" value="{{ request('samplingType') }}" placeholder="Type de prélèvement" />
    </x-form.field>

    <x-form.field class="mt-4">
        <x-form.label name="samplingDate1">Date de prélèvement (début) :</x-form.label>
        <x-form.input name="samplingDate1" value="{{ request('samplingDate1') }}" type="date" />
        <x-form.label name="samplingDate2">Date de prélèvement (fin) :</x-form.label>
       <x-form.input name="samplingDate2" value="{{ request('samplingDate2') }}" type="date" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="registrationDate1">Date de réception (début) :</x-form.label>
        <x-form.input name="registrationDate1" value="{{ request('registrationDate1') }}" type="date" />
        <x-form.label name="registrationDate2">Date de réception (fin) :</x-form.label>
       <x-form.input name="registrationDate2" value="{{ request('registrationDate2') }}" type="date" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="validationDate1">Date de validation (début) :</x-form.label>
        <x-form.input name="validationDate1" value="{{ request('validationDate1') }}" type="date" />
        <x-form.label name="validationDate2">Date de validation (fin) :</x-form.label>
       <x-form.input name="validationDate2" value="{{ request('validationDate2') }}" type="date" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samples'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="samplesTable">
    <x-slot:thead>
        <!-- <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
            <form method="post" action="{{ route('results.download') }}">
                @csrf
                <button id="export" onclick="exportData()" disabled="true" type="submit" name="submit" value="export">
                    <i class="fa-solid fa-download"></i>
                </button>
            </form>
        </x-thead> -->
        <x-thead>Numéro de prélèvement</x-thead>
        <x-thead>Numéro de dossier d'analyse</x-thead>
        <x-thead>Envoyé par le laboratoire</x-thead>
        <x-thead>Type de prélèvement</x-thead>
        <x-thead>Date du prélèvement</x-thead>
        <x-thead>Date d'enregistrement</x-thead>
        <x-thead>Date de validation</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($samples as $sample)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $sample->id_sample }}" />
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $sample->id_sample, 'tab' => 'sample']) }}">
                        {{ $sample->id_sample }}
                    </a>
                </x-trow>
                @if ($sample->medicalFile)
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $sample->medicalFile->id_medical_file, 'tab' => 'medical-file']) }}">
                        {{ $sample->id_medical_file }}
                    </a>
                </x-trow>
                @else
                <x-trow>
                </x-trow>
                @endif
                <x-trow>
                    @isset($sample->senderLab)
                    <a href="{{ route('results.show', ['id' => $sample->senderLab->id_sender_lab, 'tab' => 'sender-lab']) }}">
                        {{ $sample->senderLab->name_sender }}
                    </a>
                    @endisset
                </x-trow>
                <x-trow>{{ $sample->sampling_type }}</x-trow>
                <x-trow>{{ $sample->sampling_date }}</x-trow>
                <x-trow>{{ $sample->registration_date }}</x-trow>
                <x-trow>{{ $sample->validation_date }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $samples->links() }}
    </x-slot>
</x-table>