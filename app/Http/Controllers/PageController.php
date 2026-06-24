<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::orderBy('position', 'asc')->get();
        $length = $pages->count();

        return view('admin.pages.index', compact('pages', 'length'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        try {
            $valData = $request->validated();
            if (!isset($valData['slug'])) {
                $valData['slug'] = str($valData['title'])->slug();
            }
            $lastPosition = Page::max('position');
            $valData['position'] = $lastPosition + 1;
            Page::create($valData);
            return redirect()->route('pages.index')->with('success', 'Page created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        try {
            $valData = $request->validated();
            $valData['hide_articles'] = $request->has('hide_articles') ? true : false;
            $page->update($valData);
            return redirect()->route('pages.index')->with('success', 'Page updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return redirect()->route('pages.index')->with('success', 'Page deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Reorder pages position.
     */
    public function reorder(Request $request)
    {
        $positions = $request->input('position');
    
        if (is_array($positions)) {
            // Check for duplicate values in the positions array
            if (count($positions) !== count(array_unique($positions))) {
                return back()->with('error', 'Duplicate position values are not allowed.');
            }

            foreach ($positions as $id => $position) {
                Page::where('id', $id)->update(['position' => $position]);
            }
        }

        return redirect()->route('pages.index')->with('success', 'Page order updated successfully');
    }

    public function settings(Page $page) {
        $categories = Category::where('active', true)->get();
        $tags= Tag::where('active', true)->get();
        $selcted_categories = $page->categories->pluck('id')->toArray();
        $selcted_tags = $page->tags->pluck('id')->toArray();
        return view('admin.pages.settings', compact('page', 'categories', 'tags', 'selcted_categories', 'selcted_tags'));
    }

    public function updateSettings(Request $request) {
        try {
            $data = $request->except('_token');
            $categoryIds = $request->categories ?? [];
            $tagIds = $request->tags ?? [];
            
            $page = Page::findOrFail($data['page_id']);
            $page->categories()->sync($categoryIds);
            $page->tags()->sync($tagIds);
            
            $page->update([
                'content' => $request->input('content'),
                'hide_articles' => $request->has('hide_articles') ? true : false,
            ]);
            
            return redirect()->route('page.settings', $page->id)->with('success', 'Page settings updated successfully');

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
