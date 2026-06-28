<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $defaultLang = setting('default_language', 'en');
        $selectedLang = $request->query('lang', $defaultLang);

        $query = Tag::latest();

        if ($selectedLang !== 'all') {
            $query->where('lang', $selectedLang);
        }

        $tags = $query->get();

        return view('admin.tags.index', compact('tags', 'selectedLang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $validated = $request->validated();
        
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        Tag::create($validated);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }


    public function search(Request $request) {
        $search = $request['query'];
        $tags = Tag::select('id', 'title')
            ->where('title', 'like', "%{$search}%")
            ->limit(10)
            ->get();
        return response()->json(['success' => true, 'data' => $tags]);
    }

}
