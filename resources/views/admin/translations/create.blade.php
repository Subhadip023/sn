<x-admin-layout title="Add Translation">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Add Translation</h1>
    </header>

    <div class="max-w-2xl">
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('translations.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="key" class="block text-sm font-medium text-slate-700">Translation Key <span class="text-rose-500">*</span></label>
                    <textarea name="key" id="key" rows="2" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="e.g. Home, Read More, or a full English sentence" required>{{ old('key') }}</textarea>
                    <p class="text-xs text-slate-500">This is the original text used in the code (e.g. inside <code>__('key')</code>).</p>
                    @error('key')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="value_en" class="block text-sm font-medium text-slate-700">Translation Value (English) <span class="text-rose-500">*</span></label>
                    <textarea name="value_en" id="value_en" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="e.g. Home" required>{{ old('value_en') }}</textarea>
                    @error('value_en')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="value_bn" class="block text-sm font-medium text-slate-700">Translation Value (Bengali) <span class="text-rose-500">*</span></label>
                    <textarea name="value_bn" id="value_bn" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="e.g. প্রচ্ছদ" required>{{ old('value_bn') }}</textarea>
                    @error('value_bn')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-slate-100 flex gap-3">
                    <button type="submit" class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold">Save Translation</button>
                    <a href="{{ route('translations.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium">Cancel</a>
                </div>
            </form>
        </section>
    </div>
</x-admin-layout>
