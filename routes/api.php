<?php

use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Tuttee le rotte dentro api.php sarannno precedute da '/api'
Route::get('/', [PageController::class, 'index']);
Route::get('/post-by-slug/{slug}', [PageController::class, 'postBySlug']);
Route::get('/categories', [PageController::class, 'categories']);
Route::get('/tags', [PageController::class, 'tags']);
Route::get('/post-by-category/{slug}', [PageController::class, 'postByCategory']);
Route::get('/post-by-tag/{slug}', [PageController::class, 'postByTag']);
Route::post('/send-email', [LeadController::class, 'store']);
