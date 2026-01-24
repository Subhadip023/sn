<div>
    <!-- It is never too late to be what you might have been. - George Eliot -->
</div><!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Newsroom Pro — Admin Dashboard</title>
    <meta name="description" content="Admin overview for Newsroom Pro with activity, stats, and theme toggle." />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { brand: { 500: '#5164ff', 400: '#7c8fff' }, ink: '#0b1221' }
          }
        }
      };
    </script>
  </head>
  <body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen grid lg:grid-cols-[260px_1fr]">
      <aside class="border-r border-slate-200 bg-white flex flex-col">
        <div class="p-4 flex items-center gap-2 text-lg font-semibold">
          <div class="h-9 w-9 rounded-xl bg-brand-500 flex items-center justify-center text-white">N</div>
          <div>
            <div>{{ config('app.name') }}</div>
            <p class="text-xs text-slate-500">admin</p>
          </div>
        </div>
        <nav class="px-3 space-y-2 text-sm main-nav">
          <a class="block px-3 py-2 rounded-lg {{ request()->is('admin') ? 'bg-slate-100 text-brand-600' : 'hover:bg-slate-50 text-slate-600' }}" href="/admin">Dashboard</a>
          <div class="bg-slate-100 rounded-lg">
            <button id="contentMenuBtn" class="w-full flex items-center justify-between px-3 py-2 rounded-lg {{ request()->is('admin/content*') ? 'bg-slate-100 text-brand-600' : 'hover:bg-slate-50 text-slate-600' }}">
              <span>Content</span>
              <svg id="contentMenuIcon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div id="contentSubmenu" class="hidden pl-4 mt-1 space-y-1">
              <a class="block px-3 py-2 rounded-lg {{ request()->is('admin/content') ? 'text-brand-600 font-medium' : 'text-slate-500 hover:text-slate-700' }}" href="/admin/content">All Articles</a>
              <a class="block px-3 py-2 rounded-lg text-slate-500 hover:text-slate-700" href="#">Categories</a>
              <a class="block px-3 py-2 rounded-lg text-slate-500 hover:text-slate-700" href="#">Tags</a>
            </div>
          </div>
          <a class="block px-3 py-2 rounded-lg {{ request()->is('admin/users*') ? 'bg-slate-100 text-brand-600' : 'hover:bg-slate-50 text-slate-600' }}" href="/admin/users">Users</a>
          <a class="block px-3 py-2 rounded-lg {{ request()->is('admin/site*') ? 'bg-slate-100 text-brand-600' : 'hover:bg-slate-50 text-slate-600' }}" href="/">Site</a>
        </nav>
        <div class="mt-auto p-4 text-xs text-slate-400">Connected: newsroom / prod</div>
      </aside>

      <main class="p-5 lg:p-8 space-y-6">
        {{ $slot }}
      </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/script.js"></script>
  </body>
</html>


