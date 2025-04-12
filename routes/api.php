<?php

use App\Http\Controllers\UserController;
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

Route::prefix('/users')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
    Route::post('/create', [UserController::class, 'store'])->name('users.create');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/', [UserController::class, 'destroy'])->name('users.delete');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
