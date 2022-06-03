<x-title type="2">Laboratoire expéditeur {{ $sender_lab->name_sender }}</x-title>

<x-table class="senderLabTable">
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
        <x-thead>Nom du laboratoire expéditeur</x-thead>
        <x-thead>Ville</x-thead>
        <x-thead>Département</x-thead>
        <x-thead>Mnémo ID</x-thead>
    </x-slot>
    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $sender_lab->id_sender_lab }}"/>
            </x-trow> -->
            <x-trow>{{ $sender_lab->name_sender }}</x-trow>
            <x-trow>{{ $sender_lab->town_sender }}</x-trow>
            <x-trow>{{ $sender_lab->department_sender }}</x-trow>
            <x-trow>{{ $sender_lab->mnemoid_sender }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'sender-labs']) }}">Retour aux laboratoires expéditeurs</a>
    </x-slot>
</x-table>