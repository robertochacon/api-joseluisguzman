<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login/', [AuthController::class, 'login']);
Route::post('/register/', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
], function ($router) {

    Route::post('/logout/', [AuthController::class, 'logout']);
    Route::post('/refresh/', [AuthController::class, 'refresh']);
    Route::post('/me/', [AuthController::class, 'me']);

    //categories
    Route::get('/categories/', [CategoriesController::class, 'index']);
    Route::get('/categories/{id}/', [CategoriesController::class, 'watch']);
    Route::post('/categories/', [CategoriesController::class, 'register']);
    Route::put('/categories/{id}/', [CategoriesController::class, 'update']);
    Route::delete('/categories/{id}/', [CategoriesController::class, 'delete']);

    //contents
    Route::get('/contents/', [ContentsController::class, 'index']);
    Route::get('/contents/{id}/', [ContentsController::class, 'watch']);
    Route::get('/contents/category/{id}/', [ContentsController::class, 'watchById']);
    Route::post('/contents/', [ContentsController::class, 'register']);
    Route::post('/contents/{id}/', [ContentsController::class, 'update']);
    Route::delete('/contents/{id}/', [ContentsController::class, 'delete']);

    //users
    Route::get('/users/', [UserController::class, 'index']);
    Route::get('/users/{id}/', [UserController::class, 'watch']);
    Route::put('/users/{id}/', [UserController::class, 'update']);
    Route::delete('/users/{id}/', [UserController::class, 'delete']);
    Route::post('/users/reset_password/{id}/', [UserController::class, 'reset_password']);

});
