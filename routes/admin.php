<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\NewsLatterController;
use App\Http\Controllers\TranslationController;

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::post('pages/reorder', [PageController::class, 'reorder'])->name('pages.reorder');
    Route::resource('pages', PageController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('articles', ArticlesController::class);
    Route::resource('newsletter', NewsLatterController::class);
    Route::resource('translations', TranslationController::class);
    Route::get('page/settings/{page}', [PageController::class, 'settings'])->name('page.settings');
    Route::post('page/settings', [PageController::class, 'updateSettings'])->name('page.settings.update');
    Route::post('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::post('tags/search', [TagController::class, 'search'])->name('tags.search');

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/content', function () {
        return view('admin.content');
    })->name('admin.content');

    Route::get('/users', function () {
        $users = \App\Models\User::all();
        return view('admin.users')->with('users', $users);
    })->name('admin.users');
});