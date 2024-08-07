<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});




Route::middleware('auth','checkuserstatus')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/formulaire', [UserController::class, 'indexForm'])->name('formulaire');
    Route::post('/formulaire', [UserController::class, 'store'])->name('sauvegarder_donnees');
    Route::get('/historique', [UserController::class, 'indexHistorique'])->name('historique');
    Route::delete('/delete-image/{id}', [UserController::class, 'deleteImage'])->name('delete_image');
    // creation et modification compagnes utilisateur
    Route::get('/formulaire/edit/{id}', [UserController::class, 'editCompagne'])->name('edit_form');
    Route::put('/formulaire/update/{id}', [UserController::class, 'updateCompagne'])->name('update_form');
    Route::delete('/delete_image/{id}', [UserController::class, 'deleteimage'])->name('delete-image');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/utilisateur/create', [AdminController::class, 'create'])->name('utilisateur.create');
    Route::post('/utilisateur/store', [AdminController::class, 'storeAdmin'])->name('utilisateur.store');

    Route::get('/admin/users/{user}/create-campaign', [AdminController::class, 'createCampaign'])->name('admin.users.createCampaign');
    Route::post('/admin/users/{user}/create-campaign', [AdminController::class, 'storeCampaign'])->name('admin.users.storeCampaign');


    // creation et modification compagnes admin
    Route::get('/compagnes/edit/{id}', [AdminController::class, 'editCompagne'])->name('edit-compagne');
    Route::put('/compagnes/update/{id}', [AdminController::class, 'updateCompagne'])->name('update-compagne');


    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/delete_images/{id}', [AdminController::class, 'deleteimages'])->name('delete-images');

    
    Route::get('/indicateurs', [AdminController::class, 'index']);
    Route::post('/update-indicateur', [AdminController::class, 'updatee'])->name('admin.update-indicateur');
    Route::post('/add-indicateur', [AdminController::class, 'storee'])->name('admin.store-indicateur');
});
require __DIR__ . '/auth.php';
