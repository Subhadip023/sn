<x-admin-layout title="Manage Translations">
    <header class="flex flex-wrap items-center gap-4 justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500">Settings</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage Translations</h1>
        </div>
        <div>
            <a href="{{ route('translations.create') }}" class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Translation
            </a>
        </div>
    </header>

    <!-- Filters Section -->
    <section class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm mb-6">
        <form method="GET" action="{{ route('translations.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="space-y-1 flex-1 min-w-[200px]">
                <label for="search" class="block text-sm font-medium text-slate-700">Search Key/Value</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search translations..." class="w-full rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-900 focus:border-brand-500 focus:outline-none">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-white text-sm font-semibold">Filter</button>
                @if(request()->filled('search'))
                    <a href="{{ route('translations.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50 text-slate-700 text-sm font-medium">Clear</a>
                @endif
            </div>
        </form>
    </section>

    <!-- Translations List Table -->
    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">All Translations</h2>
            <span class="text-sm text-slate-500">{{ $translations->total() }} items</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-500 border-b border-slate-100">
                    <tr class="text-left">
                        <th class="py-2.5 font-medium w-1/3">Translation Key</th>
                        <th class="py-2.5 font-medium">Translation Value (en)</th>
                        <th class="py-2.5 font-medium">Translation Value (bn)</th>
                        <th class="py-2.5 font-medium w-24 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($translations as $translation)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 font-mono text-slate-800 break-all pr-4">{{ $translation->key }}</td>
                        <td class="py-3 text-slate-600 break-all pr-4">{{ $translation->en_value }}</td>
                        <td class="py-3 text-slate-600 break-all pr-4">{{ $translation->bn_value }}</td>
                        <td class="py-3 text-right space-x-2">
                            <a href="{{ route('translations.edit', $translation->id) }}" class="text-amber-500 hover:text-amber-600 inline-block" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('translations.destroy', $translation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this translation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-600" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="py-6 text-slate-400 text-center" colspan="4">No translations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $translations->links('vendor.pagination.custom') }}
        </div>
    </section>
</x-admin-layout>
