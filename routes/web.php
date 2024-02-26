<?php

use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 削除 destroy
    Route::delete('/delete/{item}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item.destroy');
        
    // 検索機能 search
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'search'])->name('item.search');

    // 編集 edit
    Route::get('/{item}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('item.edit');

    // 更新 update
    Route::put('/item/{item}', [App\Http\Controllers\ItemController::class, 'update'])->name('item.update');
});

