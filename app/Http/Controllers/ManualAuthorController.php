<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualAuthorRequest;
use App\Http\Requests\UpdateManualAuthorRequest;
use App\Models\ManualAuthor;
use Illuminate\Http\Request;

class ManualAuthorController extends Controller
{
    /**
     * Display a listing of manual authors with search and pagination.
     */
    public function index(Request $request)
    {
        $authors = ManualAuthor::query()
            ->when($request->search, fn($q, $s) => $q->where('name', 'like', "%{$s}%")
                                                       ->orWhere('position', 'like', "%{$s}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.manual-authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new manual author.
     */
    public function create()
    {
        return redirect()->route('manual-authors.index');
    }

    /**
     * Store a newly created manual author.
     */
    public function store(StoreManualAuthorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('manual-authors', 'public');
        }

        $author = ManualAuthor::create($data);

        // AJAX quick-create from article form modal
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'id'       => $author->id,
                'name'     => $author->name,
                'position' => $author->position,
            ]);
        }

        return redirect()->route('manual-authors.index')
                         ->with('success', 'Author created successfully.');
    }

    /**
     * Show the form for editing a manual author.
     */
    public function edit(ManualAuthor $manualAuthor)
    {
        return redirect()->route('manual-authors.index');
    }

    /**
     * Update the specified manual author.
     */
    public function update(UpdateManualAuthorRequest $request, ManualAuthor $manualAuthor)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if it was an uploaded file
            if ($manualAuthor->image) {
                \Storage::disk('public')->delete($manualAuthor->image);
            }
            $data['image'] = $request->file('image')->store('manual-authors', 'public');
        }

        $manualAuthor->update($data);

        return redirect()->route('manual-authors.index')
                         ->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified manual author.
     */
    public function destroy(ManualAuthor $manualAuthor)
    {
        if ($manualAuthor->image) {
            \Storage::disk('public')->delete($manualAuthor->image);
        }

        $manualAuthor->delete();

        return redirect()->route('manual-authors.index')
                         ->with('success', 'Author deleted successfully.');
    }
}
