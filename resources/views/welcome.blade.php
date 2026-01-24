<x-font-layout title="Welcome">
      <!-- Breaking News Ticker -->
        <div class="bg-gray-100 py-2 my-4 border-l-4 border-primary-red flex items-center">
            <span class="bg-primary-red text-white px-3 py-0.5 mr-4 font-semibold uppercase text-xs whitespace-nowrap">Breaking:</span>
            <div class="flex-1 overflow-hidden">
                <ul class="list-none">
                    <li>Breaking News 1: This is a sample breaking news headline</li>
                    <li>Breaking News 2: Another important update for our readers</li>
                    <li>Breaking News 3: Stay tuned for more updates</li>
                    <li>Breaking News 4: Latest developments in the news</li>
                    <li>Breaking News 5: More breaking news to come</li>
                    <li>Breaking News 6: Stay informed with us</li>
                    <li>Breaking News 7: Breaking news continues</li>
                    <li>Breaking News 8: Stay updated with us</li>
                    <li>Breaking News 9: Breaking news continues</li>
                </ul>
            </div>
        </div>

        <!-- Main Headline -->
        <section class="grid md:grid-cols-2 gap-8 my-8">
            <div class="py-5">
                <span class="inline-block bg-primary-red text-white px-3 py-1 rounded text-xs font-semibold uppercase mb-4">TOP STORY</span>
                <h1 class="text-3xl md:text-4xl font-semibold mb-4 leading-tight">This is the main headline of the day's most important news story</h1>
                <p class="text-lg text-gray-800 my-4">A brief summary of the main story that will capture the reader's attention and provide context about the most important news of the day.</p>
                <p class="text-sm text-gray-600">By Author Name | 2 hours ago | <a href="./public/article.html" class="text-primary-red hover:underline">Read More</a></p>
            </div>
            <div>
                <img src="https://picsum.photos/800/450?random=1" alt="Main News" class="w-full h-auto rounded-lg shadow-lg">
            </div>
        </section>

        <!-- News Grid -->
        <section class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 my-10">
            <a href="./public/article.html" class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://picsum.photos/400/225?random=2" alt="News 1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Politics</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Political leaders meet to discuss new policies</h3>
                    <p class="text-sm text-gray-600">2 hours ago</p>
                </div>
            </a>
            <a href="./public/article.html" class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://picsum.photos/400/225?random=3" alt="News 2" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    <span class="absolute bottom-2.5 left-2.5 bg-primary-red text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Sports</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">National team wins championship in thrilling match</h3>
                    <p class="text-sm text-gray-600">5 hours ago</p>
                </div>
            </a>
            <a href="./public/article.html" class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://picsum.photos/400/225?random=4" alt="News 3" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Technology</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">New smartphone breaks sales records</h3>
                    <p class="text-sm text-gray-600">8 hours ago</p>
                </div>
            </a>
        </section>

        <!-- More News Section -->
        <section class="my-12">
            <div class="flex justify-between items-center mb-5 pb-2.5 border-b-2 border-gray-200">
                <h2 class="text-2xl font-semibold">Latest Updates</h2>
                <a href="./public/latest_news.html" class="text-primary-blue font-medium hover:text-primary-red transition-colors">View All <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="space-y-4">
                <div class="flex py-4 border-b border-gray-200">
                    <div class="flex-1 pr-4">
                        <h4 class="font-medium mb-1">Stock market reaches all-time high despite global concerns</h4>
                        <p class="text-sm text-gray-600">10:30 AM | Business</p>
                    </div>
                    <img src="https://picsum.photos/120/80?random=5" alt="News Thumbnail" class="w-30 h-20 object-cover rounded">
                </div>
                <div class="flex py-4 border-b border-gray-200">
                    <div class="flex-1 pr-4">
                        <h4 class="font-medium mb-1">New education policy to be implemented next academic year</h4>
                        <p class="text-sm text-gray-600">9:15 AM | Education</p>
                    </div>
                    <img src="https://picsum.photos/120/80?random=6" alt="News Thumbnail" class="w-30 h-20 object-cover rounded">
                </div>
                <div class="flex py-4 border-b border-gray-200">
                    <div class="flex-1 pr-4">
                        <h4 class="font-medium mb-1">Health ministry issues new COVID-19 guidelines</h4>
                        <p class="text-sm text-gray-600">Yesterday</p>
                    </div>
                    <img src="https://picsum.photos/120/80?random=7" alt="News Thumbnail" class="w-30 h-20 object-cover rounded">
                </div>
            </div>
        </section>
</x-font-layout>