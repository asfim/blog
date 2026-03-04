<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('blogs.index');
});

Route::resource('blogs', BlogController::class);
Route::post('blogs/{blog}/toggle-publish', [BlogController::class , 'togglePublish'])->name('blogs.toggle-publish');

Route::resource('categories', CategoryController::class)->except(['show']);
