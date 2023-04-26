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
    Route::get('/print', [BlockController::class, 'blocksPrint'])->name('blocks.print');
    // User
    Route::get('/user', [BlockController::class, 'user'])->name('user');
    Route::delete('/user/delete{id}', [BlockController::class, 'deleteUser'])->name('user.delete');
    Route::get('/createUser', [BlockController::class, 'createUser'])->name('user.create');
    Route::post('/createUser', [BlockController::class, 'userPost'])->name('user.post');
    Route::get('/editUser{id}', [BlockController::class, 'editUser'])->name('user.edit');
    Route::patch('/updateUser/{id}', [BlockController::class, 'updateUser'])->name('user.update');

    //Project
    Route::get('/createProject', [BlockController::class, 'createProject'])->name('project.create');
    Route::post('/createProject', [BlockController::class, 'projectPost'])->name('project.post');
    Route::get('/editProject{id}', [BlockController::class, 'editProject'])->name('project.edit');
    Route::patch('/updateProject/{id}', [BlockController::class, 'updateProject'])->name('project.update');
    Route::delete('/deleteProject/{id}', [BlockController::class, 'deleteProject'])->name('project.delete');

    Route::get('/page{id}', [BlockController::class, 'page'])->name('page');
    Route::get('/editPage{id}', [BlockController::class, 'editPage'])->name('page.edit');
    Route::patch('/editPage{id}', [BlockController::class, 'updatePage'])->name('page.update');
    Route::get('/createPage{id}', [BlockController::class, 'createPage'])->name('page.create');
    Route::post('/createPage{id}', [BlockController::class, 'postPage'])->name('page_create.post');
    Route::delete('/deletePage/{id}', [BlockController::class, 'deletePage'])->name('page.delete');
    Route::get('/logout', [BlockController::class, 'logout'])->name('logout');

    Route::get('/createBlock{id}', [BlockController::class, 'blockCreate'])->name('block.create');
    Route::get('/block{id}', [BlockController::class, 'block'])->name('block');
    Route::post('/createBlock/{id}', [BlockController::class, 'postBlock'])->name('block.post');
    Route::delete('/deleteBlock/{id}', [BlockController::class, 'deleteBlock'])->name('block.delete');
});

route::middleware('isGuest')->group(function () {
    Route::get('/', [BlockController::class, 'index'])->name('index');
    Route::post('/', [BlockController::class, 'auth'])->name('login.auth');
});
