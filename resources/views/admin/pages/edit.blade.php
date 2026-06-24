<x-admin-layout title="Edit Page">
    <header class="flex flex-wrap items-center gap-4 justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500">Pages</p>
            <h1 class="text-2xl font-semibold text-slate-900">Edit Page: {{ $page->title }}</h1>
        </div>
    </header>

    <section class="w-full rounded-xl border border-slate-200 bg-white p-6 space-y-4 shadow-sm">
        <form action="{{ route('pages.update', $page) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title Field -->
                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" name="title" id="title" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="e.g. About Us" required value="{{ old('title', $page->title) }}">
                    @error('title')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror    
                </div>

                <!-- Slug Field -->
                <div class="space-y-2">
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-slate-300 bg-slate-100 text-slate-500 text-sm">
                            {{ config('app.url') }}/
                        </span>
                        <input type="text" name="slug" id="slug" class="flex-1 min-w-0 block w-full rounded-none rounded-r-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="about-us" value="{{ old('slug', $page->slug) }}">
                    </div>
                    @error('slug')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror 
                    <p class="text-xs text-slate-500">Leave empty to auto-generate from title.</p>
                </div>

                <!-- Position Field -->
                <div class="space-y-2">
                    <label for="position" class="block text-sm font-medium text-slate-700">Position</label>
                    <input type="number" name="position" id="position" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required value="{{ old('position', $page->position) }}">
                    @error('position')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror 
                </div>

                <!-- Active Field -->
                <div class="space-y-2">
                    <label for="active" class="block text-sm font-medium text-slate-700">Active</label>
                    <select name="active" id="active" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                        <option value="1" {{ old('active', $page->active) ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('active', $page->active) ? '' : 'selected' }}>No</option>
                    </select>
                    @error('active')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror 
                </div>
            </div>

            <!-- Hide Articles Grid checkbox -->
            <div class="flex items-center gap-2.5 pt-2">
                <input type="checkbox" name="hide_articles" id="hide_articles" value="1" {{ old('hide_articles', $page->hide_articles) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                <label for="hide_articles" class="text-sm font-medium text-slate-700 select-none">Hide dynamic articles grid and sidebar on this page</label>
                @error('hide_articles')
                    <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold shadow-sm transition-colors">Save Page</button>
                <a href="{{ route('pages.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium transition-colors">Cancel</a>
            </div>
        </form>
    </section>
</x-admin-layout>
