@extends('layouts.app')

@section('content')

@include('components.flashMessage')
<x-panel>
    <x-title>Exporter des données depuis la base</x-title>
    <x-info>
        Il est possible d'exporter des données sous forme de tableur Excel depuis les tables SQL, avec ou sans options.
        <ul>
            <li>Sans options : c'est la table Patients qui sera exportée par défaut, cliquer sur LANCER directement pour obtenir toutes les données de Patients.</li>
            <li>En choisissant une table : choisir dans le menu déroulant la table SQL à exporter.</li>
            <li>En donnant une liste d'identifiants : les données correspondantes aux identifiants fournis seront exportées depuis la table renseignée juste avant. La table par défaut est aussi Patients. <b>Ecrire les identifiants (clés primaires des tables SQL) séparés par des espaces ou des retours chariots.</b></li>
        </ul>
        Bien penser à sauvegarder les paramètres avant de lancer l'export des données, puis cliquer sur TELECHARGER pour obtenir le fichier Excel.
    </x-info>

    <x-title type="3">Paramètres</x-title>
    <div>
        <form action="{{ route('export.setup') }}" method="POST">
            @csrf
            <div class="form-group">

            <label for="table" class="col-3 col-form-label">
                <b>Table SQL :</b>
                <select id="table" name="table" class="form-select">
                    <option {{ Session::get('table') == 'patients' ? 'selected' : ''  }} value="patients">Patients</option>
                    <option {{ Session::get('table') == 'medical_files' ? 'selected' : ''  }} value="medical_files">Dossiers GLIMS</option>
                    <option {{ Session::get('table') == 'samples' ? 'selected' : ''  }} value="samples">Prélèvements</option>
                    <option {{ Session::get('table') == 'sender_laboratories' ? 'selected' : ''  }} value="sender_laboratories">Laboratoires expéditeurs</option>
                    <option {{ Session::get('table') == 'sampler_laboratories' ? 'selected' : ''  }} value="sampler_laboratories">Laboratoires préleveurs</option>
                    <option {{ Session::get('table') == 'summary_results' ? 'selected' : ''  }} value="summary_results">Résultats summary</option>
                    <option {{ Session::get('table') == 'validation_results' ? 'selected' : ''  }} value="validation_results">Résultats validation</option>
                    <option {{ Session::get('table') == 'pangolin_results' ? 'selected' : ''  }} value="pangolin_results">Résultats pangolin</option>
                    <option {{ Session::get('table') == 'nextclade_results' ? 'selected' : ''  }} value="nextclade_results">Résultats nextclade</option>
                </select>
            </label>

            <div class="form-group">
                <label for="ids">
                    <b>Liste d'identifiants :</b>
                    <textarea id="ids" name="ids" class="form-control" rows="3">{{ Session::get('ids') ? : '' }}</textarea>
                </label>
            </div>

            <x-form.button id="saveParams">Sauvegarder les paramètres</x-form.button>
        </form>
    </div>

    <div id="cover-spin"></div>

    <x-form.layout class="my-2" action="{{ route('export.launch') }}">
        @csrf
        <x-form.button class="add-spinner">Lancer</x-form.button>
    </x-form.layout>

    <x-form.layout class="my-2" action="{{ route('export.download') }}" method="post">
        @csrf
        <x-form.button class="add-spinner">Télécharger</x-form.button>
    </x-form.layout>
</x-panel>

@endsection