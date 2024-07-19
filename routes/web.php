<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/**
 * Admin Routes
 */
Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class)->except('index', 'show');
    Route::resource('categories', CategoryController::class)->except('create', 'show');
    Route::resource('tags', TagController::class)->except('create', 'show');
});

/**
 * Public Routes
 */
Route::resource('articles', ArticleController::class)->only('index', 'show');
Route::view('/about', 'about')->name('about');

/**
 * Authentication Routes
 */
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
});

/**
 * Redirect Routes
 */
Route::redirect('/', '/articles', 301);
