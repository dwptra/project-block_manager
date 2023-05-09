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
            Route::get('/formcreateblocks', [BlockController::class, 'blockMasterCreate'])->name('blockmaster.create');
            Route::post('/createblocks', [BlockController::class, 'blockMasterPost'])->name('blockmaster.post');
            Route::get('/formeditblocks/{id}', [BlockController::class, 'blockMasterEdit'])->name('blockmaster.edit');
            Route::patch('/updateblocks/{id}', [BlockController::class, 'blockMasterUpdate'])->name('blockmaster.update');
            Route::delete('/deleteblocks/{id}', [BlockController::class, 'blockMasterDelete'])->name('blockmaster.delete');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [BlockController::class, 'blockCategory'])->name('block.categories');
            Route::post('/createcategory', [BlockController::class, 'postCategory'])->name('category.post');
            Route::delete('/deletecategory/{id}', [BlockController::class, 'deleteCategory'])->name('category.delete');
            Route::patch('/updatecategory/{id}', [BlockController::class, 'updateCategory'])->name('category.update');
        });
    });


    // User (M)
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'user'])->name('user');
        Route::middleware('cekRole:Admin')->group(function () {
            Route::get('/formcreateuser', [UserController::class, 'createUser'])->name('user.create');
            Route::post('/createuser', [UserController::class, 'userPost'])->name('user.post');
            Route::get('/formedituser/{id}', [UserController::class, 'editUser'])->name('user.edit');
            Route::patch('/updateuser/{id}', [UserController::class, 'updateUser'])->name('user.update');
            Route::get('/formeditpassword/{id}', [UserController::class, 'editPassword'])->name('password.edit');
            Route::patch('/updatepassword/{id}', [UserController::class, 'updatePassword'])->name('password.update');
            Route::delete('/deleteuser/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
        });
    });
    

    //Project
    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectController::class, 'project'])->name('project');
        Route::get('/formcreateproject', [ProjectController::class, 'createProject'])->name('project.create');
        Route::post('/createproject', [ProjectController::class, 'projectPost'])->name('project.post');
        Route::get('/formeditproject/{id}', [ProjectController::class, 'editProject'])->name('project.edit');
        Route::patch('/updateproject/{id}', [ProjectController::class, 'updateProject'])->name('project.update');
        Route::delete('/deleteproject/{id}', [ProjectController::class, 'deleteProject'])->name('project.delete');
        

        //page
        Route::prefix('page')->group(function () {
            Route::get('/{id}', [PageController::class, 'page'])->name('page');
            Route::get('/formcreatepage/{id}', [PageController::class, 'createPage'])->name('page.create');
            Route::post('/createpage/{id}', [PageController::class, 'postPage'])->name('page_create.post');
            Route::get('/formeditpage/{id}', [PageController::class, 'editPage'])->name('page.edit');
            Route::patch('/updatepage/{id}', [PageController::class, 'updatePage'])->name('page.update');
            Route::delete('/deletepage/{id}', [PageController::class, 'deletePage'])->name('page.delete');

        //block
            Route::prefix('block')->group(function () {
                Route::get('/{id}', [BlockController::class, 'block'])->name('block');
                Route::get('/formcreateblock/{id}', [BlockController::class, 'blockCreate'])->name('block.create');
                Route::post('/createblock/{id}', [BlockController::class, 'postBlock'])->name('block.post');
                Route::get('/formeditblock/{id}', [BlockController::class, 'blockEdit'])->name('block.edit');
                Route::patch('/updateblock/{id}', [BlockController::class, 'updateBlock'])->name('block.update');
                Route::delete('/deleteblock/{id}', [BlockController::class, 'deleteBlock'])->name('block.delete');
                Route::get('/blocksprint/{id}', [BlockController::class, 'print'])->name('blocks.print');
            });
        });
    });
});

Route::middleware('isGuest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::post('/', [AuthController::class, 'auth'])->name('login.auth');
});
