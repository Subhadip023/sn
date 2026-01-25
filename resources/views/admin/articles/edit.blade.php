<x-admin-layout>
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Edit Article</h1>
    </header>

    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Main Details -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <div class="space-y-1">
                        <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="Enter article title" required value="{{ old('title', $article->title) }}">
                        @error('title') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                        <input type="text" name="slug" id="slug" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="auto-generated" value="{{ old('slug', $article->slug) }}">
                        <p class="text-xs text-slate-500">Leave empty to auto-generate.</p>
                        @error('slug') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="excerpt" class="block text-sm font-medium text-slate-700">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="Short summary...">{{ old('excerpt', $article->excerpt) }}</textarea>
                        @error('excerpt') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">
                            Content <span class="text-rose-500">*</span>
                        </label>

                        <div id="editor" style="height: 200px;" class="bg-white rounded-b-lg border border-slate-300 border-t-0">
                            {!! old('content', $article->content) !!}
                        </div>

                        <input type="hidden" name="content" id="content">

                        @error('content')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                </section>

                <!-- SEO Section -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">SEO Configuration</h3>

                    <div class="space-y-1">
                        <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('meta_title', $article->meta_title) }}">
                    </div>

                    <div class="space-y-1">
                        <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">{{ old('meta_description', $article->meta_description) }}</textarea>
                    </div>

                    <div class="space-y-1">
                        <label for="meta_keywords" class="block text-sm font-medium text-slate-700">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="comma, separated, keywords" value="{{ old('meta_keywords', $article->meta_keywords) }}">
                    </div>

                    <div class="space-y-1">
                        <label for="canonical_url" class="block text-sm font-medium text-slate-700">Canonical URL</label>
                        <input type="url" name="canonical_url" id="canonical_url" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('canonical_url', $article->canonical_url) }}">
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
                        <select name="status" id="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                            <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label for="published_at" class="block text-sm font-medium text-slate-700">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('published_at', $article->published_at ) }}">
                        @error('published_at') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold">Save Article</button>
                    <a href="{{ route('articles.index') }}" class="block text-center w-full px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium">Cancel</a>
                </section>

                <!-- Classification -->
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">Classification</h3>

                    <div class="space-y-1">
                        <label for="category_id" class="block text-sm font-medium text-slate-700">Category <span class="text-rose-500">*</span></label>
                        <select name="category_id" id="category_id" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Tags</label>
                        <div class="max-h-40 overflow-y-auto border border-slate-300 rounded-lg p-2 bg-white space-y-2">
                            @foreach($tags as $tag)
                            <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded text-brand-500 focus:ring-brand-500" {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $tag->title }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </section>

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
                        <input type="text" name="featured_image_url" id="featured_image_url" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('featured_image_url', $article->featured_image_url) }}" placeholder="https://example.com/image.jpg">

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
                        <input type="text" name="og_image_url" id="og_image_url" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="https://example.com/image.jpg" value="{{ old('og_image_url', $article->og_image_url) }}">
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
            var form = document.querySelector('form');
            form.addEventListener('submit', function() {
                var content = document.querySelector('#content');
                content.value = quill.root.innerHTML;
            });
        });
    </script>


</x-admin-layout>