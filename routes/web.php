<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PageController::class, 'index'])->name('index.');

//ho cancellato la route dashboard default perche voglio creare la rotta admin

Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {
        /* Avendo raggruppato per prefisso e per nome posso cancellare /profile nell'url e lascio solo /
        e poi nel name non metto più profile.edit ecc ma lascio solo edit.... */
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

//raggruppo tutte le rotte admin sotto middleware
//tutte hanno il prefisso admin, il nome iniziera con admin. e le raggruppo dentro la funzione di callback
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        //group accetta una funzione di callback dove metto le rotte CRUD
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        // Modifico dentro routeserverprovider la rotta di default da dashboard ad home

    });
require __DIR__ . '/auth.php';
