<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UploadsController;
use App\Models\Uploads;

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
Route::get('/etudiant/{user_id}', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::get('/etudiant-create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiant-create', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.delete');

//articles routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/article-create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/article-create', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/article-edit/{article}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/article-edit/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('articles.delete');

//authentication routes
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
Route::get('/registration', [CustomAuthController::class, 'create'])->name('user.registration');
Route::post('/registration-store', [CustomAuthController::class, 'store'])->name('user.store');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('/user-edit/{user}', [CustomAuthController::class, 'edit'])->name('user.edit');
Route::put('/user-edit/{user}', [CustomAuthController::class, 'update'])->name('user.update');
Route::delete('/user-delete/{user}', [CustomAuthController::class, 'destroy'])->name('user.delete');

//uploads routes
Route::get('/uploads', [UploadsController::class, 'index'])->name('uploads.index');
Route::get('/upload-file', [UploadsController::class, 'create'])->name('upload.create');
Route::post('/upload-file', [UploadsController::class, 'store'])->name('upload.store');
Route::get('/download/{filename}', [UploadsController::class,'download'])->name('uploads.download');
Route::get('/upload-edit/{upload}', [UploadsController::class, 'edit'])->name('upload.edit');
Route::put('/upload-edit/{upload}', [UploadsController::class, 'update'])->name('upload.update');
Route::delete('/upload-delete/{uploads}', [UploadsController::class, 'destroy'])->name('upload.delete');


//dashboard
Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');


//example test -- to be deleted
Route::get('/query', [EtudiantController::class, 'query']);