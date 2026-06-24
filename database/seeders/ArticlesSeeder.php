<?php

namespace Database\Seeders;

use App\Models\Articles;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create or get admin user
        $admin = User::where('email', 'admin@example.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 1,
            ]);
        } else {
            $admin->update(['role' => 1]);
        }

        // 2. Create Categories
        $categoriesData = [
            ['title' => 'Technology', 'slug' => 'technology'],
            ['title' => 'Business', 'slug' => 'business'],
            ['title' => 'Politics', 'slug' => 'politics'],
            ['title' => 'Sports', 'slug' => 'sports'],
            ['title' => 'Health', 'slug' => 'health'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::where('slug', $cat['slug'])->first() 
                ?? Category::create([
                    'title' => $cat['title'],
                    'slug' => $cat['slug'],
                    'active' => true,
                ]);
        }

        // 3. Create Tags
        $tagsData = ['Breaking', 'Future', 'Economy', 'Elections', 'Championship', 'Innovation', 'Well-being'];
        $tags = [];
        foreach ($tagsData as $tagName) {
            $tags[] = Tag::where('title', $tagName)->first() 
                ?? Tag::create([
                    'title' => $tagName,
                    'slug' => Str::slug($tagName),
                    'active' => true,
                ]);
        }

        // 4. Articles Data
        $articlesData = [
            // Tech
            [
                'title' => 'The Next Decade of AI: From Chatbots to Agentic Workforces',
                'excerpt' => 'AI assistants are evolving from conversation interfaces into proactive agentic systems capable of handling complex workstreams.',
                'content' => '<p>In the past few years, generative AI has captured global attention. However, the next phase of artificial intelligence is shift from chatbot prompts to autonomous, agentic workflows. These AI agents can plan tasks, interact with APIs, write code, and collaborate in teams to solve multi-step problems with minimal human intervention.</p><p>Organizations are already deploying agentic architectures to automate customer service, optimize code pipelines, and even generate marketing campaigns from scratch. As safety and alignment techniques mature, these systems are poised to redefine modern workspace productivity.</p>',
                'category' => 'technology',
                'views' => 1240,
            ],
            [
                'title' => 'Apple Announces Next-Gen AR Glasses for 2026 Release',
                'excerpt' => 'Rumors suggest a sleeker, lighter augmented reality headset designed to blend seamlessly with everyday prescription glasses.',
                'content' => '<p>Apple has officially unveiled its roadmap for lightweight augmented reality eyewear. Code-named "AirGlass", the device leverages advanced micro-LED displays and custom silicon to overlay navigation, notifications, and spatial workspaces directly onto the user\'s field of view.</p><p>Unlike bulkier VR headsets, AirGlass is designed for all-day comfort and works in tandem with existing prescription lens designs. Pre-orders are set to open late this year, marking a massive milestone for everyday consumer spatial computing.</p>',
                'category' => 'technology',
                'views' => 950,
            ],
            // Business
            [
                'title' => 'Global Markets Rally as Inflation Cools Down to Target Levels',
                'excerpt' => 'Stock indexes reached historic highs after central banks announced interest rate cuts following stabilized inflation rates.',
                'content' => '<p>Major indexes around the world rallied today, with the S&P 500 and FTSE 100 logging record highs. Investors responded enthusiastically to the latest consumer price index reports showing inflation returning to the long-sought 2% target.</p><p>Financial analysts expect central banks to follow up with a series of interest rate cuts over the next three quarters, easing borrowing costs for businesses and homebuyers alike. Market sentiment remains highly optimistic heading into the fiscal half-year.</p>',
                'category' => 'business',
                'views' => 1520,
            ],
            [
                'title' => 'Green Hydrogen Startups Secure Record Venture Funding',
                'excerpt' => 'Clean energy alternatives are seeing massive investment capital as corporations race to meet carbon-neutral goals.',
                'content' => '<p>Funding for green hydrogen production has reached unprecedented levels in 2026. A coalition of international venture firms and state funds announced a combined $3.2 billion investment into high-efficiency electrolysis startups.</p><p>Green hydrogen, which utilizes renewable energy sources to split water, is seen as crucial for decarbonizing heavy industries like shipping, aviation, and steel manufacturing. Experts predict commercial-scale adoption will begin within the next four years.</p>',
                'category' => 'business',
                'views' => 870,
            ],
            // Politics
            [
                'title' => 'Senate Passes Historic Infrastructure and Digital Privacy Act',
                'excerpt' => 'The bipartisan bill allocates federal funding to fiber-optic expansion while setting strict standards for personal data protection.',
                'content' => '<p>After weeks of intense debate, a major bipartisan infrastructure and privacy bill has cleared the Senate floor. The legislation commits substantial federal capital to bringing high-speed broadband to rural communities while establishing rigorous national protections for data privacy.</p><p>Under the new rules, tech companies face steep penalties for unauthorized data collection, matching the strict standards currently enforced in European jurisdictions. The bill now heads to the President\'s desk for final signature.</p>',
                'category' => 'politics',
                'views' => 2100,
            ],
            // Sports
            [
                'title' => 'Underdog Victory in the World Cup Finals Stuns Football Fans',
                'excerpt' => 'A dramatic last-minute penalty shootout crowned a new champion in one of the most thrilling finals in tournament history.',
                'content' => '<p>It was a match that will be remembered for decades. The tournament underdogs defied all expectations to defeat the reigning champions in a nail-biting finish that went all the way to a penalty shootout.</p><p>With the score tied at 3-3 after extra time, the stadium erupted as the underdog goalkeeper made a brilliant game-winning save, securing their country\'s first-ever championship trophy.</p>',
                'category' => 'sports',
                'views' => 3120,
            ],
            // Health
            [
                'title' => 'New Breakthrough in Alzheimers Treatment Enters Phase III Trials',
                'excerpt' => 'A novel antibody therapy shows remarkable success in slowing cognitive decline during early stages of the disease.',
                'content' => '<p>Medical researchers have announced promising results for a new therapeutic drug targeting Alzheimer\'s disease. During Phase II clinical trials, the drug effectively cleared amyloid plaques in the brain and slowed cognitive decline by over 45% compared to placebos.</p><p>The treatment has received fast-track approval from regulatory bodies to enter Phase III trials, offering hope to millions of patients and families worldwide affected by neurodegenerative disorders.</p>',
                'category' => 'health',
                'views' => 1840,
            ],
        ];

        // 5. Insert Articles
        foreach ($articlesData as $item) {
            $category = $categories[$item['category']];
            $slug = Str::slug($item['title']);

            // Avoid duplicate articles
            if (Articles::where('slug', $slug)->exists()) {
                continue;
            }

            $article = Articles::create([
                'title' => $item['title'],
                'slug' => $slug,
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'category_id' => $category->id,
                'author_id' => $admin->id,
                'status' => 'published',
                'published_at' => now(),
                'featured_image_url' => 'https://picsum.photos/seed/' . Str::random(10) . '/800/450',
                'views' => $item['views'],
                'meta_title' => $item['title'] . ' | Sohoj News',
                'meta_description' => $item['excerpt'],
            ]);

            // Attach 1 to 3 random tags
            if (!empty($tags)) {
                $randomTags = collect($tags)->random(rand(1, 3))->pluck('id');
                $article->tags()->attach($randomTags);
            }
        }
    }
}
