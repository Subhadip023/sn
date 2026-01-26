<x-admin-layout>

        <header class="flex flex-wrap items-center gap-4 justify-between ">
          <div>
            <p class="text-sm text-slate-500">Overview</p>
            <h1 class="text-2xl font-semibold text-slate-900">Publishing health</h1>
          </div>
          <div class="flex items-center gap-3">
            <button id="themeBtn" class="px-4 py-2 rounded-lg border border-slate-200 hover:border-slate-300 text-slate-700">Theme</button>
            <a class="px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold" href="/admin/content">Open content</a>
          </div>
        </header>

        <section class="grid sm:grid-cols-2 xl:grid-cols-4 gap-4">
          <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Published</p>
            <div class="text-3xl font-semibold text-slate-900">{{ $stats['published'] }}</div>
            <p class="text-xs text-emerald-600 mt-1">+12 this week</p>
          </div>
          <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Drafts</p>
            <div class="text-3xl font-semibold text-slate-900">{{ $stats['drafts'] }}</div>
            <p class="text-xs text-amber-600 mt-1">Needs review</p>
          </div>
          <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Scheduled</p>
            <div class="text-3xl font-semibold text-slate-900">{{ $stats['scheduled'] }}</div>
            <p class="text-xs text-slate-500 mt-1">Next 24h</p>
          </div>
          <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Editors</p>
            <div class="text-3xl font-semibold text-slate-900" id="editorsCount">{{ $stats['editors'] }}</div>
            <p class="text-xs text-emerald-600 mt-1">Total</p>
          </div>
        </section>

        <section class="grid lg:grid-cols-[1.1fr_0.9fr] gap-4">
          <div class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-semibold text-slate-900">Engagement</h2>
              <span class="text-xs text-slate-500">Last 7 days</span>
            </div>
            <div class="h-48 rounded-lg bg-slate-50 p-2 relative">
              <canvas id="engagementChart"></canvas>
            </div>
            <ul class="text-sm text-slate-600 space-y-1">
              <li>— Sessions up 14% driven by newsletter traffic.</li>
              <li>— Average time on page 4m12s across features.</li>
            </ul>
          </div>
          <div class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-semibold text-slate-900">Recent activity</h2>
              <span class="text-xs text-slate-500">Live</span>
            </div>
            <div id="activity" class="space-y-3 text-sm text-slate-700">
              @foreach($recentActivity as $article)
              <div class="flex items-center justify-between bg-slate-50 px-3 py-2 rounded-lg">
                <span>{{ ucfirst($article->status) }}: {{ $article->title }}</span>
                <span class="text-slate-400">{{ $article->updated_at->format('H:i') }}</span>
              </div>
              @endforeach
            </div>
          </div>
        </section>

        <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">Content queue</h2>
            <button class="text-sm px-3 py-2 rounded-lg border border-slate-200 hover:border-slate-300 text-slate-600" id="refreshQueue" type="button">Refresh</button>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="text-slate-500">
                <tr class="text-left">
                  <th class="py-2 font-medium">Title</th>
                  <th class="py-2 font-medium">Section</th>
                  <th class="py-2 font-medium">Status</th>
                  <th class="py-2 font-medium">Updated</th>
                  <th class="py-2 font-medium">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100" id="queueTable">
                @foreach($contentQueue as $article)
                <tr>
                  <td class="py-2 text-slate-900">{{ $article->title }}</td>
                  <td class="py-2 text-slate-600">{{ $article->category->name ?? 'N/A' }}</td>
                  <td class="py-2">
                    <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium">{{ ucfirst($article->status) }}</span>
                  </td>
                  <td class="py-2 text-slate-500">{{ $article->updated_at->format('H:i') }}</td>
                  <td class="py-2 space-x-2">
                    <a class="text-brand-600 hover:text-brand-700" href="{{ route('articles.show', $article) }}">View</a>
                    <a class="text-slate-500 hover:text-slate-700" href="{{ route('articles.edit', $article) }}">Edit</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
    
</x-admin-layout>
