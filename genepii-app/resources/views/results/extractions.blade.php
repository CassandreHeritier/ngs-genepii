<x-title type="2">Table Extractions</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="plateId">Numéro de plaque :</x-form.label>
        <x-form.input name="plateId" value="{{ request('plateId') }}" placeholder="Numéro de plaque" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="sampleId">Numéro de prélèvement :</x-form.label>
        <x-form.input name="sampleId" value="{{ request('sampleId') }}" placeholder="Identifiant" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="trackbc">TRackBC :</x-form.label>
        <x-form.input name="trackbc" value="{{ request('trackbc') }}" placeholder="TRackBC" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="tlabwareid">TLabwareId :</x-form.label>
        <x-form.input name="tlabwareid" value="{{ request('tlabwareid') }}" placeholder="TLabwareId" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="tpositionid">TPositionId :</x-form.label>
        <x-form.input name="tpositionid" value="{{ request('tpositionid') }}" placeholder="TLabwareId" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="tpositionbc">TPositionBC :</x-form.label>
        <x-form.input name="tpositionbc" value="{{ request('tpositionbc') }}" placeholder="TPositionBC" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="tstatutSummary">TStatusSummary :</x-form.label>
        <x-form.input name="tstatutSummary" value="{{ request('tstatutSummary') }}" placeholder="TStatusSummary" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="tsumStateDescription">TSumStateDescription :</x-form.label>
        <x-form.input name="tsumStateDescription" value="{{ request('tsumStateDescription') }}" placeholder="TSumStateDescription" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="tvolume">TVolume :</x-form.label>
        <x-form.input name="tvolume" value="{{ request('tvolume') }}" placeholder="TVolume" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="srackbc">SRackBC :</x-form.label>
        <x-form.input name="srackbc" value="{{ request('srackbc') }}" placeholder="SRackBC" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="slabwareid">SLabwareId :</x-form.label>
        <x-form.input name="slabwareid" value="{{ request('slabwareid') }}" placeholder="SLabwareId" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="spositionid">SPositionId :</x-form.label>
        <x-form.input name="spositionid" value="{{ request('spositionid') }}" placeholder="SPositionId" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="spositionbc">SPositionBC :</x-form.label>
        <x-form.input name="spositionbc" value="{{ request('spositionbc') }}" placeholder="SPositionBC" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="actionDateTime">Date d'extraction :</x-form.label>
        <x-form.input name="actionDateTime" value="{{ request('actionDateTime') }}" placeholder="YYYY-MM-JJ" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="username">Nom d'automate :</x-form.label>
        <x-form.input name="username" value="{{ request('username') }}" placeholder="Nom" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samplesheets'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="extractionsTable">
    <x-slot:thead>
        <!-- <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
        </x-thead> -->
        <x-thead>Numéro d'extraction</x-thead>
        <x-thead>Numéro de plaque</x-thead>
        <x-thead>Numéro de prélèvement</x-thead>
        <x-thead>TRackBC</x-thead>
        <x-thead>TLabwareId</x-thead>
        <x-thead>TPositionId</x-thead>
        <x-thead>TPositionBC</x-thead>
        <x-thead>TStatusSummary</x-thead>
        <x-thead>TSumStateDescription</x-thead>
        <x-thead>TVolume</x-thead>
        <x-thead>SRackBC</x-thead>
        <x-thead>SLabwareId</x-thead>
        <x-thead>SPositionId</x-thead>
        <x-thead>SPositionBC</x-thead>
        <x-thead>Date d'extraction</x-thead>
        <x-thead>Automate</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($extractions as $extraction)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $extraction->id_extraction }}"/>
                </x-trow> -->
                <x-trow>
                    <!-- <a href="{{ route('results.show', ['id' => $extraction->id_extraction, 'tab' => 'extraction']) }}"> -->
                        {{ $extraction->id_extraction }}
                    <!-- </a> -->
                </x-trow>
                <x-trow>{{ $extraction->id_plate }}</x-trow>
                <x-trow>{{ $extraction->id_sample }}</x-trow>
                <x-trow>{{ $extraction->track_bc }}</x-trow>
                <x-trow>{{ $extraction->tlabware_id }}</x-trow>
                <x-trow>{{ $extraction->tposition_id }}</x-trow>
                <x-trow>{{ $extraction->tposition_bc }}</x-trow>
                <x-trow>{{ $extraction->tstatus_summary }}</x-trow>
                <x-trow>{{ $extraction->tsum_state_description }}</x-trow>
                <x-trow>{{ $extraction->tvolume }}</x-trow>
                <x-trow>{{ $extraction->srack_bc }}</x-trow>
                <x-trow>{{ $extraction->slabware_id }}</x-trow>
                <x-trow>{{ $extraction->sposition_id}}</x-trow>
                <x-trow>{{ $extraction->sposition_bc}}</x-trow>
                <x-trow>{{ $extraction->action_date_time}}</x-trow>
                <x-trow>{{ $extraction->user_name}}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $extractions->links() }}
    </x-slot>
</x-table>