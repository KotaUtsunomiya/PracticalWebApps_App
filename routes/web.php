<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

// トップページ
Route::get('/', [TodoController::class, 'index'])->name('todo.index');
// todoの登録
route::post('/create', [TodoController::class, 'create'])->name('todo.create');
// todoの更新
Route::post('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
// todoの削除
Route::post('/destroy/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
