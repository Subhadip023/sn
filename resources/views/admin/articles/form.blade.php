@php
    $article = $article ?? null;
    $isEdit = $article && $article->exists;
    $title = $isEdit ? 'Edit Article' : 'Create Article';
    $action = $isEdit ? route('articles.update', $article) : route('articles.store');
@endphp

<x-admin-layout :title="$title">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">{{ $title }}</h1>
    </header>

    <form id="article-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Main Details -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <div class="space-y-1">
                        <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="Enter article title" required value="{{ old('title', $article?->title) }}">
                        @error('title') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                        <input type="text" name="slug" id="slug" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="auto-generated" value="{{ old('slug', $article?->slug) }}">
                        <p class="text-xs text-slate-500">Leave empty to auto-generate.</p>
                        @error('slug') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="excerpt" class="block text-sm font-medium text-slate-700">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="Short summary...">{{ old('excerpt', $article?->excerpt) }}</textarea>
                        @error('excerpt') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">
                            Content <span class="text-rose-500">*</span>
                        </label>

                        <div id="editor" style="height: 200px;" class="bg-white rounded-b-lg border border-slate-300 border-t-0">
                            {!! old('content', $article?->content) !!}
                        </div>

                        <input type="hidden" name="content" id="content">

                        @error('content')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                <!-- YouTube Embed -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-500" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        YouTube Video
                    </h3>

                    <div class="space-y-2">
                        <label for="video_url_input" class="block text-sm font-medium text-slate-700">Paste YouTube URL or Embed Link</label>
                        <input
                            type="text"
                            id="video_url_input"
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none transition-colors"
                            placeholder="https://www.youtube.com/watch?v=..."
                            value="{{ old('video_url', $article?->video_url) }}"
                        >
                        <input type="hidden" name="video_url" id="video_url" value="{{ old('video_url', $article?->video_url) }}">
                        @error('video_url') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Preview + Insert Button -->
                    <div id="yt_preview_wrapper" class="hidden space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Preview</p>
                            <div class="flex items-center gap-2">
                                <button type="button" id="yt_insert_btn"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-brand-500 hover:bg-brand-400 text-white text-xs font-semibold transition-colors shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Insert into Content
                                </button>
                                <button type="button" id="yt_clear_btn" class="text-xs text-rose-400 hover:text-rose-600 transition-colors">&times; Remove</button>
                            </div>
                        </div>
                        <div class="relative w-full rounded-lg overflow-hidden bg-black" style="padding-top: 56.25%;">
                            <iframe
                                id="yt_preview_iframe"
                                class="absolute inset-0 w-full h-full"
                                src=""
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen
                            ></iframe>
                        </div>
                        <!-- Inserted confirmation toast -->
                        <p id="yt_inserted_msg" class="hidden text-xs text-emerald-600 font-medium">&#10003; Embed inserted into content!</p>
                    </div>

                    <p id="yt_invalid_msg" class="hidden text-xs text-rose-500">Could not parse a valid YouTube URL. Try a standard watch or embed link.</p>
                </section>

                <!-- SEO Section -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">SEO Configuration</h3>

                    <div class="space-y-1">
                        <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('meta_title', $article?->meta_title) }}">
                    </div>

                    <div class="space-y-1">
                        <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">{{ old('meta_description', $article?->meta_description) }}</textarea>
                    </div>

                    <div class="space-y-1">
                        <label for="meta_keywords" class="block text-sm font-medium text-slate-700">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="comma, separated, keywords" value="{{ old('meta_keywords', $article?->meta_keywords) }}">
                    </div>

                    <div class="space-y-1">
                        <label for="canonical_url" class="block text-sm font-medium text-slate-700">Canonical URL</label>
                        <input type="url" name="canonical_url" id="canonical_url" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('canonical_url', $article?->canonical_url) }}">
                    </div>
                </section>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Publish / Status -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">Publish</h3>
                    <div class="space-y-1">
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        @if(auth()->user()->role === 3)
                            <span class="block px-3 py-2 bg-slate-100 border border-slate-200 rounded-lg text-slate-600 text-sm">Draft (Pending Review)</span>
                            <input type="hidden" name="status" value="draft">
                        @else
                            <select name="status" id="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                                <option value="draft" {{ old('status', $article?->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $article?->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <label for="published_at" class="block text-sm font-medium text-slate-700">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('published_at', $article?->published_at ? ($article->published_at instanceof \Carbon\Carbon ? $article->published_at->format('Y-m-d\TH:i') : $article->published_at) : '') }}">
                        @error('published_at') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="lang" class="block text-sm font-medium text-slate-700">Language <span class="text-rose-500">*</span></label>
                        <select name="lang" id="lang" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required>
                            @foreach(languages() as $code => $name)
                                <option value="{{ $code }}" {{ old('lang', $article?->lang) == $code ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('lang') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold">Save Article</button>
                    <a href="{{ route('articles.index') }}" class="block text-center w-full px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold">Cancel</a>
                </section>

                <!-- Classification -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">Classification</h3>

                    <!-- Category Selection -->
                    <div class="space-y-1">
                        <label for="category_id" class="block text-sm font-medium text-slate-700">Category <span class="text-rose-500">*</span></label>
                        
                        <!-- Selected Category Display -->
                        <div id="selected_category_display" class="mb-2 min-h-[42px] p-2 rounded-lg border border-slate-200 bg-slate-50 flex flex-wrap gap-2">
                            @if(old('category_id', $article?->category_id))
                                @php $oldCat = $categories->find(old('category_id', $article?->category_id)); @endphp
                                @if($oldCat)
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-100 text-brand-700 text-sm font-medium">
                                        {{ $oldCat->title }}
                                        <button type="button" class="remove-category-btn hover:bg-brand-200 rounded-full p-0.5 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </span>
                                @endif
                            @else
                                <span class="text-xs text-slate-400 italic empty-message">No category selected</span>
                            @endif
                        </div>

                        <!-- Category Search -->
                        <div class="relative mb-2">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="search" id="category_search_input" placeholder="Search categories..." class="w-full rounded-lg border border-slate-300 bg-white pl-10 pr-4 py-2 text-sm text-slate-900 focus:border-brand-500 focus:outline-none transition-all">
                        </div>

                        <!-- Category Results -->
                        <div id="category_search_results" class="space-y-1 max-h-40 overflow-y-auto hidden"></div>
                        
                        <input type="hidden" name="category_id" id="category_id_hidden" value="{{ old('category_id', $article?->category_id) }}" required>
                        @error('category_id') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tags Selection -->
                    <div class="space-y-1 pt-4 border-t border-slate-100">
                        <label class="block text-sm font-medium text-slate-700">Tags</label>
                        
                        <!-- Selected Tags Display -->
                        <div id="selected_tags_display" class="mb-2 min-h-[42px] p-2 rounded-lg border border-slate-200 bg-slate-50 flex flex-wrap gap-2">
                            @php
                                $oldTagIds = old('tags', $article?->tags ? $article->tags->pluck('id')->toArray() : []);
                            @endphp
                            @if(!empty($oldTagIds))
                                @foreach($oldTagIds as $tagId)
                                    @php $tag = $tags->find($tagId); @endphp
                                    @if($tag)
                                        <span class="selected-tag-badge inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-200 text-slate-700 text-sm font-medium" data-id="{{ $tag->id }}">
                                            {{ $tag->title }}
                                            <button type="button" class="remove-tag-btn hover:bg-slate-300 rounded-full p-0.5 transition-colors" data-id="{{ $tag->id }}">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </span>
                                        <input type="hidden" name="tags[]" value="{{ $tag->id }}">
                                    @endif
                                @endforeach
                            @else
                                <span class="text-xs text-slate-400 italic empty-message">No tags selected</span>
                            @endif
                        </div>

                        <!-- Tag Search -->
                        <div class="relative mb-2">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="search" id="tag_search_input" placeholder="Search tags..." class="w-full rounded-lg border border-slate-300 bg-white pl-10 pr-4 py-2 text-sm text-slate-900 focus:border-brand-500 focus:outline-none transition-all">
                        </div>

                        <!-- Tag Results -->
                        <div id="tag_search_results" class="space-y-1 max-h-40 overflow-y-auto hidden"></div>
                    </div>
                </section>

                <!-- Manual Author -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-slate-900">Manual Author</h3>
                        <button type="button" id="open_author_modal_btn"
                                class="inline-flex items-center gap-1 text-xs font-semibold text-brand-600 hover:text-brand-800 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            New Author
                        </button>
                    </div>
                    <label class="block space-y-2">
                        <span class="text-sm font-medium text-slate-700">Display Author</span>
                        <select name="manual_author_id" id="manual_author_id"
                                class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none text-sm">
                            <option value="">— None (use system author) —</option>
                            @foreach($manualAuthors as $ma)
                                <option value="{{ $ma->id }}" {{ old('manual_author_id', $article?->manual_author_id) == $ma->id ? 'selected' : '' }}>
                                    {{ $ma->name }}{{ $ma->position ? ' · ' . $ma->position : '' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-slate-500">Public author shown on the article page.</p>
                        @error('manual_author_id') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </label>
                </section>

                {{-- ── Quick-Create Manual Author Modal ─────────────────── --}}
                {{-- ── Quick-Create Manual Author Modal ─────────────────── --}}
                <x-ui.modal id="author_modal_overlay" title="New Manual Author">
                    {{-- Error container --}}
                    <div id="author_modal_errors" class="hidden rounded-lg bg-rose-50 border border-rose-200 px-4 py-3 text-rose-700 text-sm space-y-1"></div>

                    {{-- Avatar + Upload --}}
                    <div class="flex items-center gap-4 py-2 bg-white">
                        <div id="ma_avatar_preview"
                             class="w-16 h-16 rounded-full bg-slate-200 border-2 border-slate-300 flex items-center justify-center overflow-hidden shrink-0">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 space-y-2">
                            <label for="ma_image"
                                   class="inline-flex items-center gap-1.5 cursor-pointer px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-xs text-slate-700 font-semibold transition-colors">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Upload Photo
                            </label>
                            <input type="file" id="ma_image" accept="image/*" class="hidden">
                            <input type="url" id="ma_image_url" placeholder="Or paste image URL..."
                                   class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none text-sm">
                        </div>
                    </div>

                    {{-- Name --}}
                    <label class="block space-y-2">
                        <span class="text-sm font-medium text-slate-700">Name <span class="text-rose-500">*</span></span>
                        <input type="text" id="ma_name" placeholder="Full name" required
                               class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none">
                    </label>

                    {{-- Position + Status side by side --}}
                    <div class="grid grid-cols-2 gap-4">
                        <label class="block space-y-2">
                            <span class="text-sm font-medium text-slate-700">Position</span>
                            <input type="text" id="ma_position" placeholder="e.g. Reporter"
                                   class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none">
                        </label>
                        <label class="block space-y-2">
                            <span class="text-sm font-medium text-slate-700">Status</span>
                            <select id="ma_status" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </label>
                    </div>

                    {{-- Bio --}}
                    <label class="block space-y-2">
                        <span class="text-sm font-medium text-slate-700">Bio</span>
                        <textarea id="ma_description" rows="3" placeholder="Short author biography..."
                                  class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"></textarea>
                    </label>

                    {{-- Footer --}}
                    <div class="flex justify-end gap-2 border-t pt-3">
                        <button type="button" class="close-modal-btn px-4 py-2 border rounded-lg hover:bg-slate-50 text-slate-700 font-semibold" data-modal="author_modal_overlay">
                            Cancel
                        </button>
                        <button type="button" id="save_author_btn" class="px-4 py-2 bg-brand-600 hover:bg-brand-500 text-white rounded-lg font-semibold flex items-center justify-center gap-2">
                            <span id="save_author_label">Create Author</span>
                            <svg id="save_author_spinner" class="hidden animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                            </svg>
                        </button>
                    </div>
                </x-ui.modal>
                {{-- ─────────────────────────────────────────────────────── --}}

                <!-- Featured Image -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">Featured Image</h3>
                    <div class="space-y-1">
                        <input type="file" name="featured_image" id="featured_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        @error('featured_image') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>

                <!-- Featured Image url -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">Featured Image URL</h3>
                    <div class="space-y-1">
                        <input type="text" name="featured_image_url" id="featured_image_url" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('featured_image_url', $article?->featured_image_url) }}" placeholder="https://example.com/image.jpg">

                        @error('featured_image_url') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>

                <!-- OG Image -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">OG Image</h3>
                    <div class="space-y-1">
                        <label for="og_image" class="block text-sm font-medium text-slate-700">OG Image File</label>
                        <input type="file" name="og_image" id="og_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        @error('og_image') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="og_image_url" class="block text-sm font-medium text-slate-700">OG Image URL</label>
                        <input type="text" name="og_image_url" id="og_image_url" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="https://example.com/image.jpg" value="{{ old('og_image_url', $article?->og_image_url) }}">
                        @error('og_image_url') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>

            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Quill === 'undefined') {
                console.error('Quill is not defined. Make sure the library is loaded.');
                return;
            }

            var quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Write your article here...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            // Copy HTML into hidden input before submit
            var form = document.getElementById('article-form');
            form.addEventListener('submit', function(e) {
                var contentInput = document.getElementById('content');
                var html = quill.root.innerHTML;
                // Treat Quill's empty state as truly empty
                if (html === '<p><br></p>') html = '';
                if (contentInput) contentInput.value = html;
            });

            // Category Search Logic
            let catSearchTimeout = null;
            $(document).on('keyup', '#category_search_input', function() {
                let query = $(this).val();
                if(catSearchTimeout) clearTimeout(catSearchTimeout);
                if(query.length === 0) {
                    $('#category_search_results').addClass('hidden').empty();
                    return;
                }
                catSearchTimeout = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('categories.search') }}",
                        method: 'POST',
                        data: { query: query, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if(response.success) {
                                let html = '';
                                response.data.forEach(item => {
                                    html += `<button type="button" class="category-result-btn w-full text-left px-3 py-2 rounded-lg border border-slate-200 bg-white hover:bg-brand-50 transition-all outline-none text-sm" data-id="${item.id}" data-title="${item.title}">${item.title}</button>`;
                                });
                                $('#category_search_results').html(html).removeClass('hidden');
                            }
                        }
                    });
                }, 300);
            });

            $(document).on('click', '.category-result-btn', function() {
                let id = $(this).data('id');
                let title = $(this).data('title');
                $('#category_id_hidden').val(id);
                $('#selected_category_display').html(`
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-100 text-brand-700 text-sm font-medium">
                        ${title}
                        <button type="button" class="remove-category-btn hover:bg-brand-200 rounded-full p-0.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                `);
                $('#category_search_input').val('');
                $('#category_search_results').addClass('hidden').empty();
            });

            $(document).on('click', '.remove-category-btn', function() {
                $('#category_id_hidden').val('');
                $('#selected_category_display').html('<span class="text-xs text-slate-400 italic empty-message">No category selected</span>');
            });

            // Tags Search Logic
            let tagSearchTimeout = null;
            let selectedTags = new Set();
            
            // Populate initial tags
            $('.selected-tag-badge').each(function() {
                selectedTags.add(parseInt($(this).data('id')));
            });

            $(document).on('keyup', '#tag_search_input', function() {
                let query = $(this).val();
                if(tagSearchTimeout) clearTimeout(tagSearchTimeout);
                if(query.length === 0) {
                    $('#tag_search_results').addClass('hidden').empty();
                    return;
                }
                tagSearchTimeout = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('tags.search') }}",
                        method: 'POST',
                        data: { query: query, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if(response.success) {
                                let html = '';
                                response.data.forEach(item => {
                                    // Don't show already selected tags in search results
                                    if(!selectedTags.has(item.id)) {
                                        html += `<button type="button" class="tag-result-btn w-full text-left px-3 py-2 rounded-lg border border-slate-200 bg-white hover:bg-brand-50 transition-all outline-none text-sm" data-id="${item.id}" data-title="${item.title}">${item.title}</button>`;
                                    }
                                });
                                $('#tag_search_results').html(html).removeClass('hidden');
                            }
                        }
                    });
                }, 300);
            });

            $(document).on('click', '.tag-result-btn', function() {
                let id = parseInt($(this).data('id'));
                let title = $(this).data('title');
                
                selectedTags.add(id);
                
                // Remove empty message if it exists
                $('#selected_tags_display').find('.empty-message').remove();
                
                $('#selected_tags_display').append(`
                    <span class="selected-tag-badge inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-200 text-slate-700 text-sm font-medium" data-id="${id}">
                        ${title}
                        <button type="button" class="remove-tag-btn hover:bg-slate-300 rounded-full p-0.5 transition-colors" data-id="${id}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                    <input type="hidden" name="tags[]" value="${id}">
                `);
                
                $('#tag_search_input').val('');
                $('#tag_search_results').addClass('hidden').empty();
            });

            $(document).on('click', '.remove-tag-btn', function() {
                let id = parseInt($(this).data('id'));
                selectedTags.delete(id);
                $(`.selected-tag-badge[data-id="${id}"]`).remove();
                $(`input[name="tags[]"][value="${id}"]`).remove();
                
                if(selectedTags.size === 0) {
                    $('#selected_tags_display').html('<span class="text-xs text-slate-400 italic empty-message">No tags selected</span>');
                }
            });

            // ── YouTube Embed Feature Logic ───────────────────────────────
            let currentVideoId = null;

            function extractVideoId(url) {
                if (!url) return null;
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                const match = url.match(regExp);
                return (match && match[2].length === 11) ? match[2] : null;
            }

            function applyYouTubeUrl(url) {
                const videoId = extractVideoId(url);
                const $preview = $('#yt_preview_wrapper');
                const $iframe = $('#yt_preview_iframe');
                const $hidden = $('#video_url');
                const $invalid = $('#yt_invalid_msg');

                if (videoId) {
                    currentVideoId = videoId;
                    $preview.removeClass('hidden');
                    $iframe.attr('src', `https://www.youtube.com/embed/${videoId}`);
                    $hidden.val(`https://www.youtube.com/watch?v=${videoId}`);
                    $invalid.addClass('hidden');
                } else {
                    currentVideoId = null;
                    $preview.addClass('hidden');
                    $iframe.attr('src', '');
                    $hidden.val('');
                    if (url.trim().length > 0) {
                        $invalid.removeClass('hidden');
                    } else {
                        $invalid.addClass('hidden');
                    }
                }
            }

            // Restore preview on page load from saved value
            const $ytInput = $('#video_url_input');
            if ($ytInput.val()) {
                applyYouTubeUrl($ytInput.val());
            }

            $ytInput.on('input paste', function() {
                // Use setTimeout so paste event has time to fill the value
                setTimeout(() => applyYouTubeUrl($(this).val()), 50);
            });

            $('#yt_clear_btn').on('click', function() {
                $ytInput.val('');
                applyYouTubeUrl('');
            });

            // Insert full <iframe> embed code into the Quill editor
            $('#yt_insert_btn').on('click', function() {
                if (!currentVideoId) return;

                const iframeHtml = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${currentVideoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`;

                // Insert at current selection or at end of content
                const range = quill.getSelection();
                const index = range ? range.index : quill.getLength();
                quill.clipboard.dangerouslyPasteHTML(index, iframeHtml, 'user');

                // Show confirmation message briefly
                const $msg = $('#yt_inserted_msg');
                $msg.removeClass('hidden');
                setTimeout(() => $msg.addClass('hidden'), 3000);

                // Scroll editor into view
                document.getElementById('editor').scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
            // ─────────────────────────────────────────────────────────────
        });
    </script>

    {{-- ── Manual Author Modal JS ──────────────────────────────────── --}}
    <script>
    (function () {
        const openBtn    = document.getElementById('open_author_modal_btn');
        const saveBtn    = document.getElementById('save_author_btn');
        const errorsBox  = document.getElementById('author_modal_errors');
        const spinner    = document.getElementById('save_author_spinner');
        const saveLabel  = document.getElementById('save_author_label');
        const dropdown   = document.getElementById('manual_author_id');

        function openModalLocal() {
            openModal('author_modal_overlay');
            document.getElementById('ma_name').focus();
        }

        function closeModalLocal() {
            closeModal('author_modal_overlay');
            // Clear fields
            ['ma_name','ma_position','ma_image_url'].forEach(id => document.getElementById(id).value = '');
            document.getElementById('ma_description').value = '';
            document.getElementById('ma_status').value = '1';
            document.getElementById('ma_image').value = '';
            // Reset avatar preview
            document.getElementById('ma_avatar_preview').innerHTML =
                `<svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>`;
            errorsBox.classList.add('hidden');
            errorsBox.innerHTML = '';
        }

        // Live avatar preview on file select
        document.getElementById('ma_image').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('ma_avatar_preview').innerHTML =
                    `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(file);
        });

        openBtn.addEventListener('click', openModalLocal);

        // Listen to native modal closing to also reset values/errors
        document.body.addEventListener('click', function(e) {
            const closeBtn = e.target.closest('.close-modal-btn');
            if (closeBtn && closeBtn.getAttribute('data-modal') === 'author_modal_overlay') {
                closeModalLocal();
            }
            if (e.target.id === 'author_modal_overlay') {
                closeModalLocal();
            }
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('author_modal_overlay').classList.contains('hidden')) {
                closeModalLocal();
            }
        });

        // AJAX Save
        saveBtn.addEventListener('click', function() {
            const name = document.getElementById('ma_name').value.trim();
            if (!name) {
                errorsBox.innerHTML = '<p>The name field is required.</p>';
                errorsBox.classList.remove('hidden');
                return;
            }

            saveBtn.disabled = true;
            saveLabel.textContent = 'Saving...';
            spinner.classList.remove('hidden');
            errorsBox.classList.add('hidden');

            const formData = new FormData();
            formData.append('name', name);
            formData.append('position', document.getElementById('ma_position').value.trim());
            formData.append('description', document.getElementById('ma_description').value.trim());
            formData.append('status', document.getElementById('ma_status').value);
            formData.append('image_url', document.getElementById('ma_image_url').value.trim());
            formData.append('_token', '{{ csrf_token() }}');

            const fileInput = document.getElementById('ma_image');
            if (fileInput.files[0]) {
                formData.append('image', fileInput.files[0]);
            }

            fetch("{{ route('manual-authors.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if (res.ok) return res.json();
                return res.json().then(err => { throw err; });
            })
            .then(data => {
                const author = data.author || data;
                // Add option to dropdown
                const opt = document.createElement('option');
                opt.value = author.id;
                let text = author.name;
                if (author.position) {
                    text += ' · ' + author.position;
                }
                opt.textContent = text;
                dropdown.appendChild(opt);

                // Select the new option
                dropdown.value = author.id;

                closeModalLocal();
            })
            .catch(err => {
                let messages = [];
                if (err.errors) {
                    Object.values(err.errors).forEach(msgs => messages.push(...msgs));
                } else if (err.message) {
                    messages.push(err.message);
                } else {
                    messages.push('Something went wrong. Please try again.');
                }
                errorsBox.innerHTML = messages.map(m => `<p>${m}</p>`).join('');
                errorsBox.classList.remove('hidden');
            })
            .finally(() => {
                spinner.classList.add('hidden');
                saveLabel.textContent = 'Create Author';
                saveBtn.disabled = false;
            });
        });
    })();
    </script>
    {{-- ─────────────────────────────────────────────────────────────── --}}

</x-admin-layout>
