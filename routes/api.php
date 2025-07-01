<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('clients', ClientController::class);

// Route::prefix('/clients')->group(function() {
//     Route::get('/', [ClientController::class, 'index'])->name('clients.index');
//     Route::post('/create', [ClientController::class, 'store'])->name('clients.create');
//     Route::get('/{id}', [ClientController::class, 'show'])->name('clients.show');
//     Route::put('/{id}', [ClientController::class, 'update'])->name('clients.update');
//     Route::delete('/{id}', [ClientController::class, 'destroy'])->name('clients.delete');
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });