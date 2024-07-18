<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/articles', 301);
Route::resource('/articles', ArticleController::class)->only('index', 'show');

Route::view('/about', 'about')->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class)->except('create', 'show');
    Route::resource('tags', TagController::class)->except('create', 'show');
});



require __DIR__.'/auth.php';
