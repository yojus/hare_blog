<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use GuzzleHttp\Middleware;

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

Route::get('/', [PostController::class, 'index'])
    ->name('root');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// middleware('auth')を追加することで、認証していなければアクセスできないように制御することが可能
Route::resource('posts', PostController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->Middleware('auth');

// 非ログインでもshow,indexは閲覧可能
Route::resource('posts', PostController::class)
    ->only(['show', 'index']);

require __DIR__.'/auth.php';

// exceptもしくはonlyが使える
