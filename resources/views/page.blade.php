<x-font-layout title="{{ $page->title ?? 'Welcome' }}" :pages="$pages ?? []" >
     <div class="my-6">
            <h1 class="text-3xl font-semibold mb-2">{{ $page->title }}</h1>
            <div class="text-sm text-gray-600">
                <a href="../index.html" class="hover:text-primary-red">Home</a> &raquo; <span>{{ $page->title }}</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Main Featured Article -->
                <article class="mb-8 border border-gray-200 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="https://picsum.photos/1200/600?random=101" alt="Featured News" class="w-full h-64 md:h-80 object-cover">
                        <span class="absolute bottom-2.5 left-2.5 bg-primary-red text-white px-3 py-1 rounded text-xs font-semibold uppercase">Top Story</span>
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-3">Breaking: Major Development in Today's Headline Story</h2>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <span class="flex items-center"><i class="far fa-user mr-1.5"></i> By John Doe</span>
                            <span class="flex items-center"><i class="far fa-clock mr-1.5"></i> 2 hours ago</span>
                            <span class="flex items-center"><i class="far fa-comment mr-1.5"></i> 24 Comments</span>
                        </div>
                        <p class="text-gray-700 mb-4">
                            In a significant turn of events, the latest developments have shaken the political landscape. 
                            Experts weigh in on what this means for the future of the region and its impact on global markets.
                        </p>
                        <a href="./article.html" class="inline-flex items-center text-primary-red font-medium hover:underline">Read Full Story <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </article>

                <!-- Latest News Grid -->
                <div class="grid sm:grid-cols-2 gap-6 mb-8">
                    <!-- News Card 1 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/225?random=201" alt="News 1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Politics</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">Government Announces New Economic Policy Reforms</h3>
                            <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 3 hours ago</span>
                                <span class="flex items-center"><i class="far fa-eye mr-1"></i> 1.2k Views</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">The new reforms aim to boost the economy and create more job opportunities in the coming fiscal year.</p>
                            <a href="#" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/225?random=202" alt="News 2" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-red text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Sports</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">National Team Secures Spot in Championship Finals</h3>
                            <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 5 hours ago</span>
                                <span class="flex items-center"><i class="far fa-eye mr-1"></i> 3.4k Views</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">In a thrilling match that went into overtime, our national team secured their place in the finals.</p>
                            <a href="#" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                        </div>
                    </div>

                    <!-- News Card 3 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/225?random=203" alt="News 3" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Technology</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">New Smartphone Breaks Sales Records Worldwide</h3>
                            <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 8 hours ago</span>
                                <span class="flex items-center"><i class="far fa-eye mr-1"></i> 2.1k Views</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">The latest flagship device has surpassed all expectations with its innovative features and design.</p>
                            <a href="#" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                        </div>
                    </div>

                    <!-- News Card 4 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/225?random=204" alt="News 4" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-red text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Health</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">Breakthrough in Medical Research Shows Promise</h3>
                            <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 10 hours ago</span>
                                <span class="flex items-center"><i class="far fa-eye mr-1"></i> 1.8k Views</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">Scientists have made significant progress in developing a new treatment for chronic conditions.</p>
                            <a href="#" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                        </div>
                    </div>

                    <!-- News Card 5 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/225?random=205" alt="News 5" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Business</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">Stock Market Reaches All-Time High</h3>
                            <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 12 hours ago</span>
                                <span class="flex items-center"><i class="far fa-eye mr-1"></i> 2.5k Views</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">Investors celebrate as the market surges to record levels despite global economic concerns.</p>
                            <a href="#" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                        </div>
                    </div>

                    <!-- News Card 6 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://picsum.photos/400/225?random=206" alt="News 6" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-red text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">Entertainment</span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">Award-Winning Film Director Announces New Project</h3>
                            <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 15 hours ago</span>
                                <span class="flex items-center"><i class="far fa-eye mr-1"></i> 3.1k Views</span>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">The acclaimed director returns with an ambitious new film featuring an all-star cast.</p>
                            <a href="#" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex gap-2 justify-center items-center mb-8">
                    <a href="#" class="px-4 py-2 bg-primary-red text-white rounded hover:bg-[#c41230] transition-colors">1</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">2</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">3</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">4</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">5</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors flex items-center gap-1">Next <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Popular Posts -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-5 pb-2.5 border-b-2 border-gray-200">Popular Posts</h3>
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <img src="https://picsum.photos/80/60?random=301" alt="Popular Post 1" class="w-20 h-15 object-cover rounded">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium mb-1 hover:text-primary-red"><a href="#">Top 10 Travel Destinations for 2024</a></h4>
                                <span class="text-xs text-gray-600">Jan 15, 2024</span>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <img src="https://picsum.photos/80/60?random=302" alt="Popular Post 2" class="w-20 h-15 object-cover rounded">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium mb-1 hover:text-primary-red"><a href="#">New Study Reveals Benefits of Mediterranean Diet</a></h4>
                                <span class="text-xs text-gray-600">Jan 14, 2024</span>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <img src="https://picsum.photos/80/60?random=303" alt="Popular Post 3" class="w-20 h-15 object-cover rounded">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium mb-1 hover:text-primary-red"><a href="#">Tech Giant Unveils Revolutionary New Product</a></h4>
                                <span class="text-xs text-gray-600">Jan 13, 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-5 pb-2.5 border-b-2 border-gray-200">Categories</h3>
                    <ul class="space-y-2">
                        <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">Politics</a> <span class="text-sm text-gray-600">24</span></li>
                        <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">Business</a> <span class="text-sm text-gray-600">18</span></li>
                        <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">Technology</a> <span class="text-sm text-gray-600">32</span></li>
                        <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">Sports</a> <span class="text-sm text-gray-600">15</span></li>
                        <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">Entertainment</a> <span class="text-sm text-gray-600">27</span></li>
                        <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">Health</a> <span class="text-sm text-gray-600">12</span></li>
                        <li class="flex justify-between items-center py-2"><a href="#" class="hover:text-primary-red transition-colors">Science</a> <span class="text-sm text-gray-600">9</span></li>
                    </ul>
                </div>

                <!-- Tags -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-5 pb-2.5 border-b-2 border-gray-200">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Breaking</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Latest</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Exclusive</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Trending</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Interview</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Analysis</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Opinion</a>
                        <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">#Report</a>
                    </div>
                </div>
            </aside>
        </div>
</x-font-layout>