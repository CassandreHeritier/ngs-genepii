<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmergenController extends Controller
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
        return redirect()->route('emergen')->with('success', 'Fichier supprimé !');
    }

    /**
     * Download resource from storage
     *
     * @param Request $request
     * @return Response
     * @author Cassandre Héritier--Tellier
     */
    public function downloadFile(Request $request)
    {
        if ($request->submit == 'export') {
            if(!empty($_POST['checkbox'])) {
                foreach($_POST['checkbox'] as $value){
                    echo "value : ".$value.'<br/>';
                }
            }
        }
        return Storage::download('public/files/S13_renseignements.xlsx');
    }

    /**
     * Download resource from storage
     *
     * @return Response
     * @author Cassandre Héritier--Tellier
     */
    public function downloadEmergen()
    {
        return Storage::download('public/outputs/emergen.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     * @author Cassandre Héritier--Tellier
     */
    public function index()
    {
        return view('emergen.index', [
            'files' => File::paginate(20)
        ]);
    }

    /**
     * Get EMERGEN format from the database, with a given list of samples.
     * @param int $id
     * @author Cassandre Héritier--Tellier
     */
    public function launchByList(int $id)
    {
        /* List of samples */
        $file = File::findOrFail($id);
        $path = Storage::disk('public')->path('files/' . $file->name);

        $script = dirname(getcwd()) . '/src/package_genepii/main.py';
        $command = ['python3', $script, 'emergen'];

        /* Push command with arguments */
        if (isset($path)){
            array_push($command, '--samples');
            array_push($command, $path);
        }
        
        $process = new Process($command);
        // dd($process->getCommandLine());
        
        $process->run();
        // Error handling
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output_data = $process->getOutput();
        return redirect()->route('emergen')
            ->with('success', 'Le format EMERGEN a bien été récupéré ! Cliquer sur TELECHARGER pour récupérer le fichier.');
    }

    /**
     * Get EMERGEN format from the database with given validation dates.
     * @param Request $request
     * @author Cassandre Héritier--Tellier
     */
    public function launchByDates(Request $request)
    {
        /* Validation dates */
        $validationDate1 = $request->session()->get('validationDate1');
        $validationDate2 = $request->session()->get('validationDate2');

        $script = dirname(getcwd()) . '/src/package_genepii/main.py';
        $command = ['python3', $script, 'emergen'];

        /* Push command with arguments */
        if (isset($validationDate1)){
            array_push($command, '--start_date');
            array_push($command, $validationDate1);
        }
        if (isset($validationDate2)){
            array_push($command, '--end_date');
            array_push($command, $validationDate2);
        }
        
        $process = new Process($command);
        //dd($process->getCommandLine());
        
        $process->run();
        // Error handling
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output_data = $process->getOutput();
        return redirect()->route('emergen')
            ->with('success', 'Le format EMERGEN a bien été récupéré !');
    }

    /**
     * Setup parameters for Python script
     *
     * @param Request $request
     * @return \Illuminate\View\View
     * @author Cassandre Héritier--Tellier
     */
    public function setup(Request $request) {
        $validationDate1 = $request->input('validationDate1');
        $validationDate2 = $request->input('validationDate2');
        $request->session()->put('validationDate1', $validationDate1);
        $request->session()->put('validationDate2', $validationDate2);
        return redirect()->route('emergen')
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

        return redirect()->route('emergen')->with('success', 'Fichier ajouté !');
    }
}
