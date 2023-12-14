<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::get('/etudiant-create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiant-create', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.edit');
Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.delete');
Route::get('/query', [EtudiantController::class, 'query']);