@extends('layouts.app')

@section('content')

@include('components.flashMessage')
<x-panel>
    <x-title>Récupérer le format EMERGEN</x-title>
    <x-info>
        Il est possible de récupérer le format EMERGEN, avec ou sans options.
        <ul>
            <li>Sans options : cliquer sur LANCER directement, tous les échantillons validés entre le 1 Janvier 2021 et le 1 Janvier 2023 seront sortis.</li>
            <li>Avec une période de dates de validation : mettre une date de début et/ou de fin de validation pour récupérer les informations sur les échantillons validés dans cette période. <b>Les dates sont incluses</b>.</li>
            <li>Avec une liste de numéros d'échantillons : Ajouter un fichier texte (.txt) avec une liste de numéros d'échantillons séparés par des retours à la ligne (donc un numéro par ligne), et lancer le script
        en cliquant sur LANCER au fichier correspondant dans la liste des fichiers ci-dessous.</li>
        </ul>
    </x-info>

    <x-title type="3">Dates de validation</x-title>
    <x-form.layout action="{{ route('emergen.setup') }}" method="post">
        @csrf
        <x-form.field>
            <x-form.label name="validationDate1">Date de validation (début) :</x-form.label>
            <x-form.input name="validationDate1" type="date" value="{{ Session::get('validationDate1') }}" />
        </x-form.field>
        <x-form.field>
            <x-form.label name="validationDate2">Date de validation (fin) :</x-form.label>
            <x-form.input name="validationDate2" type="date" value="{{ Session::get('validationDate2') }}" />
        </x-form.field>
        <x-form.button id="saveParams" class="btn-secondary">Sauvegarder les paramètres</x-form.button>
    </x-form.layout>

    <div id="cover-spin"></div>      
        
    <div class="d-flex justify-content-center">
        <form action="{{ route('emergen.launch-dates') }}" class="mx-2">
            @csrf
            <x-form.button onclick="return confirm('Lancer la récupération du format EMERGEN ?')">LANCER</x-form.button>
        </form>

        <form action="{{ route('emergen.download-emergen') }}" method="post" class="mx-2">
            @csrf
            <x-form.button>TELECHARGER</x-form.button>
        </form>
    </div>

    <x-title type="3" class="mt-3">Liste d'échantillons</x-title>
    <div>
        <form action="{{ route('emergen.store') }}"
                method="post"
                enctype="multipart/form-data"
        >
            <label class="block">
                @csrf
                <input type="file" name="file" class="form-control" accept=".txt">
            </label>
            <button id="addFile" class="btn btn-secondary">Ajouter</button>
        </form>
    </div>

    <!-- <x-form.layout action="{{ route('emergen.store') }}" method="post" enctype="multipart/form-data">
        <x-form.label name="file">
            @csrf
            <x-form.input type="file" name="file" accept=".txt" />
            <x-form.button id="addFile" class="btn-secondary">Ajouter</x-form.button>
        </x-form.label>
    </x-form.layout> -->

    <x-table id="emergenFilesTable" class="mt-3">
        <x-slot:thead>
            <x-thead class="bs-checkbox">
                <x-checkbox name="checkAll" />
                <form method="post" action="{{ route('emergen.download-file') }}">
                    @csrf
                    <button id="export" disabled="true" type="submit" name="submit" value="export">
                        <i class="fa-solid fa-download"></i>
                    </button>
                </form>
            </x-thead>
            <x-thead>Nom du fichier</x-thead>
            <x-thead>Supprimer un fichier</x-thead>
            <x-thead>Lancer le script</x-thead>
        </x-slot>
        <x-slot:tbody>
            @foreach($files as $file)
            @if ($file->extension == 'txt')
                <tr>
                    <x-trow class="bs-checkbox">
                        <x-checkbox id="{{ $file->id }}"/>
                    </x-trow>
                    <x-trow>{{ $file->name }}</x-trow>
                    <x-trow>
                        <form method="post" action="{{ route('emergen.destroy', ['id' => $file->id]) }}">
                            @csrf
                            @method('delete')
                            <button id="deleteFile" type="submit" class="btn btn-primary btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce fichier ?')">Supprimer</button>
                        </form>
                    </x-trow>
                    <x-trow>
                        <form id="database" action="{{ route('emergen.launch-list', ['id' => $file->id]) }}">
                            @csrf
                            <button id="launchScript" type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Voulez-vous vraiment lancer le script ?')">LANCER</button>
                        </form>
                    </x-trow>
                </tr>
            @endif
            @endforeach
        </x-slot>
        <x-slot:links>
            {{ $files->links() }}
        </x-slot>
    </x-table>
</x-panel>

@endsection