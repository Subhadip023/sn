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
            
            $values = [];
            $firstId = null;
            foreach (languages() as $code => $name) {
                $localeTranslation = $group ? $group->firstWhere('locale', $code) : null;
                $values[$code] = $localeTranslation ? $localeTranslation->value : '';
                if ($localeTranslation && !$firstId) {
                    $firstId = $localeTranslation->id;
                }
            }

            return (object)[
                'key' => $item->key,
                'values' => $values,
                'id' => $firstId ?? ($group && $group->first() ? $group->first()->id : null)
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
        $rules = [
            'key' => 'required|string',
        ];
        foreach (languages() as $code => $name) {
            $rules['values.' . $code] = 'required|string';
        }

        $validated = $request->validate($rules);

        foreach (languages() as $code => $name) {
            Translation::updateOrCreate(
                ['key' => $validated['key'], 'locale' => $code],
                ['value' => $validated['values'][$code]]
            );
        }

        Translation::clearCache();

        return redirect()->route('translations.index')->with('success', 'Translation added successfully.');
    }

    /**
     * Show the form for editing the specified translation.
     */
    public function edit(Translation $translation)
    {
        $key = $translation->key;
        $translations = Translation::where('key', $key)->get();
        
        $values = [];
        foreach (languages() as $code => $name) {
            $t = $translations->firstWhere('locale', $code);
            $values[$code] = $t ? $t->value : '';
        }

        return view('admin.translations.edit', compact('key', 'values', 'translation'));
    }

    /**
     * Update the specified translation in storage.
     */
    public function update(Request $request, Translation $translation)
    {
        $rules = [
            'key' => 'required|string',
        ];
        foreach (languages() as $code => $name) {
            $rules['values.' . $code] = 'required|string';
        }

        $validated = $request->validate($rules);

        $originalKey = $translation->key;

        // Clean up or re-create
        Translation::where('key', $originalKey)->delete();

        foreach (languages() as $code => $name) {
            Translation::create([
                'key' => $validated['key'],
                'locale' => $code,
                'value' => $validated['values'][$code]
            ]);
        }

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
