<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Articles;
use App\Http\Controllers\{NewsLatterController,HomePageController,ArticlesController,PageController,UserArticleController};

Route::get('/', HomePageController::class);

Route::get('/article/{slug}', [UserArticleController::class, 'show'])->name('show.article');

Route::get('/page/{slug}', [PageController::class, 'showPage'])->name('page.show');


Route::get('/dashboard', function () {
    $user_role = auth()->user()->role;
    if ($user_role == 0) {
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

        return view('dashboard', compact(
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
    }
    
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('news-later', NewsLatterController::class);



require __DIR__ . '/admin.php';



require __DIR__ . '/auth.php';

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
