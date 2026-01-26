<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
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
}
