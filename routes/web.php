<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MemoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\BiographyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// Публичные маршруты
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Маршруты админ-панели
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('memories', MemoryController::class);
    Route::resource('media', MediaController::class);
    Route::resource('biography', BiographyController::class)->only(['edit', 'update']);
});

require __DIR__.'/auth.php';
