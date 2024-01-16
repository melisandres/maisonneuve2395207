<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CustomAuthController ;

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

//etudiants routes
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::get('/etudiant-create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiant-create', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.edit');
Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.delete');

//authentication routes
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
Route::get('/registration', [CustomAuthController::class, 'create'])->name('user.registration');
Route::post('/registration-store', [CustomAuthController::class, 'store'])->name('user.store');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

//dashboard
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');


//example test -- to be deleted
Route::get('/query', [EtudiantController::class, 'query']);