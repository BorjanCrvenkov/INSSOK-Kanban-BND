<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTaskCommentController;
use App\Http\Controllers\UserWorkspaceController;
use App\Http\Controllers\WorkspaceController;
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
    Route::post('/register', 'register')->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/user', 'getAuthenticatedUser')->name('getAuthenticatedUser');
        Route::get('/refreshToken', 'refreshToken')->name('refreshToken');
    });
});

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('workspaces', WorkspaceController::class);

    Route::apiResource('boards', BoardController::class);

    Route::apiResource('columns', ColumnController::class);

    Route::apiResource('tasks', TaskController::class);

    Route::apiResource('follows', FollowController::class)
        ->except('update');

    Route::apiResource('users', UserController::Class)
        ->except(['update']);
    Route::post('users/{id}', [UserController::class, 'updatePost'])
        ->name('update-post');

    Route::apiResource('user_workspaces', UserWorkspaceController::class);

    Route::apiResource('roles', RoleController::Class);

    Route::apiResource('comments', CommentController::Class);

    Route::apiResource('user_task_comment', UserTaskCommentController::Class);
});


