<x-title type="2">Table Laboratoires préleveurs</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <!-- <x-form.field>
        <x-form.label name="samplerLabID">Identifiant :</x-form.label>
        <x-form.input name="samplerLabID" value="{{ request('samplerLabID') }}" placeholder="Identifiant" />
    </x-form.field> -->

    <x-form.field>
        <x-form.label name="nameSampler">Nom du laboratoire préleveur :</x-form.label>
        <x-form.input name="nameSampler" value="{{ request('nameSampler') }}" placeholder="Nom préleveur" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="finessSampler">Finess du laboratoire préleveur :</x-form.label>
        <x-form.input name="finessSampler" value="{{ request('finessSampler') }}" placeholder="Numéro de finess" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ufSampler">UF du laboratoire préleveur :</x-form.label>
        <x-form.input name="ufSampler" value="{{ request('ufSampler') }}" placeholder="Numéro UF" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="typeSampler">Type du laboratoire préleveur :</x-form.label>
        <x-form.input name="typeSampler" value="{{ request('typeSampler') }}" placeholder="Type préleveur" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="postalCodeSampler">Code postal du laboratoire préleveur :</x-form.label>
        <x-form.input name="postalCodeSampler" value="{{ request('postalCodeSampler') }}" placeholder="Code postal préleveur" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/labos'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="samplerLabTable">
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
        <x-thead>Nom du laboratoire préleveur</x-thead>
        <x-thead>Finess</x-thead>
        <x-thead>UF</x-thead>
        <x-thead>Type</x-thead>
        <x-thead>Code postal</x-thead>
    </x-slot>
    <x-slot:tbody>
        @foreach($sampler_laboratories as $sampler_lab)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $sampler_lab->id_sampler_lab }}"/>
                </x-trow> -->
                <!-- <x-trow>
                    <a href="{{ route('results.show', ['id' => $sampler_lab->id_sampler_lab, 'tab' => 'sampler-labs']) }}">
                        {{ $sampler_lab->id_sampler_lab }}
                    </a>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $sampler_lab->id_sampler_lab, 'tab' => 'sampler-lab']) }}">
                        {{ $sampler_lab->name_sampler }}
                    </a>
                </x-trow>
                <x-trow>{{ $sampler_lab->finess_sampler }}</x-trow>
                <x-trow>{{ $sampler_lab->UF_sampler }}</x-trow>
                <x-trow>{{ $sampler_lab->type_sampler }}</x-trow>
                <x-trow>{{ $sampler_lab->postal_code_sampler }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $sampler_laboratories->links() }}
    </x-slot>
</x-table>