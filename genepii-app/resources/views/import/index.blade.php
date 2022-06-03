@extends('layouts.app')

@section('content')

@include('components.flashMessage')
<x-panel>
    <x-title>Importer des données dans la base</x-title>
    <x-info class="mb-2">
        Les données d'un fichier ajouté peuvent être importées dans la base : elles sont formatées avant d'être insérées.
        Il est possible de ne pas insérer les données dans la base afin de visualiser le formatage avant, pour les visualiser télécharger les deux fichiers à l'aide des boutons en bas de page.
        Le numéro de ligne des en-têtes correspond à la ligne qui contient les noms des colonnes du fichier.
        Supprimer un fichier de la liste n'implique pas la perte des données dans la base : le fichier sera juste enlevé de la liste ci-dessous.
        L'état du fichier indique si les données ont déjà été importées dans la base ou non en lançant le script.
        Insérer de préférence un fichier Excel plutôt qu'un fichier CSV ou TSV.
    </x-info>

    <x-title type="3">Ajouter un fichier</x-title>

    <div class="mb-2">
        <form action="{{ route('import-files.store') }}"
                method="post"
                enctype="multipart/form-data"
        >
            <label class="block">
                @csrf
                <input type="file" name="file" class="form-control" accept=".csv, .xlsx, .xls">
            </label>
            <button id="addFile" class="btn btn-secondary">Ajouter</button>
        </form>
    </div>

    <x-title type="3">Paramètres</x-title>
    <div>
        <form action="{{ route('import-files.setup') }}" method="POST">
            @csrf
            <label for="header" class="col-3 col-form-label">
                <b>Numéro de ligne des en-têtes :</b>
                <input id="header" name="header" value="{{ Session::get('header') ? : 1 }}" required="required" type="number" step="1" class="form-control" min="1">
            </label>

            <label for="insert" class="col-3 col-form-label">
                <b>Insérer les données dans la base :</b>
                <select id="insert" name="insert" class="form-select" aria-label="Default select example">
                    <option {{ Session::get('insert') ? '' : 'selected'  }} value="non">NON</option>
                    <option {{ Session::get('insert') ? 'selected' : ''  }} value="oui">OUI</option>
                </select>
            </label>

            <x-form.button id="saveParams" class="add-spinner">Sauvegarder les paramètres</x-form.button>
        </form>
    </div>

    <div id="cover-spin"></div>        

    <x-title type="3">Fichiers</x-title>

    <x-table id="importFilesTable">
        <x-slot:thead>
            <x-thead class="bs-checkbox">
                <x-checkbox name="checkAll" />
                <!-- <form method="post" action="{{ route('import-files.download', ['filename' => 'id']) }}"> -->
                    @csrf
                    <button id="export" disabled="true" type="submit" name="submit" value="export">
                        <i class="fa-solid fa-download"></i>
                    </button>
                <!-- </form> -->
            </x-thead>
            <x-thead>Nom du fichier</x-thead>
            <x-thead>Supprimer un fichier</x-thead>
            <x-thead>Lancer le script</x-thead>
            <x-thead>Statut</x-thead>
        </x-slot>
        <x-slot:tbody>
            @foreach($files as $file)
            @if ($file->extension != 'txt')
                <tr>
                    <x-trow class="bs-checkbox">
                        <x-checkbox id="{{ $file->id }}"/>
                    </x-trow>
                    <x-trow>{{ $file->name }}</x-trow>
                    <x-trow>
                        <form method="post" action="{{ route('import-files.destroy', ['id' => $file->id]) }}">
                            @csrf
                            @method('delete')
                            <button id="deleteFile" type="submit" class="btn btn-primary btn-sm btn-danger add-spinner" onclick="return confirm('Voulez-vous vraiment supprimer ce fichier ?')">Supprimer</button>
                        </form>
                    </x-trow>
                    <x-trow>
                        <form id="database" action="{{ route('import-files.launch', ['id' => $file->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm add-spinner" onclick="return confirm('Voulez-vous vraiment lancer le script ?')">LANCER</button>
                        </form>
                    </x-trow>
                    <x-trow>
                        @if ($file->imported)
                            <span class="badge bg-success">Importé</span>
                        @else
                            <span class="badge bg-secondary">Non importé</span>
                        @endif
                    </x-trow>
                </tr>
            @endif
            @endforeach
        </x-slot>
        <x-slot:links>
            {{ $files->links() }}
        </x-slot>
    </x-table>

    <x-title type="3">Outils déboggage</x-title>

    <form action="{{ route('import-files.download', ['filename' => 'formated_data']) }}" method="post">
        @csrf
        <button class="btn btn-primary">Données formatées</button>
    </form>

    <form class="my-2" action="{{ route('import-files.download', ['filename' => 'inserted_data']) }}" method="post">
        @csrf
        <button class="btn btn-primary">Données insérées</button>
    </form>

    <form action="{{ route('import-files.download', ['filename' => 'updated_data']) }}" method="post">
        @csrf
        <button class="btn btn-primary">Données updatées</button>
    </form>
</x-panel>

<script>
    /* // Load content onload if it exists in localStorage
    window.onload = function() {
        if (localStorage.getItem('filenameText')) {
            document.querySelector('.content').innerHTML = localStorage.getItem('content');
        }
    }

    let editBtn = document.querySelector('#edit_content');
    let content = document.querySelector('.content');

    editBtn.addEventListener('click', () => {
        // Toggle contentEditable on button click
        content.contentEditable = !content.isContentEditable;
        content.focus();
        //content.style.border = "solid rounded black";
        
        // If disabled, save text
        if (content.contentEditable === 'false') {
            localStorage.setItem('content', content.innerHTML);
        }
    });

    function editname(){
        var filename = document.getElementById('filename');
        filename.setAttribute("contenteditable", "true");
        filename.style.border = "solid rounded black";
        filename.focus(); // TODO focus on end of text
    } */
</script>

@endsection