<x-admin-layout title="Manage Pages">
    <header class="flex flex-wrap items-center gap-4 justify-between">
        <div>
            <p class="text-sm text-slate-500">Site</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage pages</h1>
        </div>
        <div class="flex items-center gap-3">
            <a class="px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-semibold" href="#">Settings</a>
            <a class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold"  href="{{ route('pages.create') }}">Create page</a>
        </div>
    </header>

    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <input class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" type="search" placeholder="Search pages" />
            </div>
            <span class="text-sm text-slate-500">{{ $length ?? 0 }} pages</span>
        </div>

  
        
        <form action="{{ route('pages.reorder') }}" id="reorderForm" method="POST">
            @csrf
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-500">
                    <tr class="text-left">
                        <th class="py-2 font-medium w-10"></th>
                        <th class="py-2 font-medium">Position</th>
                        <th class="py-2 font-medium">Title</th>
                        <th class="py-2 font-medium">Slug</th>
                        <th class="py-2 font-medium">Status</th>
                        <th class="py-2 font-medium">Last Modified</th>
                        <th class="py-2 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="sortable-pages" class="divide-y divide-slate-100">
                    @if($pages->isEmpty())
                    <tr>
                        <td class="py-2 text-slate-900" colspan="7">No pages found</td>
                    </tr>
                    @else
                        @foreach ($pages as $page)
                        <tr class="sortable-row" data-id="{{ $page->id }}">
                            <td class="py-2 text-slate-400 cursor-move handle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </td>
                            <td class="py-2 text-slate-900">
                                <span class="position-text">{{ $page->position }}</span>
                                <input type="hidden" name="position[{{ $page->id }}]" class="position-input" value="{{ $page->position }}">
                            </td>
                            <td class="py-2 text-slate-900 font-medium">{{ $page->title }}</td>
                            <td class="py-2 text-slate-600">{{ $page->slug }}</td>
                            <td class="py-2">
                                <form action="{{ route('pages.update', $page) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="active" value="{{ $page->active? 0 : 1 }}">
                                    <button type="submit" class="px-2.5 py-0.5 rounded-full {{ $page->active? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }} text-xs font-semibold">
                                        {{ $page->active? 'Published' : 'Draft' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-2 text-slate-500">{{ $page->updated_at->format('M d, Y') }}</td>
                            <td class="py-2 text-right space-x-2">

                                <a class="text-brand-600 hover:text-brand-700 font-medium" href="{{ route('pages.edit', $page) }}">Edit</a>
                                <a class="text-brand-600 hover:text-brand-700 font-medium" href="{{ route('page.settings', $page->id) }}">Settings</a>
                                <form action="{{ route('pages.destroy', $page) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="flex justify-end pt-4" id="saveOrderBtn" style="display: none;">
            <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold transition-all shadow-sm active:scale-95">
                Save Order
            </button>
        </div>
    </form>
    </section>

    <!-- SortableJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('sortable-pages');
            const saveBtn = document.getElementById('saveOrderBtn');
            
            if (el) {
                const sortable = Sortable.create(el, {
                    handle: '.handle',
                    animation: 150,
                    ghostClass: 'bg-slate-50',
                    onEnd: function() {
                        updatePositions();
                        saveBtn.style.display = 'flex';
                    }
                });
            }

            function updatePositions() {
                const rows = document.querySelectorAll('.sortable-row');
                rows.forEach((row, index) => {
                    const position = index + 1;
                    row.querySelector('.position-text').textContent = position;
                    row.querySelector('.position-input').value = position;
                });
            }
        });
    </script>
</x-admin-layout>