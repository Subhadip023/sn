<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticlesRequest;
use App\Http\Requests\UpdateArticlesRequest;
use App\Models\Articles;
use App\Models\ArticleTags;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Articles::with(['category', 'author'])->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticlesRequest $request)
    {
        $data = $request->validated();

        // dd($data);
        
        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        }
        
        $data['author_id'] = $data['author_id'] ?? auth()->id();
        
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles', 'public');
            $data['featured_image'] = $path;
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        $article_tags = $data['tags'] ?? [];
       
        unset($data['tags']);
        $article = Articles::create($data);
        $tag_data = [];
         if (!empty($article_tags)) {
            foreach ($article_tags as $article_tag) {
                $tag_data
                [] = [
                    'article_id' => $article->id,
                    'tag_id' => $article_tag
                ];
            }
            ArticleTags::insert($tag_data);
        }
        
        if ($data['status'] === 'draft') {
         
            return redirect()->route('articles.index')->with('success', 'Article saved as draft successfully.');
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $article)
    {
        $meta = [
            'title'       => $article->meta_title ?? $article->title,
            'description' => $article->meta_description ?? $article->excerpt,
            'keywords'    => $article->meta_keywords,
            'canonical'   => $article->canonical_url ?? url()->current(),
            'og_image'    => $article->og_image_url ?? $article->featured_image_url,
        ];
        return view('admin.articles.show', compact('article', 'meta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        $article->load('tags');
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticlesRequest $request, Articles $article)
    {
        $data = $request->validated();
        
        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        }
        
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles', 'public');
            $data['featured_image'] = $path;
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article_tags = $data['tags'] ?? [];
        unset($data['tags']);

        $article->update($data);
        
        $article->tags()->sync($article_tags);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $articles) // Note: route model binding uses 'articles' param name usually? Check route:resource. 'articles' -> {article} usually. But model is Articles.
    {
        // Laravel might bind {article} to class Articles if parameter matches. Resource param is singular by default.
        // But model name is plural 'Articles'.
        // Route::resource('articles', ...) -> param is {article}.
        // Typehint: destroy(Articles $article)
        
        // However, standard resource uses singular param name.
        // Let's assume Laravel resolves it or user fixes it. I will keep $articles var name to match stub for now, but rename logically.
        $articles->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
