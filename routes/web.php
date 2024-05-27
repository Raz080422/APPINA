<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Management\Project\ProjectController;
use App\Http\Controllers\Management\UserManagement;
use App\Http\Controllers\Management\ProjectDocument\DocumentController;
use App\Http\Controllers\Management\Task\TaskController;

use App\Http\Middleware\Permission;
use App\Http\Middleware\SessionValidation;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/do-login', [LoginController::class, 'do_login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/check-session', [LoginController::class,'check_session']);

Route::middleware([SessionValidation::class])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    //Route::get('/show-log', [HomeController::class, 'show_log']);

    Route::middleware([Permission::class])->group(function () {
        Route::namespace ('project')->group(function () {
            Route::post('/project/submitproject', [ProjectController::class,'CreateProject']);
            Route::get('/project/allProject', [ProjectController::class, 'GetActiveProject']);
            Route::get('/project/project-detail/{id}', [ProjectController::class, 'GetDetailProject']);
            Route::get('/project/editproject', [ProjectController::class,'GetDetailProject']);
        });

        Route::namespace ('document')->group(function () {
            Route::get('/document/document-detail/{id}', [DocumentController::class, 'GetDetailDocument']);
            Route::get('/document/post-document', [DocumentController::class,'ProcessDocument']);

            Route::get('/document/template',[DocumentController::class,'GetAllTemplate']);
            Route::get('/document/template-detail/{id}', [DocumentController::class,'GetDetailTemplate']);
            Route::post('/document/post-template',[DocumentController::class,'PostTemplate']);
        });
    });
    Route::namespace ('task')->group(function () {
        Route::get('/task/get-alltask', [TaskController::class,'GetAllTask']);
        Route::get('/task/get-detailtask', [TaskController::class,'GetDetailTask']);
    });

});
