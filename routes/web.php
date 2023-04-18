<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockController;


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

// Route::get('/', function () {
//     return view('index');
// });
Route::middleware('cekAuth')->group(function () {
    Route::get('/dashboard', [BlockController::class, 'dashboard'])->name('dashboard');
    Route::get('/page{id}', [BlockController::class, 'page'])->name('page');
    Route::get('/createPage{id}', [BlockController::class, 'createPage'])->name('page.create');
    Route::get('/logout', [BlockController::class, 'logout'])->name('logout');
});

route::middleware('isGuest')->group(function () {
    Route::get('/', [BlockController::class, 'index'])->name('index');
    Route::post('/', [BlockController::class, 'auth'])->name('login.auth');
});
