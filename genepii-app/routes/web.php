<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\MedicalFileController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EmergenController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Authentification */
Auth::routes();

/* Home */
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

/* Results */
Route::get('results/{tab?}', [ResultController::class, 'index'])->name('results');
Route::get('results/{tab?}/{id}', [ResultController::class, 'show'])->name('results.show');
Route::post('results/download', [ResultController::class, 'download'])->name('results.download');
Route::post('results/store', [ResultController::class, 'store'])->name('results.store');

/* Emergen */
Route::get('emergen', [EmergenController::class, 'index'])->name('emergen');
Route::delete('emergen/{id}', [EmergenController::class, 'destroy'])->name('emergen.destroy');
Route::post('emergen/download-file', [EmergenController::class, 'downloadFile'])->name('emergen.download-file');
Route::post('emergen/download-emergen', [EmergenController::class, 'downloadEmergen'])->name('emergen.download-emergen');
Route::get('emergen/launch/{id}', [EmergenController::class, 'launchByList'])->name('emergen.launch-list');
Route::get('emergen/launch', [EmergenController::class, 'launchByDates'])->name('emergen.launch-dates');
Route::post('emergen/setup', [EmergenController::class, 'setup'])->name('emergen.setup');
Route::post('emergen/upload', [EmergenController::class, 'store'])->name('emergen.store');

/* Import files */
Route::get('import-files', [ImportController::class, 'index'])->name('import-files');
Route::delete('import-files/{id}', [ImportController::class, 'destroy'])->name('import-files.destroy');
Route::post('import-files/download/{filename}', [ImportController::class, 'download'])->name('import-files.download');
Route::get('import-files/edit/{id}', [ImportController::class, 'edit'])->name('import-files.edit');
Route::get('import-files/launch/{id}', [ImportController::class, 'launch'])->name('import-files.launch');
Route::post('import-files/setup', [ImportController::class, 'setup'])->name('import-files.setup');
Route::post('import-files/upload', [ImportController::class, 'store'])->name('import-files.store');

/* Export data */
Route::get('export', [ExportController::class, 'index'])->name('export');
Route::post('export/download', [ExportController::class, 'download'])->name('export.download');
Route::get('export/launch', [ExportController::class, 'launch'])->name('export.launch');
Route::post('export/setup', [ExportController::class, 'setup'])->name('export.setup');
// Route::post('export/upload', [ExportController::class, 'store'])->name('export.store');