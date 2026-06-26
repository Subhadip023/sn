<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Technology',
                'slug' => 'technology',
                'position' => 1,
            ],
            [
                'title' => 'Business',
                'slug' => 'business',
                'position' => 2,
            ],
            [
                'title' => 'Politics',
                'slug' => 'politics',
                'position' => 3,
            ],
            [
                'title' => 'Sports',
                'slug' => 'sports',
                'position' => 4,
            ],
            [
                'title' => 'Health',
                'slug' => 'health',
                'position' => 5,
            ],
        ];

        foreach ($pages as $p) {
            $page = Page::where('slug', $p['slug'])->first();
            if (!$page) {
                $page = Page::create([
                    'title' => $p['title'],
                    'slug' => $p['slug'],
                    'position' => $p['position'],
                    'lang' => 'en',
                    'active' => true,
                ]);
            }

            // Sync with corresponding Category
            $category = Category::where('slug', $p['slug'])->first();
            if ($category) {
                $page->categories()->sync([$category->id]);
            }
        }
    }
}
