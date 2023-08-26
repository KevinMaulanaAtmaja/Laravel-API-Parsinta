<?php

use App\Http\Controllers\Artikel\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Auth')->group(function(){
    Route::post('/register', [RegisterController::class, '__invoke']);
    Route::post('/login', [LoginController::class, '__invoke']);
    Route::post('/logout', [LogoutController::class, '__invoke']);
});

Route::namespace('Auth')->middleware('auth:api')->group(function(){
    Route::post('/create-new-article', [ArticleController::class, 'store']);
    Route::patch('/update-the-selected-article/{article}', [ArticleController::class, 'update']);
    Route::delete('/delete-the-selected-article/{article}', [ArticleController::class, 'destroy']);
});

Route::get('articles/{article}', [ArticleController::class, 'show']);
Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/user', [UserController::class, '__invoke']);


