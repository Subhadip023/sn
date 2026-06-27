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
        $publishedCount = \App\Models\Articles::where('status', 'published')->count();
        $publishedThisWeekCount = \App\Models\Articles::where('status', 'published')
            ->where('published_at', '>=', now()->subDays(7))
            ->count();
        $draftsCount = \App\Models\Articles::where('status', 'draft')->count();
        $scheduledCount = \App\Models\Articles::where('status', 'published')
            ->where('published_at', '>', now())
            ->count();
        $editorsCount = \App\Models\User::where('role', 1)->count();

        // Activity log from latest updated articles
        $recentActivity = \App\Models\Articles::orderBy('updated_at', 'desc')->take(3)->get();

        // Content queue
        $contentQueue = \App\Models\Articles::with('category')->orderBy('updated_at', 'desc')->take(10)->get();

        // Last 7 days views/engagement chart data
        $days = collect(range(6, 0))->map(function($i) {
            return now()->subDays($i);
        });
        $chartLabels = $days->map(fn($date) => $date->format('D'))->toArray();
        $chartValues = $days->map(function($date) {
            return (int) \App\Models\Articles::whereDate('published_at', $date->toDateString())->sum('views');
        })->toArray();

        return view('admin.dashboard', compact(
            'publishedCount',
            'publishedThisWeekCount',
            'draftsCount',
            'scheduledCount',
            'editorsCount',
            'recentActivity',
            'contentQueue',
            'chartLabels',
            'chartValues'
        ));
    })->name('admin.dashboard');

    Route::get('/content', function () {
        return view('admin.content');
    })->name('admin.content');

    Route::get('/users', function () {
        $users = \App\Models\User::all();
        return view('admin.users')->with('users', $users);
    })->name('admin.users');
});