<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Page;
use Illuminate\Support\Str;

class UserArticleController extends Controller
{
    /**
     * Display the specified article for the frontend.
     */
    public function show($slug)
    {
        $article = Articles::with(['category', 'author', 'tags'])->where('slug', $slug)->firstOrFail();
        
        // Increment the view count on every view
        if(!auth()->check() || (!auth()->user() && $article->author_id != auth()->user()->id)){
            $article->increment('views');
        }

        $pages = Page::where('active', true)->where('lang', app()->getLocale())->orderBy('position', 'asc')->get()->toArray();
        $latest_articles = Articles::where('status', 'published')->where('lang', app()->getLocale())->where('id', '!=', $article->id)->orderBy('created_at', 'desc')->take(5)->get();

        $meta = [
            'title'       => $article->meta_title ?? $article->title,
            'description' => $article->meta_description ?? $article->excerpt,
            'keywords'    => $article->meta_keywords,
            'canonical'   => $article->canonical_url ?? url()->current(),
            'og_image'    => $article->og_image_url ?? $article->featured_image_url,
        ];

        return view('admin.articles.show', compact('article', 'pages', 'latest_articles', 'meta'));
    }
}
