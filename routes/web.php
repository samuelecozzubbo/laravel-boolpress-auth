<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
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

Route::get('/', [PageController::class, 'index'])->name('home');

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
//MEGLIO SCRIVERE I RESOURCES PER ULTIMI
//raggruppo tutte le rotte admin sotto middleware
//tutte hanno il prefisso admin, il nome iniziera con admin. e le raggruppo dentro la funzione di callback
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        //group accetta una funzione di callback dove metto le rotte CRUD
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        // Modifico dentro routeserverprovider la rotta di default da dashboard ad home
        //rotta trash
        Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
        Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');

        //Aggiungo le rotte CRUD
        Route::resource('posts', PostController::class);
        Route::get('/categories-posts', [CategoryController::class, 'categoryPosts'])->name('categoryPosts');
        Route::resource('categories', CategoryController::class)->except([
            'show',
            'edit',
            'create'
        ]);
        Route::get('/posts-per-category/{category}', [CategoryController::class, 'postPerCategory'])->name('postPerCategory');
    });
require __DIR__ . '/auth.php';
