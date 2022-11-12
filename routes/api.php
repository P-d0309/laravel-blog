<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user/posts', [PostController::class, 'userPosts']);
    Route::post('/user/post', [PostController::class, 'store']);
    Route::put('/user/post/{id}', [PostController::class, 'update']);
    Route::delete('/user/post/{id}', [PostController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
});

Route::get('posts', [PostController::class,'index']);
Route::get('post/show/{id}', [PostController::class,'show']);
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
