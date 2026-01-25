<x-admin-layout>
    <header class="flex flex-wrap items-center gap-4 justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500">Site</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage Articles</h1>
        </div>
        <div>
            <a href="{{ route('articles.create') }}" class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold">Create Article</a>
        </div>
    </header>


    <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">All Articles</h2>
            <span class="text-sm text-slate-500">{{ $articles->total() }} articles</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-slate-500">
                    <tr class="text-left">
                        <th class="py-2 font-medium">Title</th>
                        <th class="py-2 font-medium">Author</th>
                        <th class="py-2 font-medium">Category</th>
                        <th class="py-2 font-medium">Tags</th>

                        <th class="py-2 font-medium">Status</th>
                        <th class="py-2 font-medium">Views</th>
                        <th class="py-2 font-medium">Published</th>
                        <th class="py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($articles as $article)
                    <tr>
                        <td class="py-2 text-slate-900">
                            <div>{{ $article->title }}</div>
                            <div class="text-xs text-slate-400">{{ $article->slug }}</div>
                        </td>
                        <td class="py-2 text-slate-600">{{ $article->author->name ?? 'Unknown' }}</td>
                        <td class="py-2 text-slate-600">{{ $article->category->title ?? 'Uncategorized' }}</td>
                        <td class="py-2 text-slate-600">{{ $article->tags->implode('title', ', ') ?? '-' }}</td>
                        <td class="py-2">
                            <span class="px-2 py-1 rounded-full {{ $article->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }} text-xs font-medium">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td class="py-2 text-slate-600">{{ $article->views }}</td>
                        <td class="py-2 text-slate-500">{{ $article->published_at ? $article->published_at->format('M d, Y') : '-' }}</td>
                        <td class="py-2">
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="py-2 text-slate-900 text-center" colspan="7">No articles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </section>
</x-admin-layout>
