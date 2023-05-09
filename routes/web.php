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
        Route::prefix('blocks')->group(function () {
            Route::get('/', [BlockController::class, 'blockMaster'])->name('block.master');
            Route::get('/create', [BlockController::class, 'blockMasterCreate'])->name('blockmaster.create');
            Route::post('/create', [BlockController::class, 'blockMasterPost'])->name('blockmaster.post');
            Route::get('/edit/{id}', [BlockController::class, 'blockMasterEdit'])->name('blockmaster.edit');
            Route::patch('/update/{id}', [BlockController::class, 'blockMasterUpdate'])->name('blockmaster.update');
            Route::delete('/delete/{id}', [BlockController::class, 'blockMasterDelete'])->name('blockmaster.delete');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [BlockController::class, 'blockCategory'])->name('block.categories');
            Route::post('/create', [BlockController::class, 'postCategory'])->name('category.post');
            Route::delete('/delete/{id}', [BlockController::class, 'deleteCategory'])->name('category.delete');
            Route::patch('/update/{id}', [BlockController::class, 'updateCategory'])->name('category.update');
        });
    });


    // User (M)
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'user'])->name('user');
        Route::middleware('cekRole:Admin')->group(function () {
            Route::get('/create', [UserController::class, 'createUser'])->name('user.create');
            Route::post('/create', [UserController::class, 'userPost'])->name('user.post');
            Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
            Route::patch('/update/{id}', [UserController::class, 'updateUser'])->name('user.update');
            Route::get('/formeditpassword/{id}', [UserController::class, 'editPassword'])->name('password.edit');
            Route::patch('/edit/updatePassword/{id}', [UserController::class, 'updatePassword'])->name('password.update');
            Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
        });
    });
    

    //Project
    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectController::class, 'project'])->name('project');
        Route::get('/create', [ProjectController::class, 'createProject'])->name('project.create');
        Route::post('/create', [ProjectController::class, 'projectPost'])->name('project.post');
        Route::get('/edit/{id}', [ProjectController::class, 'editProject'])->name('project.edit');
        Route::patch('/update/{id}', [ProjectController::class, 'updateProject'])->name('project.update');
        Route::delete('/delete/{id}', [ProjectController::class, 'deleteProject'])->name('project.delete');
        

        //page
        Route::prefix('page')->group(function () {
            Route::get('/{id}', [PageController::class, 'page'])->name('page');
            Route::get('/create/{id}', [PageController::class, 'createPage'])->name('page.create');
            Route::post('/create/{id}', [PageController::class, 'postPage'])->name('page_create.post');
            Route::get('/edit/{id}', [PageController::class, 'editPage'])->name('page.edit');
            Route::patch('/update/{id}', [PageController::class, 'updatePage'])->name('page.update');
            Route::delete('/delete/{id}', [PageController::class, 'deletePage'])->name('page.delete');

        //block
            Route::prefix('block')->group(function () {
                Route::get('/{id}', [BlockController::class, 'block'])->name('block');
                Route::get('/create/{id}', [BlockController::class, 'blockCreate'])->name('block.create');
                Route::post('/create/{id}', [BlockController::class, 'postBlock'])->name('block.post');
                Route::get('/edit/{id}', [BlockController::class, 'blockEdit'])->name('block.edit');
                Route::patch('/update/{id}', [BlockController::class, 'updateBlock'])->name('block.update');
                Route::delete('/delete/{id}', [BlockController::class, 'deleteBlock'])->name('block.delete');
                Route::get('/blocksprint/{id}', [BlockController::class, 'print'])->name('blocks.print');
            });
        });
    });
});

Route::middleware('isGuest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/', [AuthController::class, 'auth'])->name('login.auth');
});
