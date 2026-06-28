<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing translations first to avoid duplicates
        Translation::truncate();

        $locales = ['en', 'bn'];

        foreach ($locales as $locale) {
            $path = base_path("lang/{$locale}.json");
            if (File::exists($path)) {
                $translations = json_decode(File::get($path), true);
                if (is_array($translations)) {
                    foreach ($translations as $key => $value) {
                        Translation::create([
                            'locale' => $locale,
                            'key' => $key,
                            'value' => $value,
                        ]);
                    }
                }
            }
        }

        Translation::clearCache();
    }
}
