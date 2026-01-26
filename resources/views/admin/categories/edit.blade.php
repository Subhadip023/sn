<x-admin-layout title="Manage Categories"> 
    <header class="flex flex-wrap items-center gap-4 justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500">Site</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage Categories</h1>
        </div>
    </header>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Create Category Form -->
        <section class="lg:col-span-1 rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm h-fit">
            <h2 class="text-lg font-semibold text-slate-900">Create Category</h2>
            <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-1">
                    <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ $category->title }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="e.g. Technology" required>
                    @error('title')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <input type="text" name="slug" id="slug" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" value="{{ $category->slug }}" placeholder="auto-generated">
                    <p class="text-xs text-slate-500">Leave empty to auto-generate from title.</p>
                    @error('slug')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="active" id="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                        <option value="1" {{ $category->active == 1 ? 'selected' : '' }}>Active</option><option value="1" selected>Active</option>
                        <option value="0" {{ $category->active == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold"> Edit Category</button>
                </div>
            </form>
        </section>

      
    </div>
</x-admin-layout>