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
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label for="title" class="block text-sm font-medium text-slate-700">Title <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="e.g. Technology" required>
                    @error('title')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <input type="text" name="slug" id="slug" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="auto-generated">
                    <p class="text-xs text-slate-500">Leave empty to auto-generate from title.</p>
                    @error('slug')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="active" id="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="lang" class="block text-sm font-medium text-slate-700">Language <span class="text-rose-500">*</span></label>
                    <select name="lang" id="lang" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required>
                        <option value="en" selected>English</option>
                        <option value="bn">Bengali</option>
                    </select>
                    @error('lang')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold">Create Category</button>
                </div>
            </form>
        </section>

        <!-- Category List -->
        <section class="lg:col-span-2 rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">All Categories</h2>
                <span class="text-sm text-slate-500">{{ $categories->total() }} categories</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-slate-500">
                        <tr class="text-left">
                            <th class="py-2 font-medium">Title</th>
                            <th class="py-2 font-medium">Slug</th>
                            <th class="py-2 font-medium">Language</th>
                            <th class="py-2 font-medium">Status</th>
                            <th class="py-2 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($categories as $category)
                        <tr>
                            <td class="py-2 text-slate-900">{{ $category->title }}</td>
                            <td class="py-2 text-slate-600">{{ $category->slug }}</td>
                            <td class="py-2 text-slate-600 uppercase">{{ $category->lang }}</td>
                            <td class="py-2">
                                <span class="px-2 py-1 rounded-full {{ $category->active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }} text-xs font-medium">
                                    {{ $category->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-2">
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-2 text-slate-900 text-center" colspan="5">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $categories->links('vendor.pagination.custom') }}
            </div>
        </section>
    </div>
</x-admin-layout>