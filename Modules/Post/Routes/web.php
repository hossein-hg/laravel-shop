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
use Modules\Post\Http\Controllers\PostController;
// post
Route::prefix('admin')->group(function () {
    Route::prefix('content')->group(function () {
        // post
        Route::prefix('post')->group(function (){

            Route::get('/',[PostController::class,'index'])->name('admin.content.post.index');
            Route::get('/create',[PostController::class,'create'])->name('admin.content.post.create');
            Route::post('/store',[PostController::class,'store'])->name('admin.content.post.store');
            Route::get('/edit/{post}',[PostController::class,'edit'])->name('admin.content.post.edit');
            Route::put('/update/{post}',[PostController::class,'update'])->name('admin.content.post.update');
            Route::delete('/destroy/{post}',[PostController::class,'destroy'])->name('admin.content.post.destroy');
            Route::get('/status/{post}',[PostController::class,'status'])->name('admin.content.post.status');

        });
    });
});
