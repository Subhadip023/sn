<x-admin-layout title="Page Settings">
    <header class="flex flex-wrap items-center gap-4 justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500">Site</p>
            <h1 class="text-2xl font-semibold text-slate-900">Page Settings</h1>
        </div>
        <div class="flex items-center gap-3">
            <a class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium transition-colors" href="{{ route('pages.index') }}">Back</a>
            <a class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold transition-colors" href="{{ route('pages.create') }}">Create Page</a>
        </div>
    </header>

    <form action="{{ route('page.settings.update') }}" method="post">
        <input type="hidden" name="page_id" value="{{ $page->id }}">
        @csrf
        
        <section class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="grid md:grid-cols-2 divide-x divide-slate-200">
                <!-- Categories Section -->
                <div class="p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-900">Categories</h2>
                        <p class="text-sm text-slate-500 mt-1">Select applicable categories</p>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-x-6 gap-y-3">
                        @foreach($categories as $category)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="categories[]" 
                                id="category-{{ $category->id }}" 
                                value="{{ $category->id }}" 
                                class="w-4 h-4 rounded border-slate-300 text-brand-500 focus:ring-brand-400 focus:ring-offset-0"
                                @if(in_array($category->id, $selcted_categories)) checked @endif
                            >
                            <span class="text-sm text-slate-700 group-hover:text-slate-900">{{ $category->title }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Tags Section -->
                <div class="p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-900">Tags</h2>
                        <p class="text-sm text-slate-500 mt-1">Select relevant tags</p>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-x-6 gap-y-3">
                        @foreach($tags as $tag)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="tags[]" 
                                id="tag-{{ $tag->id }}" 
                                value="{{ $tag->id }}" 
                                class="w-4 h-4 rounded border-slate-300 text-brand-500 focus:ring-brand-400 focus:ring-offset-0"
                                @if(in_array($tag->id, $selcted_tasgs)) checked @endif
                            >
                            <span class="text-sm text-slate-700 group-hover:text-slate-900">{{ $tag->title }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Footer with Save Button -->
            <div class="border-t border-slate-200 bg-slate-50 px-8 py-4">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-500">Save your changes to update page settings</p>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold transition-colors">
                        Save Settings
                    </button>
                </div>
            </div>
        </section>
    </form>
</x-admin-layout>