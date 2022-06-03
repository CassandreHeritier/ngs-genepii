<x-title type="2">Prélèvement {{ $sample->id_sample }}</x-title>

<x-table class="samplesTable">
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
        <x-thead>Numéro de prélèvement</x-thead>
        <x-thead>Numéro de dossier d'analyse</x-thead>
        <x-thead>Envoyé par le laboratoire</x-thead>
        <x-thead>Type de prélèvement</x-thead>
        <x-thead>Date du prélèvement</x-thead>
        <x-thead>Date d'enregistrement</x-thead>
        <x-thead>Date de validation</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $sample->id_sample }}" />
            </x-trow> -->
            <x-trow>{{ $sample->id_sample }}</x-trow>
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
                @isset($sample->laboratory)
                <a href="{{ route('results.show', ['id' => $sample->senderLab->id_sender_lab, 'tab' => 'sender-lab']) }}">
                    {{ $sample->laboratory->name_sender }}
                </a>
                @endisset
            </x-trow>
            <x-trow>{{ $sample->sampling_type }}</x-trow>
            <x-trow>{{ $sample->sampling_date }}</x-trow>
            <x-trow>{{ $sample->registration_date }}</x-trow>
            <x-trow>{{ $sample->validation_date }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'samples']) }}">Retour aux prélèvements</a>
    </x-slot>
</x-table>