<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @author Cassandre Héritier--Tellier
     */
    public function destroy(int $id)
    {
        $file = File::findOrFail($id);
        Storage::disk('public')->delete('files/' . $file->name);
        $file->delete();
        return redirect()->route('import-files')->with('success', 'Fichier supprimé !');
    }

    /**
     * Download resource from storage
     *
     * @param $filename
     * @param Request $request
     * @return Response
     * @author Cassandre Héritier--Tellier
     */
    public function download($filename, Request $request)
    {
        return Storage::download('public/outputs/' . $filename . '.xlsx');
    }

    /**
     * edit name of a given file.
     *
     * @param int $id
     * @return \Illuminate\View\View
     * @author Cassandre Héritier--Tellier
     */
    public function edit($id)
    {
        $file = File::findOrFail($id);
        if ($file) {
            $file->name = 'hello'; // get value submitted
            $file->save();
        }
        return redirect()->route('import-files')->with('success', 'Fichier renommé !');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     * @author Cassandre Héritier--Tellier
     */
    public function index()
    {
        return view('import.index', [
            'files' => File::paginate(20)
        ]);
    }

    /**
     * Insert data from the resource into the database.
     *
     * @param int $id
     * @param Request $request
     * @author Cassandre Héritier--Tellier
     */
    public function launch(int $id, Request $request)
    {       
        /* Arguments for Python script */
        $header = $request->session()->get('header') ? : 1;
        $insert = $request->session()->get('insert');
        $file = File::findOrFail($id);
        $path = Storage::disk('public')->path('files/' . $file->name);
        $script = dirname(getcwd()) . '/src/package_genepii/main.py';
        $command = ['python3', $script, 'file', '-i', $path, '-d', $header, '--get_inserted', '--get_updated'];
        if ($insert) {
            $file->imported = true;
            $file->save();
            $message =  'Les données ont bien été insérées dans la base !';
            array_push($command, '--db');
        } else {
            $message =  'Le script a fonctionné sans erreurs !';
        };

        $process = new Process($command);
        $process->setTimeout(1000);
        // $process->setIdleTimeout(1000);

        //dd($process->getCommandLine());

        $process->run();

        /* Error handling */
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output_data = $process->getOutput();
        /* Reset session */
        $request->session()->flush();

        /* Redirect */
        return redirect()->route('import-files')
                ->with('success', $message)
                ->withErrors('error', 'Des erreurs sont apparues.');
    }

     /**
     * Setup parameters for Python script
     *
     * @param Request $request
     * @return \Illuminate\View\View
     * @author Cassandre Héritier--Tellier
     */
    public function setup(Request $request) {
        $header = $request->input('header');
        if ($request->input('insert') == 'oui'){
            $insert = true;
        } else {
            $insert = false;
        };
        $request->session()->put('header', $header);
        $request->session()->put('insert', $insert);
        return redirect()->route('import-files')
            ->with('success', 'Paramètres sauvegardés !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @author Cassandre Héritier--Tellier
     */
    public function store(StoreFileRequest $request)
    {
        // Handle file Upload
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $extension = $request->file->extension();
            $type = $request->file->getClientMimeType();
            $size = $request->file->getSize();
            $path = Storage::disk('public')->putFileAs('files', $request->file, $filename);

            // Store file into the database
            File::create([
                'name' => $filename,
                'extension' => $extension,
                'type' => $type,
                'size' => $size
            ]);
        }

        return redirect()->route('import-files')->with('success', 'Fichier ajouté !');
    }
}
