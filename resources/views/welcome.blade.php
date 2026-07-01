<x-font-layout title="Home" :pages="$pages ?? []">
        <!-- Breaking News Ticker -->
        <div class="bg-gray-100 py-2 my-4 border-l-4 border-primary-red flex items-center">
            <span class="bg-primary-red text-white px-3 py-0.5 mr-4 font-semibold uppercase text-xs whitespace-nowrap">{{ __('Breaking:') }}</span>
            <div class="flex-1 overflow-hidden h-6 ticker">
                <ul class="list-none">
                    @foreach($articles->take(10) as $article)
                        <li class="font-medium h-6 flex items-center">
                            <a href="{{ url('/article/' . $article->slug) }}" class="hover:text-primary-red truncate">{{ $article->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Main Headline -->
        @if($top_story)
        <section class="grid md:grid-cols-2 gap-8 my-8">
            <div class="py-5">
                <span class="inline-block bg-primary-red text-white px-3 py-1 rounded text-xs font-semibold uppercase mb-4">{{ $top_story->category->title ?? __('TOP STORY') }}</span>
                <h1 class="text-3xl md:text-4xl font-semibold mb-4 leading-tight">
                    <a href="{{ url('/article/' . $top_story->slug) }}" class="hover:text-primary-red transition-colors" @if(app()->getLocale()=='bn') style='line-height:1.3' @endif>
                        {{ $top_story->title }}
                    </a>
                </h1>
                <p class="text-lg text-gray-800 my-4">{{ $top_story->excerpt ?? Str::limit(strip_tags($top_story->content), 150) }}</p>
                <div class="flex items-center text-sm text-gray-600 space-x-4">
                    <span>By {{ $top_story->manualAuthor->name ?? ($top_story->author->name ?? 'Author') }}</span>
                    <span>|</span>
                    <span>{{ $top_story->created_at->diffForHumans() }}</span>
                    <span>|</span>
                    <a href="{{ url('/article/' . $top_story->slug) }}" class="text-primary-red font-semibold hover:underline">{{ __('Read More') }}</a>
                </div>
            </div>
            <div>
                <a href="{{ url('/article/' . $top_story->slug) }}">
                    <img src="{{ $top_story->featured_image ? asset('storage/' . $top_story->featured_image) : 'https://picsum.photos/800/450?random=1' }}" alt="{{ $top_story->title }}" class="w-full h-auto rounded-lg shadow-lg hover:opacity-90 transition-opacity" @if(app()->getLocale()=='bn') style='min-height:300px;object-fit:cover;' @endif>
                </a>
            </div>
        </section>
        @endif

        <!-- News Grid -->
        <section class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 my-10">
            @foreach($latest_articles->take(3) as $article)
            <a href="{{ url('/article/' . $article->slug) }}" class="group border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://picsum.photos/400/225?random=' . $loop->index }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <span class="absolute bottom-2.5 left-2.5 bg-primary-blue text-white px-2.5 py-1 rounded text-xs font-semibold uppercase" @if(app()->getLocale()=='bn') style='font-family: Hind Siliguri, sans-serif;' @endif>{{ $article->category->title ?? 'News' }}</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2 group-hover:text-primary-red transition-colors line-clamp-2" @if(app()->getLocale()=='bn') style='font-family: Hind Siliguri, sans-serif;' @endif>{{ $article->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $article->created_at->diffForHumans() }}</p>
                </div>
            </a>
            @endforeach
        </section>

        <!-- More News Section -->
        <section class="my-12">
            <div class="flex justify-between items-center mb-5 pb-2.5 border-b-2 border-gray-200">
                <h2 class="text-2xl font-semibold">{{ __('Latest Updates') }}</h2>
                <a href="#" class="text-primary-blue font-medium hover:text-primary-red transition-colors">{{ __('View All') }} <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="space-y-4">
                @foreach($latest_articles->skip(3)->take(10) as $article)
                <div class="flex py-4 border-b border-gray-200 hover:bg-gray-50 transition-colors">
                    <div class="flex-1 pr-4">
                        <h4 class="font-medium mb-1 line-clamp-2">
                            <a href="{{ url('/article/' . $article->slug) }}" class="hover:text-primary-red transition-colors" @if(app()->getLocale()=='bn') style='font-family: Hind Siliguri, sans-serif;' @endif>
                                {{ $article->title }}
                            </a>
                        </h4>
                        <div class="flex items-center text-xs text-gray-500 space-x-2">
                            <span>{{ $article->created_at->format('h:i A') }}</span>
                            <span>•</span>
                            <span class="uppercase font-semibold text-primary-blue">{{ $article->category->title ?? 'News' }}</span>
                        </div>
                    </div>
                    <a href="{{ url('/article/' . $article->slug) }}" class="flex-shrink-0">
                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://picsum.photos/120/80?random=' . ($loop->index + 10) }}" alt="{{ $article->title }}" class="w-32 h-20 object-cover rounded shadow-sm">
                    </a>
                </div>
                @endforeach
            </div>
        </section>
</x-font-layout>