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
    Route::get('/logout', [BlockController::class, 'logout'])->name('logout');

    // Masterdata
    // Block (M)
    Route::prefix('block')->group(function () {
        Route::prefix('blocks')->group(function () {
            Route::get('/', [BlockController::class, 'blockMaster'])->name('block.master');
            Route::get('/create', [BlockController::class, 'blockMasterCreate'])->name('blockmaster.create');
            Route::post('/create', [BlockController::class, 'blockMasterPost'])->name('blockmaster.post');
            Route::get('/edit/{id}', [BlockController::class, 'blockMasterEdit'])->name('blockmaster.edit');
            Route::patch('/update/{id}', [BlockController::class, 'blockMasterUpdate'])->name('blockmaster.update');
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
        Route::get('/', [BlockController::class, 'user'])->name('user');
        Route::get('/create', [BlockController::class, 'createUser'])->name('user.create');
        Route::post('/create', [BlockController::class, 'userPost'])->name('user.post');
        Route::get('/edit/{id}', [BlockController::class, 'editUser'])->name('user.edit');
        Route::patch('/update/{id}', [BlockController::class, 'updateUser'])->name('user.update');
        Route::delete('/delete/{id}', [BlockController::class, 'deleteUser'])->name('user.delete');
    });
    

    //Project
    Route::prefix('project')->group(function () {
        Route::get('/', [BlockController::class, 'project'])->name('project');
        Route::get('/create', [BlockController::class, 'createProject'])->name('project.create');
        Route::post('/create', [BlockController::class, 'projectPost'])->name('project.post');
        Route::get('/edit/{id}', [BlockController::class, 'editProject'])->name('project.edit');
        Route::patch('/update/{id}', [BlockController::class, 'updateProject'])->name('project.update');
        Route::delete('/delete/{id}', [BlockController::class, 'deleteProject'])->name('project.delete');
        

        //page
        Route::prefix('page')->group(function () {
            Route::get('/{id}', [BlockController::class, 'page'])->name('page');
            Route::get('/create/{id}', [BlockController::class, 'createPage'])->name('page.create');
            Route::post('/create/{id}', [BlockController::class, 'postPage'])->name('page_create.post');
            Route::get('/edit/{id}', [BlockController::class, 'editPage'])->name('page.edit');
            Route::patch('/edit/{id}', [BlockController::class, 'updatePage'])->name('page.update');
            Route::delete('/delete/{id}', [BlockController::class, 'deletePage'])->name('page.delete');

        //block
            Route::prefix('block')->group(function () {
                Route::get('/{id}', [BlockController::class, 'block'])->name('block');
                Route::get('/create/{id}', [BlockController::class, 'blockCreate'])->name('block.create');
                Route::post('/create/{id}', [BlockController::class, 'postBlock'])->name('block.post');
                Route::delete('/delete/{id}', [BlockController::class, 'deleteBlock'])->name('block.delete');
                Route::get('/blocksprint/{id}', [BlockController::class, 'print'])->name('blocks.print');
            });
        });
    });
});

Route::middleware('isGuest')->group(function () {
    Route::get('/', [BlockController::class, 'index'])->name('index');
    Route::post('/', [BlockController::class, 'auth'])->name('login.auth');
});
