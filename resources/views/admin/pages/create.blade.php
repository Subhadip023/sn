<x-admin-layout title="Create Page">
    <header class="flex flex-wrap items-center gap-4 justify-between">
        <div>
            <p class="text-sm text-slate-500">Pages</p>
            <h1 class="text-2xl font-semibold text-slate-900">Create Page</h1>
        </div>
    </header>

    <section class="w-full rounded-xl border
    border-slate-200 bg-white p-5 space-y-4 shadow-sm">
        <form action="{{ route('pages.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex items-start justify-around">
                <div class="space-y-2 w-1/2 px-2">
                    <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" name="title" id="title" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="e.g. About Us" required>
                    @error('title')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror    
                </div>

                <div class="space-y-2 w-1/2 px-2">
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-slate-300 bg-slate-100 text-slate-500 text-sm">
                            {{ config('app.url') }}/
                        </span>
                        <input type="text" name="slug" id="slug" class="flex-1 min-w-0 block w-full rounded-none rounded-r-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" placeholder="about-us">
                    </div>
                    @error('title')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror 
                    <p class="text-xs text-slate-500">Leave empty to auto-generate from title.</p>
                </div>
            </div>


            <div class="flex items-end justify-between">

            <div class="space-y-2 w-1/3 px-2">
                <label for="lang" class="block text-sm font-medium text-slate-700">Language</label>
                <select name="lang" id="lang" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                    <option value="en" selected>English</option>
                    <option value="bn">Bengali</option>
                </select>
                @error('lang')
                    <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2 w-1/3 px-2">
                <label for="status" class="block text-sm font-medium text-slate-700">Active</label>
                <select name="active" id="status" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                    <option value="1" selected>yes</option>
                    <option value="0">no</option>
                </select>
                @error('active')
                    <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 ">
                <button type="submit" class="px-4 py-2  rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold">Create Page</button>
                <a href="{{ route('pages.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium">Cancel</a>
            </div>
            </div>
        </form>
    </section>
</x-admin-layout>