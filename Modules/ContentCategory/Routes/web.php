<?php

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

use Illuminate\Support\Facades\Route;
use Modules\ContentCategory\Http\Controllers\ContentCategoryController;
// category
Route::prefix('admin')->group(function () {
    Route::prefix('content')->group(function () {
        Route::prefix('category')->group(function () {

        Route::get('/', [ContentCategoryController::class, 'index'])->name('admin.content.category.index');
        Route::get('/create', [ContentCategoryController::class, 'create'])->name('admin.content.category.create');
        Route::post('/store', [ContentCategoryController::class, 'store'])->name('admin.content.category.store');
        Route::get('/edit/{category}', [ContentCategoryController::class, 'edit'])->name('admin.content.category.edit');
        Route::put('/update/{category}', [ContentCategoryController::class, 'update'])->name('admin.content.category.update');
        Route::delete('/destroy/{category}', [ContentCategoryController::class, 'destroy'])->name('admin.content.category.destroy');
        Route::get('/status/{category}', [ContentCategoryController::class, 'status'])->name('admin.content.category.status');

         });
    });
});
