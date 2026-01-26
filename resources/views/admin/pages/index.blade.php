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

  
        
        <form action="{{ route('pages.reorder') }}" method="POST">
            @csrf
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-500">
                    <tr class="text-left">
                        <th class="py-2 font-medium">Position</th>
                        <th class="py-2 font-medium">Title</th>
                        <th class="py-2 font-medium">Slug</th>
                        <th class="py-2 font-medium">Status</th>
                        <th class="py-2 font-medium">Last Modified</th>
                        <th class="py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if($pages->isEmpty())
                    <tr>
                        <td class="py-2 text-slate-900" colspan="5">No pages found</td>
                    </tr>
                    @else
                        @foreach ($pages as $page)
                        <tr>
                            <td class="py-2 text-slate-900"><input class="w-20 rounded border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" type="number" name="position[{{ $page->id }}]" value="{{ $page->position }}"></td>
                            <td class="py-2 text-slate-900">{{ $page->title }}</td>
                            <td class="py-2 text-slate-600">{{ $page->slug }}</td>
                            <td class="py-2"><span class="px-2 py-1 rounded-full {{ $page->active? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }} text-slate-700 text-xs font-medium">{{ $page->active? 'Published' : 'Draft' }}</span></td>
                            <td class="py-2 text-slate-500">{{ $page->updated_at }}</td>
                            <td class="py-2 space-x-2">
                                <a class="text-brand-600 hover:text-brand-700" href="#">Edit</a>
                                <button class="text-slate-500 hover:text-slate-700">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="flex justify-end pt-4">
            <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold transition-all shadow-sm active:scale-95">
                Save Positions
            </button>
        </div>
    </form>
    </section>



    <script>
       
    </script>
</x-admin-layout>