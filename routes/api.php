<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// JWT認証
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('users', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


// 記事のCRUD
use App\Http\Controllers\Api\ArticleController; // 追加

Route::get('articles', [ArticleController::class, 'index']); // 記事の一覧を取得
Route::post('articles', [ArticleController::class, 'store']); // 新しい記事を作成
Route::get('articles/{slug}', [ArticleController::class, 'show']); // スラッグに基づいて個別の記事を取得
Route::put('articles/{slug}', [ArticleController::class, 'update']); // スラッグに基づいて記事を更新
Route::delete('articles/{slug}', [ArticleController::class, 'destroy']); // スラッグに基づいて記事を削除
