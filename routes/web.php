<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Articles;
Route::get('/', function () {
    
    $pages = Page::where('active', true)->orderBy('position', 'asc')->get()->toArray();
    return view('welcome')->with('pages', $pages);
});

Route::get('/page/{slug}', function ($slug) {
    $page = Page::with('categories.articles', 'tags')-> where('slug', $slug)->first();
    $pages = Page::where('active', true)->orderBy('position', 'asc')->get()->toArray();
    $categoryIds = $page->categories->pluck('id');
    $tagIds      = $page->tags->pluck('id');
    $articles = Articles::where('status', 'published')->where(function ($q) use ($categoryIds, $tagIds) {

            // from categories
            if ($categoryIds->isNotEmpty()) {
                $q->whereIn('category_id', $categoryIds);
            }

            // OR from tags
            if ($tagIds->isNotEmpty()) {
                $q->orWhereHas('tags', function ($t) use ($tagIds) {
                    $t->whereIn('tags.id', $tagIds);
                });
            }

        })
        ->with(['category', 'tags', 'author'])
        ->distinct()
        ->latest()
        ->get();

$top_story = $articles->sortByDesc('created_at')->first();
$most_populer_posts = $articles->sortByDesc('views')->take(3);
return view('page')->with('page', $page)->with('pages', $pages)->with('articles', $articles)->with('top_story', $top_story)->with('most_populer_posts', $most_populer_posts);
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';


Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/content', function () {
    return view('admin.content');
})->name('admin.content');

Route::get('/admin/users', function () {
    $users = \App\Models\User::all();
    return view('admin.users')->with('users', $users);
})->name('admin.users');

Route::get('/admin/content', function () {
    return view('admin.content');
})->name('admin.content');

require __DIR__.'/auth.php';
