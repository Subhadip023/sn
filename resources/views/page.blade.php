<x-font-layout title="{{ $page->title ?? 'Welcome' }}" :pages="$pages ?? []" >
     <div class="my-6">
            <h1 class="text-3xl font-semibold mb-2">{{ $page->title }}</h1>
            <div class="text-sm text-gray-600">
                <a href="../index.html" class="hover:text-primary-red">Home</a> &raquo; <span>{{ $page->title }}</span>
            </div>
        </div>

        @if($page->hide_articles)
            <!-- Full Width Content (no articles/sidebar) -->
            @if(!empty($page->content))
            <div class=" p-8  leading-relaxed text-gray-800 text-base prose max-w-none mb-8">
                {!! $page->content !!}
            </div>
            @endif
        @else
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if(!empty($page->content))
                    <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm leading-relaxed text-gray-800 text-base prose max-w-none mb-6">
                        {!! $page->content !!}
                    </div>
                    @endif
                    <!-- Main Featured Article -->
                    @if(isset($top_story) && $top_story)
                    <article class="mb-8 border border-gray-200 rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="{{ $top_story->featured_image_url ?? "https://via.placeholder.com/150"}}" alt="Featured News" class="w-full h-64 md:h-80 object-cover">
                            <span class="absolute bottom-2.5 left-2.5 bg-primary-red text-white px-3 py-1 rounded text-xs font-semibold uppercase">Top Story</span>
                        </div>
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-3">{{ $top_story->title }}</h2>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                                <span class="flex items-center"><i class="far fa-user mr-1.5"></i> {{ optional($top_story->author)->name ?? 'Unknown' }}</span>
                                <span class="flex items-center"><i class="far fa-clock mr-1.5"></i> {{ optional($top_story->created_at)->diffForHumans() }}</span>
                                <span class="flex items-center"><i class="far fa-comment mr-1.5"></i> 24 Comments</span>
                            </div>
                            <p class="text-gray-700 mb-4">
                                {{ $top_story->excerpt }}
                            </p>
                            <a href="{{ route('articles.show', $top_story->slug) }}" class="inline-flex items-center text-primary-red font-medium hover:underline">Read Full Story <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                    </article>
                    @endif
                    <!-- Latest News Grid -->
                    <div class="grid sm:grid-cols-2 gap-6 mb-8">
                        @foreach($articles as $article)
                        <!-- News Card -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $article->featured_image_url ?? 'https://via.placeholder.com/400x225' }}" alt="{{ $article->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                @if($article->category)
                                <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase">{{ $article->category->title }}</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">{{ $article->title }}</h3>
                                <div class="flex gap-4 text-sm text-gray-600 mb-2">
                                    <span class="flex items-center"><i class="far fa-clock mr-1"></i> {{ optional($article->created_at)->diffForHumans() ?? 'Just now' }}</span>
                                    <span class="flex items-center"><i class="far fa-eye mr-1"></i> {{ $article->views ?? 0 }} Views</span>
                                </div>
                                <p class="text-sm text-gray-700 mb-3">{{ Str::limit($article->excerpt, 100) }}</p>
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-primary-red font-medium hover:underline text-sm">Read More</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mb-8">
                        {{ $articles->links('vendor.pagination.custom') }}
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <!-- Popular Posts -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-5 pb-2.5 border-b-2 border-gray-200">Popular Posts</h3>
                        <div class="space-y-4">
                            @isset($most_populer_posts)
                            @foreach($most_populer_posts as $post)
                            <div class="flex gap-3">
                                <div class="flex-shrink-0">
                                    <img src="{{$post->featured_image_url}}" alt="Popular Post 1" class="w-20 h-15 object-cover rounded">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium mb-1 hover:text-primary-red"><a href="{{route('articles.show', $post->slug)}}">{{$post->title}}</a></h4>
                                    <span class="text-xs text-gray-600">{{ optional($post->created_at)->diffForHumans() ?? 'Just now' }}</span>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-5 pb-2.5 border-b-2 border-gray-200">Categories</h3>
                        <ul class="space-y-2">
                            @isset($page->categories)
                            @foreach($page->categories as $category)
                            <li class="flex justify-between items-center py-2 border-b border-gray-100"><a href="#" class="hover:text-primary-red transition-colors">{{ $category->title }}</a> <span class="text-sm text-gray-600">{{ $category->articles->count() ?? 0 }}</span></li>
                            @endforeach
                            @endisset
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-5 pb-2.5 border-b-2 border-gray-200">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @isset($page->tags)
                            @foreach($page->tags as $tag)
                            <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-primary-red hover:text-white transition-colors">{{ $tag->title }}</a>
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </aside>
            </div>
        @endif
</x-font-layout>