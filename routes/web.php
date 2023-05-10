<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PageController;


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
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/error', [Controller::class, 'error'])->name('error');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Masterdata
    // Block (M)
    Route::prefix('block')->group(function () {
        Route::get('/', [BlockController::class, 'blockMaster'])->name('block.master');
        Route::get('/view', [BlockController::class, 'blockMasterView'])->name('blockmaster.view');
        Route::get('/create', [BlockController::class, 'blockMasterCreate'])->name('blockmaster.create');
        Route::post('/create/process', [BlockController::class, 'blockMasterPost'])->name('blockmaster.post');
        Route::get('/edit/{id}', [BlockController::class, 'blockMasterEdit'])->name('blockmaster.edit');
        Route::patch('/edit/{id}/process', [BlockController::class, 'blockMasterUpdate'])->name('blockmaster.update');
        Route::delete('/delete/{id}', [BlockController::class, 'blockMasterDelete'])->name('blockmaster.delete');

        Route::prefix('categories')->group(function () {
            Route::get('/', [BlockController::class, 'blockCategory'])->name('block.categories');
            Route::post('/create/process', [BlockController::class, 'postCategory'])->name('category.post');
            Route::delete('/delete/{id}', [BlockController::class, 'deleteCategory'])->name('category.delete');
            Route::patch('/delete/{id}/process', [BlockController::class, 'updateCategory'])->name('category.update');
        });
    });


    // User (M)
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'user'])->name('user');
        Route::middleware('cekRole:Admin')->group(function () {
            Route::get('/create', [UserController::class, 'createUser'])->name('user.create');
            Route::post('/create/process', [UserController::class, 'userPost'])->name('user.post');
            Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
            Route::patch('/edit/{id}/process', [UserController::class, 'updateUser'])->name('user.update');
            Route::get('/editpassword/{id}', [UserController::class, 'editPassword'])->name('password.edit');
            Route::patch('/editpassword/{id}/process', [UserController::class, 'updatePassword'])->name('password.update');
            Route::delete('/delete/{id}/process', [UserController::class, 'deleteUser'])->name('user.delete');
        });
    });
    

    //Project
    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectController::class, 'project'])->name('project');
        Route::get('/create', [ProjectController::class, 'createProject'])->name('project.create');
        Route::post('/create/process', [ProjectController::class, 'projectPost'])->name('project.post');
        Route::get('/edit/{id}', [ProjectController::class, 'editProject'])->name('project.edit');
        Route::patch('/edit/{id}/process', [ProjectController::class, 'updateProject'])->name('project.update');
        Route::delete('/delete/{id}/process', [ProjectController::class, 'deleteProject'])->name('project.delete');
        

        //page
        Route::prefix('page')->group(function () {
            Route::get('/{id}', [PageController::class, 'page'])->name('page');
            Route::get('/create/{id}', [PageController::class, 'createPage'])->name('page.create');
            Route::post('/create/{id}/process', [PageController::class, 'postPage'])->name('page_create.post');
            Route::get('/edit/{id}', [PageController::class, 'editPage'])->name('page.edit');
            Route::patch('/edit/{id}/process', [PageController::class, 'updatePage'])->name('page.update');
            Route::delete('/delete/{id}/process', [PageController::class, 'deletePage'])->name('page.delete');

        //block
            Route::prefix('block')->group(function () {
                Route::get('/{id}', [BlockController::class, 'block'])->name('block');
                Route::get('/create/{id}', [BlockController::class, 'blockCreate'])->name('block.create');
                Route::post('/create/{id}/processs', [BlockController::class, 'postBlock'])->name('block.post');
                Route::get('/edit/{id}', [BlockController::class, 'blockEdit'])->name('block.edit');
                Route::patch('/edit/{id}/processs', [BlockController::class, 'updateBlock'])->name('block.update');
                Route::delete('/delete/{id}/processs', [BlockController::class, 'deleteBlock'])->name('block.delete');
                Route::get('/blocksprint/{id}', [BlockController::class, 'print'])->name('blocks.print');
            });
        });
    });
});

Route::middleware('isGuest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/', [AuthController::class, 'auth'])->name('login.auth');
});
