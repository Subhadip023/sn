<x-font-layout title="{{ $article->title ?? 'Welcome' }}" :pages="$pages ?? []" :meta="$meta ?? []">
      <div class="max-w-3xl mx-auto py-5">
            <header class="mb-8">
                <span class="inline-block bg-primary-red text-white px-4 py-1.5 rounded text-sm mb-4">{{ $article->category->title }}</span>
                <h1 class="text-4xl md:text-5xl font-semibold mb-4 leading-tight text-gray-800" @if(app()->getLocale()=='bn') style='line-height:1.3' @endif >{{ $article->title }}</h1>
                <div class="flex flex-wrap items-center gap-5 text-sm text-gray-500 mb-5 pb-4 border-b border-gray-200">
                    <span class="flex items-center gap-1.5">
                        @if($article->author->profile_image)
                            <img src="{{ asset('storage/' . $article->author->profile_image) }}" alt="{{ $article->author->name }}" class="w-5 h-5 rounded-full object-cover border border-gray-300 shrink-0">
                        @else
                            <span class="w-5 h-5 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center text-xs font-bold uppercase shrink-0">{{ substr($article->author->name, 0, 1) }}</span>
                        @endif
                        {{ $article->author->name }}
                    </span>
                    <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5"></i> {{ ($article->published_at ?? $article->created_at)->format('M d, Y') }}</span>
                    <span class="flex items-center"><i class="far fa-clock mr-1.5"></i>{{
                         $article->created_at->diffForHumans() }} </span>
                    <span class="flex items-center"><i class="far fa-eye mr-1.5"></i> {{ $article->views }}</span>
                    <div class="relative inline-block text-left" id="shareContainer">
                        <button type="button" onclick="toggleShareMenu()" class="flex items-center hover:text-primary-red transition-colors">
                            <i class="fas fa-share-alt mr-1.5"></i> Share
                        </button>
                        
                        <!-- Share Dropdown Menu -->
                        <div id="shareMenu" class="hidden absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1" role="menu" aria-orientation="vertical">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fab fa-facebook-f mr-3 text-blue-600"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fab fa-twitter mr-3 text-blue-400"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i class="fab fa-whatsapp mr-3 text-green-500"></i> WhatsApp
                                </a>
                                <button onclick="copyToClipboard()" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left" role="menuitem">
                                    <i class="fas fa-link mr-3 text-gray-500"></i> <span id="copyText">Copy Link</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <img src="{{ isset($article->featured_image_url)? $article->featured_image_url : $article->featured_image }}" alt="AI Technology" class="w-full h-[450px] md:h-[450px] object-cover rounded-lg mb-5">
            
            <div class="text-lg leading-relaxed text-gray-800">
                <p class="mb-5">{{$article->excerpt}}</p>
                 
                
                
                <style>
                    .article-content iframe {
                        width: 100% !important;
                        height: auto !important;
                        aspect-ratio: 16 / 9;
                        display: block;
                        border-radius: 0.5rem;
                        margin: 1rem 0;
                    }
                </style>
                <div class="article-content prose prose-lg max-w-none text-gray-800">
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
                @if($article->author->profile_image)
                    <img src="{{ asset('storage/' . $article->author->profile_image) }}" alt="{{ $article->author->name }}" class="w-20 h-20 rounded-full mr-5 object-cover border border-gray-200 shrink-0">
                @else
                    <div class="w-20 h-20 rounded-full mr-5 bg-gray-200 text-gray-700 flex items-center justify-center font-bold text-2xl uppercase border border-gray-300 shrink-0">
                        {{ substr($article->author->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-1">{{ $article->author->name }}</h4>
                    <span class="text-sm text-gray-600 block mb-2.5 capitalize">{{ $article->author->position ?: (all_roles()[$article->author->role] ?? 'Author') }}</span>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $article->author->short_desc ?: 'This author has not provided a short description yet.' }}</p>
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

        <script>
            window.toggleShareMenu = function() {
                const menu = document.getElementById('shareMenu');
                if (!menu) return;
                
                menu.classList.toggle('hidden');
                
                // If Web Share API is available, try it first for a better mobile experience
                if (navigator.share && !menu.classList.contains('hidden')) {
                    navigator.share({
                        title: {!! json_encode($article->title) !!},
                        text: {!! json_encode($article->excerpt) !!},
                        url: window.location.href,
                    }).then(() => {
                        menu.classList.add('hidden');
                    }).catch((error) => {
                        console.log('Error sharing:', error);
                    });
                }
            };

            window.copyToClipboard = function() {
                const url = window.location.href;
                
                const handleCopySuccess = () => {
                    const copyText = document.getElementById('copyText');
                    if (!copyText) return;
                    
                    const originalText = copyText.innerText;
                    copyText.innerText = 'Copied!';
                    copyText.classList.add('text-green-600');
                    
                    setTimeout(() => {
                        copyText.innerText = originalText;
                        copyText.classList.remove('text-green-600');
                        const menu = document.getElementById('shareMenu');
                        if (menu) menu.classList.add('hidden');
                    }, 2000);
                };

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(handleCopySuccess).catch(err => {
                        console.error('Failed to copy: ', err);
                        fallbackCopyTextToClipboard(url, handleCopySuccess);
                    });
                } else {
                    fallbackCopyTextToClipboard(url, handleCopySuccess);
                }
            };

            function fallbackCopyTextToClipboard(text, callback) {
                const textArea = document.createElement("textarea");
                textArea.value = text;
                
                // Ensure it's not visible
                textArea.style.position = "fixed";
                textArea.style.left = "-9999px";
                textArea.style.top = "0";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    const successful = document.execCommand('copy');
                    if (successful && callback) callback();
                } catch (err) {
                    console.error('Fallback copy failed', err);
                }

                document.body.removeChild(textArea);
            }

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const container = document.getElementById('shareContainer');
                const menu = document.getElementById('shareMenu');
                if (container && menu && !container.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
</x-font-layout>