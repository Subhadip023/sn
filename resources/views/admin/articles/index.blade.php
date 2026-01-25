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
                        <td class="py-2 text-slate-500">{{ $article->published_at ?? '-' }}</td>
                        <td class="py-2 space-x-2 flex items-start justify-start">
                            <a href="{{ route('articles.show', $article) }}" class="text-blue-500 hover:text-blue-600 transition-transform duration-200 hover:scale-110 inline-block" title="View Article">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </a>
                            <a href="{{ route('articles.edit', $article) }}" class="text-amber-500 hover:text-amber-600 transition-transform duration-200 hover:scale-110 inline-block" title="Edit Article">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-600 transition-transform duration-200 hover:scale-110 inline-block" title="Delete Article">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
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
