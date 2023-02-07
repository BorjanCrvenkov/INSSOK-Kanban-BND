<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserWorkspaceController;
use App\Http\Controllers\WatchesController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\UserTaskCommentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->controller(AuthenticationController::class)->group(function () {
    Route::post('/login', 'login')->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/user', 'getAuthenticatedUser')->name('getAuthenticatedUser');
        Route::get('/refreshToken', 'refreshToken')->name('refreshToken');
    });
});

Route::apiResource('workspaces', WorkspaceController::class);

Route::apiResource('boards', BoardController::class);

Route::apiResource('columns', ColumnController::class);

Route::apiResource('tasks', TaskController::class);

Route::apiResource('watches', WatchesController::class)
    ->except('update');

Route::apiResource('users', UserController::Class);

Route::apiResource('user_workspaces', UserWorkspaceController::class);

Route::apiResource('roles', RoleCollection::Class);

Route::apiResource('comments', CommentCollection::Class);

Route::apiResource('user-task-comment', UserTaskCommentCollection::Class);
