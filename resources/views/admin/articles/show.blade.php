<x-font-layout title="{{ $article->title ?? 'Welcome' }}" :pages="$pages ?? []">
      <div class="max-w-3xl mx-auto py-5">
            <header class="mb-8">
                <span class="inline-block bg-primary-red text-white px-4 py-1.5 rounded text-sm mb-4">{{ $article->category->title }}</span>
                <h1 class="text-4xl md:text-5xl font-semibold mb-4 leading-tight text-gray-800">{{ $article->title }}</h1>
                <div class="flex flex-wrap items-center gap-5 text-sm text-gray-500 mb-5 pb-4 border-b border-gray-200">
                    <span class="flex items-center"><i class="far fa-user mr-1.5"></i> {{ $article->author->name }}</span>
                    <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5"></i> {{ $article->published_at }}</span>
                    <span class="flex items-center"><i class="far fa-clock mr-1.5"></i> 5 min read</span>
                    <span class="flex items-center"><i class="far fa-comment mr-1.5"></i> 24 Comments</span>
                    <span class="flex items-center"><i class="fas fa-share-alt mr-1.5"></i> Share</span>
                </div>
            </header>
            
            <img src="{{ isset($article->featured_image_url)? $article->featured_image_url : $article->featured_image }}" alt="AI Technology" class="w-full h-[450px] md:h-[450px] object-cover rounded-lg mb-5">
            
            <div class="text-lg leading-relaxed text-gray-800">
                <p class="mb-5">{{$article->excerpt}}</p>
                 
                
                
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! $article->content !!}
                </div>

            </div>

            
            <div class="flex flex-wrap gap-2.5 my-8 py-4 border-t border-b border-gray-200">
                
               @if($article->tags)
                @foreach($article->tags as $tag)
                <a href="#" class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-600 hover:bg-gray-200 hover:text-gray-800 transition-all">#{{ $tag->title }}</a>
                @endforeach
                @endif
            </div>
            
            <div class="flex items-center bg-gray-100 p-5 rounded-lg my-8">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Author" class="w-20 h-20 rounded-full mr-5 object-cover">
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-1">{{ $article->author->name }}</h4>
                    <span class="text-sm text-gray-600 block mb-2.5">Senior Technology Writer</span>
                    <p class="text-sm text-gray-600 leading-relaxed">John is a technology journalist with over 10 years of experience covering the latest developments in AI, robotics, and emerging technologies. His work has been featured in major tech publications worldwide.</p>
                </div>
            </div>
            
            <div class="mt-12">
                <h3 class="text-2xl font-semibold mb-5 pb-2.5 border-b-2 border-primary-red inline-block">You May Also Like</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-5">
                    <article class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <img src="https://picsum.photos/400/225?random=301" alt="Related Article" class="w-full h-36 object-cover">
                        <div class="p-4">
                            <span class="text-xs text-primary-red uppercase font-bold block mb-1">Technology</span>
                            <h4 class="text-base font-medium mb-2.5 leading-snug">How Machine Learning is Changing the Face of Modern Business</h4>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span><i class="far fa-calendar mr-1"></i> Jan 18, 2025</span>
                                <span><i class="far fa-clock mr-1"></i> 4 min read</span>
                            </div>
                        </div>
                    </article>
                    
                    <article class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <img src="https://picsum.photos/400/225?random=302" alt="Related Article" class="w-full h-36 object-cover">
                        <div class="p-4">
                            <span class="text-xs text-primary-red uppercase font-bold block mb-1">Innovation</span>
                            <h4 class="text-base font-medium mb-2.5 leading-snug">The Top 5 AI Breakthroughs of 2024 That Will Shape Our Future</h4>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span><i class="far fa-calendar mr-1"></i> Jan 15, 2025</span>
                                <span><i class="far fa-clock mr-1"></i> 6 min read</span>
                            </div>
                        </div>
                    </article>
                    
                    <article class="border border-gray-200 rounded-lg overflow-hidden hover:-translate-y-1 hover:shadow-lg transition-all">
                        <img src="https://picsum.photos/400/225?random=303" alt="Related Article" class="w-full h-36 object-cover">
                        <div class="p-4">
                            <span class="text-xs text-primary-red uppercase font-bold block mb-1">Business</span>
                            <h4 class="text-base font-medium mb-2.5 leading-snug">How Companies Are Using AI to Improve Customer Experience</h4>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span><i class="far fa-calendar mr-1"></i> Jan 12, 2025</span>
                                <span><i class="far fa-clock mr-1"></i> 5 min read</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
</x-font-layout>