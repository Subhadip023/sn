<?php

namespace Database\Seeders;

use App\Models\Articles;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechArticleSeeder extends Seeder
{
    public function run(): void
    {
        $techCategory = Category::where('title', 'Technology')->first() ?? Category::create([
            'title' => 'Technology',
            'slug' => 'technology',
            'active' => 1
        ]);

        $user = User::first() ?? User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $tags = Tag::take(5)->pluck('id');

        $articles = [
            [
                'title' => 'The Rise of Quantum Computing in 2026',
                'excerpt' => 'Quantum computing is moving from theoretical labs to practical application in major industries.',
                'content' => '<p>Quantum computing is no longer a distant dream. In 2026, we are seeing significant breakthroughs in error correction and qubit stability, allowing for complex simulations in drug discovery and cryptography.</p>',
            ],
            [
                'title' => 'How AI is Transforming Modern Healthcare',
                'excerpt' => 'From diagnostic tools to personalized treatment plans, AI is saving lives.',
                'content' => '<p>Artificial intelligence is revolutionized healthcare. Neural networks now assist radiologists with 99% accuracy in early detection of anomalies, while generative models help design custom protein structures for new medicines.</p>',
            ],
            [
                'title' => 'The Future of Sustainable Green Energy Tech',
                'excerpt' => 'Next-gen solar panels and fusion research are paving the way for a carbon-neutral future.',
                'content' => '<p>The energy transition is accelerating. Perovskite solar cells have reached record efficiencies, and small modular fusion reactors are nearing commercial viability, promising unlimited clean energy.</p>',
            ],
            [
                'title' => 'Cybersecurity Trends: Protecting Your Privacy',
                'excerpt' => 'With increasing digital threats, zero-trust architecture is becoming the industry standard.',
                'content' => '<p>Cybersecurity is the top priority for enterprises. Post-quantum cryptography is being implemented to safeguard data against future quantum attacks, and AI-driven threat detection is stopping breaches before they occur.</p>',
            ],
            [
                'title' => 'The Evolution of 6G Networks and Connectivity',
                'excerpt' => 'While 5G is still expanding, engineers are already testing sub-terahertz 6G connectivity.',
                'content' => '<p>6G will bring ultra-low latency and terabit-per-second speeds. This will enable immersive holographic communication and real-time remote surgery with zero lag, bridging the physical and digital worlds.</p>',
            ],
            [
                'title' => 'Space Exploration: Mining Asteroids for Resources',
                'excerpt' => 'Private companies are developing robotic systems to extract rare earth minerals from asteroids.',
                'content' => '<p>The next gold rush is in space. Autonomous mining rigs are being launched to the asteroid belt to retrieve platinum and iridium, essential for high-tech manufacturing and electronics on Earth.</p>',
            ],
            [
                'title' => 'Biotechnology Innovations: Editing the Human Genome',
                'excerpt' => 'CRISPR 3.0 allows for precise gene editing without off-target effects.',
                'content' => '<p>Biotech is at a turning point. We can now correct genetic disorders at the embryonic level, potentially eliminating hereditary diseases like cystic fibrosis and sickle cell anemia for future generations.</p>',
            ],
            [
                'title' => 'The Impact of BlockChain on Global Supply Chains',
                'excerpt' => 'Distributed ledger technology is providing unprecedented transparency from factory to front door.',
                'content' => '<p>Blockchain is fixing supply chains. Smart contracts automate payments upon delivery, and immutable tracking ensures that products are ethically sourced and authentic, reducing fraud globally.</p>',
            ],
            [
                'title' => 'Autonomous Vehicles: The Road to Level 5 Self-Driving',
                'excerpt' => 'Lidar and Al-vision are finally reaching the reliability needed for driverless taxis.',
                'content' => '<p>Autonomous driving is becoming reality. Major cities are launching fully driverless ride-hailing services, significantly reducing traffic accidents and changing the urban landscape forever.</p>',
            ],
            [
                'title' => 'Wearable Tech: Beyond Smartwatches to Neural Links',
                'excerpt' => 'Brain-computer interfaces are starting to allow direct interaction with digital systems.',
                'content' => '<p>The next frontier of wearables is the mind. Non-invasive neural links can now translate thought into text and control smart home devices, offering a new level of accessibility and human-computer symbiosis.</p>',
            ],
        ];

        foreach ($articles as $data) {
            $article = Articles::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'category_id' => $techCategory->id,
                'author_id' => $user->id,
                'status' => 'published',
                'published_at' => now(),
                'featured_image_url' => 'https://picsum.photos/seed/' . Str::random(10) . '/800/450',
                'views' => rand(100, 5000),
            ]);

            if ($tags->isNotEmpty()) {
                $article->tags()->attach($tags->random(rand(1, 3)));
            }
        }
    }
}
