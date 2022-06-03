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

class ExportController extends Controller
{
    /**
     * Download resource from storage
     *
     * @param Request $request
     * @return Response
     * @author Cassandre Héritier--Tellier
     */
    public function download(Request $request)
    {
        return Storage::download('public/outputs/exported_data.xlsx');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     * @author Cassandre Héritier--Tellier
     */
    public function index()
    {
        return view('export.index', [
            'files' => File::paginate(20)
        ]);
    }

    /**
     * Insert data from the resource into the database.
     *
     * @param Request $request
     * @author Cassandre Héritier--Tellier
     */
    public function launch(Request $request)
    {       
        /* Arguments for Python script */
        $ids = $request->session()->get('ids');
        $table = $request->session()->get('table');
        $ids=str_replace("\r", "", $ids); // remove \r
        $ids=str_replace("\n", " ", $ids); // replace \n by spaces
        $array_ids = explode(" ", $ids);
        // dd($array_ids);

        $script = dirname(getcwd()) . '/src/package_genepii/main.py';
        $command = ['python3', $script, 'export'];

        /* Push command with arguments */       
        if (isset($table)){
            array_push($command, '--table');
            array_push($command, $table);
        } else {
            // default table
            array_push($command, '--table');
            array_push($command, 'patients');
        }

        if (isset($ids) && !empty($ids)){
            array_push($command, '--ids');
            foreach ($array_ids as $id) {
                array_push($command, $id);
            }
        }

        $process = new Process($command);
        $process->setTimeout(1000);
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
        return redirect()->route('export')
                ->with('success', 'Les données ont bien été exportées !')
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
        /* Get arguments session */
        $table = $request->input('table');
        $ids = $request->input('ids');

        /* Put arguments session */
        $request->session()->put('table', $table);
        $request->session()->put('ids', $ids);

        return redirect()->route('export')
            ->with('success', 'Paramètres sauvegardés !');
    }
}