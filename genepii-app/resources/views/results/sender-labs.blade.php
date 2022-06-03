<x-title type="2">Table Laboratoires expéditeurs</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <!-- <x-form.field>
        <x-form.label name="senderLabID">Identifiant :</x-form.label>
        <x-form.input name="senderLabID" value="{{ request('senderLabID') }}" placeholder="Identifiant" />
    </x-form.field> -->

    <x-form.field>
        <x-form.label name="nameSender">Nom du laboratoire expéditeur :</x-form.label>
        <x-form.input name="nameSender" value="{{ request('nameSender') }}" placeholder="Nom expéditeur" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="townSender">Ville :</x-form.label>
        <x-form.input name="townSender" value="{{ request('townSender') }}" placeholder="Ville expéditeur" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="departmentSender">Département :</x-form.label>
        <x-form.input name="departmentSender" value="{{ request('departmentSender') }}" placeholder="Département à 2 chiffres" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="mnemoidSender">Mnémo ID :</x-form.label>
        <x-form.input name="mnemoidSender" value="{{ request('mnemoidSender') }}" placeholder="Mnémo ID" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/labos'">Réinitialiser</x-form.button>
</x-form.layout>

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
        <!-- <x-thead>Identifiant</x-thead> -->
        <x-thead>Nom du laboratoire expéditeur</x-thead>
        <x-thead>Ville</x-thead>
        <x-thead>Département</x-thead>
        <x-thead>Mnémo ID</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($sender_laboratories as $sender_lab)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $sender_lab->id_sender_lab }}"/>
                </x-trow> -->
                <!-- <x-trow>
                    <a href="{{ route('results.show', ['id' => $sender_lab->id_sender_lab, 'tab' => 'sender-lab']) }}">
                        {{ $sender_lab->id_sender_lab }}
                    </a>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $sender_lab->id_sender_lab, 'tab' => 'sender-lab']) }}">
                        {{ $sender_lab->name_sender }}
                    </a>
                </x-trow>
                <x-trow>{{ $sender_lab->town_sender }}</x-trow>
                <x-trow>{{ $sender_lab->department_sender }}</x-trow>
                <x-trow>{{ $sender_lab->mnemoid_sender }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $sender_laboratories->links() }}
    </x-slot>
</x-table>