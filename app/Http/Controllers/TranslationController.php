<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * Display a listing of the translations.
     */
    public function index(Request $request)
    {
        $query = Translation::select('key')->groupBy('key');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                  ->orWhere('value', 'like', "%{$search}%");
            });
        }

        $paginatedKeys = $query->paginate(20)->withQueryString();

        $keys = $paginatedKeys->pluck('key');
        $translationsGrouped = Translation::whereIn('key', $keys)
            ->get()
            ->groupBy('key');

        $items = $paginatedKeys->map(function ($item) use ($translationsGrouped) {
            $group = $translationsGrouped->get($item->key);
            $en = $group ? $group->firstWhere('locale', 'en') : null;
            $bn = $group ? $group->firstWhere('locale', 'bn') : null;
            
            return (object)[
                'key' => $item->key,
                'en_value' => $en ? $en->value : '',
                'bn_value' => $bn ? $bn->value : '',
                'en_id' => $en ? $en->id : null,
                'bn_id' => $bn ? $bn->id : null,
                // Fallback ID to pass to route helpers
                'id' => ($en ? $en->id : ($bn ? $bn->id : null))
            ];
        });

        $paginatedKeys->setCollection($items);

        return view('admin.translations.index', [
            'translations' => $paginatedKeys
        ]);
    }

    /**
     * Show the form for creating a new translation.
     */
    public function create()
    {
        return view('admin.translations.create');
    }

    /**
     * Store a newly created translation in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string',
            'value_en' => 'required|string',
            'value_bn' => 'required|string',
        ]);

        Translation::updateOrCreate(
            ['key' => $validated['key'], 'locale' => 'en'],
            ['value' => $validated['value_en']]
        );

        Translation::updateOrCreate(
            ['key' => $validated['key'], 'locale' => 'bn'],
            ['value' => $validated['value_bn']]
        );

        Translation::clearCache();

        return redirect()->route('translations.index')->with('success', 'Translation added successfully.');
    }

    /**
     * Show the form for editing the specified translation.
     */
    public function edit(Translation $translation)
    {
        $key = $translation->key;
        $en = Translation::where('key', $key)->where('locale', 'en')->first();
        $bn = Translation::where('key', $key)->where('locale', 'bn')->first();

        return view('admin.translations.edit', compact('key', 'en', 'bn', 'translation'));
    }

    /**
     * Update the specified translation in storage.
     */
    public function update(Request $request, Translation $translation)
    {
        $validated = $request->validate([
            'key' => 'required|string',
            'value_en' => 'required|string',
            'value_bn' => 'required|string',
        ]);

        $originalKey = $translation->key;

        // Clean up or re-create
        Translation::where('key', $originalKey)->delete();

        Translation::create([
            'key' => $validated['key'],
            'locale' => 'en',
            'value' => $validated['value_en']
        ]);

        Translation::create([
            'key' => $validated['key'],
            'locale' => 'bn',
            'value' => $validated['value_bn']
        ]);

        Translation::clearCache();

        return redirect()->route('translations.index')->with('success', 'Translation updated successfully.');
    }

    /**
     * Remove the specified translation from storage.
     */
    public function destroy(Translation $translation)
    {
        Translation::where('key', $translation->key)->delete();

        Translation::clearCache();

        return redirect()->route('translations.index')->with('success', 'Translation deleted successfully.');
    }
}
