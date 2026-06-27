<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Articles,Page};

class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pages = Page::where('active', true)->where('lang', app()->getLocale())->orderBy('position', 'asc')->get()->toArray();
        $articles = Articles::where('status', 'published')
            ->where('lang', app()->getLocale())
            ->orderBy('created_at', 'desc')
            ->get();

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
    }
}
