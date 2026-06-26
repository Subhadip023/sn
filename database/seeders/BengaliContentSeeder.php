<?php

namespace Database\Seeders;

use App\Models\Articles;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BengaliContentSeeder extends Seeder
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
        }

        // 2. Create Bengali Categories (lang => bn)
        $categoriesData = [
            ['title' => 'প্রযুক্তি', 'slug' => 'projukti-bn'],
            ['title' => 'ব্যবসা', 'slug' => 'byabsa-bn'],
            ['title' => 'রাজনীতি', 'slug' => 'rajniti-bn'],
            ['title' => 'খেলাধুলা', 'slug' => 'kheladhula-bn'],
            ['title' => 'স্বাস্থ্য', 'slug' => 'shasthya-bn'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::where('slug', $cat['slug'])->first() 
                ?? Category::create([
                    'title' => $cat['title'],
                    'slug' => $cat['slug'],
                    'lang' => 'bn',
                    'active' => true,
                ]);
        }

        // 2.5. Create Bengali Pages (lang => bn)
        $pagesData = [
            ['title' => 'প্রযুক্তি', 'slug' => 'projukti-page-bn', 'category_slug' => 'projukti-bn', 'position' => 1],
            ['title' => 'ব্যবসা', 'slug' => 'byabsa-page-bn', 'category_slug' => 'byabsa-bn', 'position' => 2],
            ['title' => 'রাজনীতি', 'slug' => 'rajniti-page-bn', 'category_slug' => 'rajniti-bn', 'position' => 3],
            ['title' => 'খেলাধুলা', 'slug' => 'kheladhula-page-bn', 'category_slug' => 'kheladhula-bn', 'position' => 4],
            ['title' => 'স্বাস্থ্য', 'slug' => 'shasthya-page-bn', 'category_slug' => 'shasthya-bn', 'position' => 5],
        ];

        foreach ($pagesData as $pData) {
            $page = \App\Models\Page::where('slug', $pData['slug'])->first();
            if (!$page) {
                $page = \App\Models\Page::create([
                    'title' => $pData['title'],
                    'slug' => $pData['slug'],
                    'position' => $pData['position'],
                    'lang' => 'bn',
                    'active' => true,
                ]);
            }
            
            // Sync with corresponding Category
            $category = $categories[$pData['category_slug']];
            if ($category) {
                $page->categories()->sync([$category->id]);
            }
        }

        // 3. Create Bengali Tags (lang => bn)
        $tagsData = ['ব্রেকিং নিউজ', 'ভবিষ্যত প্রযুক্তি', 'অর্থনীতি', 'নির্বাচন', 'চ্যাম্পিয়নশিপ', 'উদ্ভাবন'];
        $tags = [];
        foreach ($tagsData as $tagName) {
            $tags[] = Tag::where('title', $tagName)->first() 
                ?? Tag::create([
                    'title' => $tagName,
                    'slug' => Str::slug($tagName),
                    'lang' => 'bn',
                    'active' => true,
                ]);
        }

        // 4. Bengali Articles Data
        $articlesData = [
            [
                'title' => 'কৃত্রিম বুদ্ধিমত্তার ভবিষ্যৎ: চ্যাটবট থেকে স্বয়ংক্রিয় কর্মী',
                'excerpt' => 'কৃত্রিম বুদ্ধিমত্তা সাধারণ চ্যাটবট থেকে এখন জটিল স্বয়ংক্রিয় সিস্টেমে রূপান্তরিত হচ্ছে যা কর্মক্ষেত্রে বিপ্লব আনবে।',
                'content' => '<p>গত কয়েক বছরে জেনারেটিভ এআই বা কৃত্রিম বুদ্ধিমত্তা বিশ্বজুড়ে ব্যাপক আলোড়ন তৈরি করেছে। তবে এআই-এর পরবর্তী ধাপ শুধুমাত্র চ্যাটবটেই সীমাবদ্ধ নয়, এটি এখন স্বয়ংক্রিয় কর্মপ্রক্রিয়ায় রূপান্তরিত হচ্ছে। এই নতুন প্রজন্মের এআই এজেন্ট নিজে পরিকল্পনা করতে পারে, বিভিন্ন এপিআই ব্যবহার করতে পারে, কোড লিখতে পারে এবং খুব সামান্য মানুষের সহযোগিতা নিয়েই মাল্টি-স্টেপ প্রজেক্ট সম্পন্ন করতে পারে।</p><p>ইতিমধ্যেই বিভিন্ন প্রতিষ্ঠান গ্রাহক সেবা, কোড অপ্টিমাইজেশন এবং মার্কেটিং ক্যাম্পেইন তৈরিতে এআই এজেন্ট মোতায়েন শুরু করেছে। নিরাপত্তা ও কার্যক্ষমতার দিকগুলো আরও উন্নত হওয়ার সাথে সাথে এই সিস্টেমগুলো আধুনিক কর্মক্ষেত্রের উৎপাদনশীলতাকে নতুন উচ্চতায় নিয়ে যাবে বলে আশা করা হচ্ছে।</p>',
                'category' => 'projukti-bn',
                'views' => rand(500, 2000),
            ],
            [
                'title' => '২০২৬ সালের মধ্যে বাজারে আসছে অ্যাপলের নতুন এআর গ্লাস',
                'excerpt' => 'অ্যাপলের লাইটওয়েট অগমেন্টেড রিয়েলিটি চশমা নিয়ে প্রযুক্তি বিশ্বে ব্যাপক উদ্দীপনা তৈরি হয়েছে।',
                'content' => '<p>অ্যাপল তাদের নতুন প্রজন্মের অগমেন্টেড রিয়েলিটি (এআর) চশমার রোডম্যাপ ঘোষণা করেছে। কোড নাম "এয়ারগ্লাস", এই ডিভাইসটি উন্নত মাইক্রো-এলইডি ডিসপ্লে এবং বিশেষ চিপসেটের সমন্বয়ে তৈরি, যা ব্যবহারকারীর চোখের সামনে রিয়েল-টাইম নেভিগেশন, নোটিফিকেশন এবং ভার্চুয়াল কাজের পরিবেশ তুলে ধরবে।</p><p>ভারী ভিআর হেডসেটের তুলনায় এয়ারগ্লাস অনেক হালকা ও আরামদায়ক হবে। এটি সাধারণ চশমার মতো সারাদিন ব্যবহার করা যাবে। চলতি বছরের শেষের দিকে এর প্রি-অর্ডার শুরু হওয়ার সম্ভাবনা রয়েছে, যা দৈনন্দিন কম্পিউটিংয়ের ক্ষেত্রে এক বিশাল মাইলফলক।</p>',
                'category' => 'projukti-bn',
                'views' => rand(500, 2000),
            ],
            [
                'title' => 'বিশ্ব বাজারে বড় দরপতন কাটিয়ে শেয়ার বাজারে দারুণ উত্থান',
                'excerpt' => 'মূল্যস্ফীতি নিয়ন্ত্রণে আসায় বিশ্বব্যাপী শেয়ার বাজারে বড় ধরনের মূল্য বৃদ্ধি রেকর্ড করা হয়েছে।',
                'content' => '<p>বিশ্বজুড়ে মূল্যস্ফীতির হার কমতে শুরু করায় বৈশ্বিক পুঁজিবাজারে আজ বড় ধরনের সুবাতাস বয়ে গেছে। এস অ্যান্ড পি ৫০০ এবং এফটিএসই ১০০ এর মতো বড় সূচকগুলো নতুন ঐতিহাসিক রেকর্ড স্পর্শ করেছে। ব্যাংকগুলোর পক্ষ থেকে সুদের হার কমানোর ঘোষণার পর বিনিয়োগকারীদের মধ্যে আশার আলো দেখা গেছে।</p><p>আর্থিক বিশ্লেষকরা ধারণা করছেন যে, পরবর্তী ৩টি প্রান্তিকে সুদের হার আরও হ্রাস পাবে, যা ব্যবসা প্রতিষ্ঠান এবং সাধারণ ঋণগ্রহীতাদের জন্য ঋণ গ্রহণের খরচ কমিয়ে আনবে। ফলে আগামী অর্থবছরের প্রথমার্ধে বাজারের গতিশীলতা আরও বৃদ্ধি পাবে।</p>',
                'category' => 'byabsa-bn',
                'views' => rand(500, 2000),
            ],
            [
                'title' => 'পরিবেশবান্ধব সবুজ হাইড্রোজেন প্রযুক্তিতে রেকর্ড বিনিয়োগ',
                'excerpt' => 'কার্বন নিঃসরণ মুক্ত বিশ্ব গড়ার লক্ষ্যে বিভিন্ন বড় করপোরেট প্রতিষ্ঠান এখন গ্রিন হাইড্রোজেন প্রযুক্তিতে বিপুল তহবিল সরবরাহ করছে।',
                'content' => '<p>চলতি ২০২৬ সালে গ্রিন বা সবুজ হাইড্রোজেন উৎপাদনে রেকর্ড বিনিয়োগ এসেছে। বিশ্বের বিভিন্ন শীর্ষস্থানীয় ভেঞ্চার ক্যাপিটাল ও রাষ্ট্রিয় তহবিল যৌথভাবে হাই-এফিসিয়েন্সি ইলেকট্রোলাইসিস স্টার্টআপগুলোতে ৩.২ বিলিয়ন ডলার বিনিয়োগের ঘোষণা দিয়েছে।</p><p>নবায়নযোগ্য শক্তির মাধ্যমে পানি থেকে হাইড্রোজেন ও অক্সিজেন আলাদা করে এই গ্যাস তৈরি করা হয়। বিমান চলাচল, নৌপরিবহন এবং ইস্পাত শিল্পের মতো ভারী খাতগুলোকে কার্বনমুক্ত করতে গ্রিন হাইড্রোজেনকে অত্যন্ত গুরুত্বপূর্ণ বিকল্প হিসেবে দেখা হচ্ছে। বিশেষজ্ঞরা বলছেন, আগামী চার বছরের মধ্যে বাণিজ্যিকভাবে এর ব্যাপক ব্যবহার শুরু হবে।</p>',
                'category' => 'byabsa-bn',
                'views' => rand(500, 2000),
            ],
            [
                'title' => 'ঐতিহাসিক ফুটবল ট্রফিতে নাটকীয় জয় চ্যাম্পিয়নদের',
                'excerpt' => 'বিশ্বকাপের রোমাঞ্চকর ফাইনালে শেষ মুহূর্তের পেনাল্টি শুটআউটে নতুন চ্যাম্পিয়ন পেল ফুটবল বিশ্ব।',
                'content' => '<p>ফুটবল ইতিহাসের অন্যতম সেরা এবং রোমাঞ্চকর এক ফাইনাল ম্যাচ উপভোগ করলেন দর্শকেরা। ফেভারিট দলকে হারিয়ে শেষ মুহূর্তের নাটকীয় পেনাল্টি শুটআউটে জয় ছিনিয়ে নিল আন্ডারডগ দলটি।</p><p>নির্ধারিত ও অতিরিক্ত সময় শেষে খেলা ৩-৩ গোলে ড্র থাকার পর টাইব্রেকারে রূপ নেয়। আন্ডারডগ গোলরক্ষকের দুর্দান্ত সেভ তাদের দেশকে প্রথমবারের মতো বিশ্ব চ্যাম্পিয়নের শিরোপা এনে দেয়। স্টেডিয়াম জুড়ে তখন উৎসবের আমেজ।</p>',
                'category' => 'kheladhula-bn',
                'views' => rand(500, 2000),
            ],
        ];

        // 5. Insert Bengali Articles
        foreach ($articlesData as $item) {
            $category = $categories[$item['category']];
            $slug = Str::slug($item['title']);

            // Avoid duplicates
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
                'lang' => 'bn',
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
