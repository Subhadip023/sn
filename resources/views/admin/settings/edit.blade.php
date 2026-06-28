<x-admin-layout title="Site Settings">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Site Settings</h1>
    </header>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Main Settings -->
            <div class="lg:col-span-2 space-y-6">
                <!-- General Settings Card -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">General Settings</h3>

                    <div class="space-y-1">
                        <label for="site_name" class="block text-sm font-medium text-slate-700">Site Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="site_name" id="site_name" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required value="{{ old('site_name', setting('site_name', 'Sohoj News')) }}">
                        @error('site_name') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="default_language" class="block text-sm font-medium text-slate-700">Default Language <span class="text-rose-500">*</span></label>
                        <select name="default_language" id="default_language" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">
                            @foreach(languages() as $code => $name)
                                <option value="{{ $code }}" {{ old('default_language', setting('default_language', 'en')) == $code ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('default_language') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>

                <!-- SEO/Metadata settings -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">SEO Configuration</h3>

                    <div class="space-y-1">
                        <label for="meta_title" class="block text-sm font-medium text-slate-700">Homepage Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('meta_title', setting('meta_title')) }}">
                        @error('meta_title') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="meta_description" class="block text-sm font-medium text-slate-700">Homepage Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none">{{ old('meta_description', setting('meta_description')) }}</textarea>
                        @error('meta_description') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="meta_keywords" class="block text-sm font-medium text-slate-700">Homepage Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="news, portal, laravel" value="{{ old('meta_keywords', setting('meta_keywords')) }}">
                        @error('meta_keywords') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>
            </div>

            <!-- Right Column: Sidebar assets -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Branding Card -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                    <h3 class="text-lg font-medium text-slate-900">Branding</h3>

                    <!-- Logo -->
                    <div class="space-y-2">
                        <label for="site_logo" class="block text-sm font-medium text-slate-700">Site Logo</label>
                        @if(setting('site_logo'))
                            <div class="mb-2 p-2 bg-slate-50 border border-slate-100 rounded-lg">
                                <img src="{{ asset('storage/' . setting('site_logo')) }}" alt="Logo" class="max-h-12 object-contain" />
                            </div>
                        @endif
                        <input type="file" name="site_logo" id="site_logo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        @error('site_logo') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Favicon -->
                    <div class="space-y-2 pt-4 border-t border-slate-100">
                        <label for="site_favicon" class="block text-sm font-medium text-slate-700">Favicon</label>
                        @if(setting('site_favicon'))
                            <div class="mb-2 p-2 bg-slate-50 border border-slate-100 rounded-lg">
                                <img src="{{ asset('storage/' . setting('site_favicon')) }}" alt="Favicon" class="max-h-8 object-contain" />
                            </div>
                        @endif
                        <input type="file" name="site_favicon" id="site_favicon" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        @error('site_favicon') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>

                <!-- Actions -->
                <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <button type="submit" class="w-full px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold shadow-sm transition-colors">Save Settings</button>
                </section>
            </div>

        </div>
    </form>
</x-admin-layout>
