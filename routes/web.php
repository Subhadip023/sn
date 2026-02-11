<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Articles;
use App\Http\Controllers\NewsLatterController;

Route::get('/', function () {
    $pages = Page::where('active', true)->orderBy('position', 'asc')->get()->toArray();
    $articles = Articles::where('status', 'published')->orderBy('created_at', 'desc')->get();

    $top_story = $articles->first();
    // Slice enough articles to allow for skipping 3 and taking 10, plus the top story.
    // If top_story is the first, then we need 3 + 10 = 13 more articles.
    // So, slice from index 1 (after top_story) and take 13.
    $latest_articles = $articles->slice(1, 13);
    return view('welcome')
        ->with('pages', $pages)
        ->with('articles', $articles)
        ->with('top_story', $top_story)
        ->with('latest_articles', $latest_articles);
});

Route::get('/article/{slug}', function ($slug) {
    $article = Articles::with(['category', 'author', 'tags'])->where('slug', $slug)->firstOrFail();
    $pages = Page::where('active', true)->orderBy('position', 'asc')->get()->toArray();
    $latest_articles = Articles::where('status', 'published')->where('id', '!=', $article->id)->orderBy('created_at', 'desc')->take(5)->get();

    return view('admin.articles.show')->with('article', $article)->with('pages', $pages)->with('latest_articles', $latest_articles);
})->name('article.show');

Route::get('/page/{slug}', function ($slug) {
    $page = Page::with('categories.articles', 'tags')->where('slug', $slug)->first();
    $pages = Page::where('active', true)->orderBy('position', 'asc')->get()->toArray();
    $categoryIds = $page->categories->pluck('id');
    $tagIds      = $page->tags->pluck('id');
    $articles_query = Articles::where('status', 'published')->where(function ($q) use ($categoryIds, $tagIds) {

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
        ->latest();

    $top_story = (clone $articles_query)->first();
    $articles = $articles_query->when($top_story, function ($q) use ($top_story) {
        return $q->where('id', '!=', $top_story->id);
    })->paginate(6);

    $most_populer_posts = Articles::where('status', 'published')->orderBy('views', 'desc')->take(3)->get();
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

Route::resource('news-later', NewsLatterController::class);



require __DIR__ . '/admin.php';



require __DIR__ . '/auth.php';
