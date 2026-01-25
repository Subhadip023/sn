<div>
  <!-- It is never too late to be what you might have been. - George Eliot -->
</div>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Newsroom Pro — Admin Dashboard</title>
  <meta name="description" content="Admin overview for Newsroom Pro with activity, stats, and theme toggle." />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

  <style>
    @keyframes ticker {
      0% {
        transform: translateY(0);
      }

      25% {
        transform: translateY(-100%);
      }

      50% {
        transform: translateY(-200%);
      }

      75% {
        transform: translateY(-100%);
      }

      100% {
        transform: translateY(0);
      }
    }

    .ticker ul {
      animation: ticker 20s linear infinite;
    }

    @keyframes bounce {
      from {
        transform: translateY(0);
      }

      to {
        transform: translateY(-10px);
      }
    }

    .loader-logo .n {
      animation: bounce 1s infinite alternate;
    }

    .loader-logo .p {
      animation: bounce 1s 0.2s infinite alternate;
    }

    @keyframes progress {
      0% {
        width: 0%;
        transform: translateX(-50%);
      }

      50% {
        width: 100%;
        transform: translateX(0);
      }

      100% {
        width: 0%;
        transform: translateX(100%);
      }
    }

    .loader-progress {
      animation: progress 1.5s ease-in-out infinite;
    }

    .popup-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .popup-overlay.active .popup-content {
      transform: translateY(0);
    }

    .checkbox-checkmark:after {
      content: "";
      position: absolute;
      display: none;
      left: 7px;
      top: 3px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }

    input[type="checkbox"]:checked~.checkbox-checkmark {
      background-color: #e31837;
      border-color: #e31837;
    }

    input[type="checkbox"]:checked~.checkbox-checkmark:after {
      display: block;
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              500: '#5164ff',
              400: '#7c8fff'
            },
            ink: '#0b1221'
          }
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

        <x-admin.nav-link
          href="/admin"
          :active="request()->is('admin')">
          Dashboard
        </x-admin.nav-link>

        <x-admin.nav-dropdown
          title="Content"
          :active="request()->routeIs('articles.*') || request()->routeIs('categories.*') || request()->routeIs('tags.*')">

          <x-admin.nav-sub-link
            href="{{ route('articles.index') }}"
            :active="request()->routeIs('articles.index')">
            All Articles
          </x-admin.nav-sub-link>

          <x-admin.nav-sub-link href="{{route('categories.index')}}">
            Categories
          </x-admin.nav-sub-link>

          <x-admin.nav-sub-link href="{{route('tags.index')}}">
            Tags
          </x-admin.nav-sub-link>

        </x-admin.nav-dropdown>

        <x-admin.nav-dropdown
          title="Pages"
          :active="request()->routeIs('pages.*')">

          <x-admin.nav-sub-link
            href="{{ route('pages.index') }}"
            :active="request()->routeIs('pages.index')">
            All Pages
          </x-admin.nav-sub-link>

        </x-admin.nav-dropdown>


        <x-admin.nav-link
          href="/admin/users"
          :active="request()->is('admin/users*')">
          Users
        </x-admin.nav-link>

        <x-admin.nav-link
          href="/"
          :active="request()->is('admin/site*')">
          Site
        </x-admin.nav-link>

      </nav>

      <div class="mt-auto p-4 text-xs text-slate-400">Connected: newsroom / prod</div>
    </aside>

    <main class="p-5 lg:p-8 space-y-6">
      @if (session('success'))
      <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 border border-green-200 fixed top-4 right-4 tost">
        <div class="flex items-center">
          <svg class="h-5 w-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      </div>
      @endif

      @if (session('error'))
      <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800 border border-red-200 fixed top-4 right-4 tost">
        <div class="flex items-center">
          <svg class="h-5 w-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 002 0V7zm0 6a1 1 0 10-2 0 1 1 0 002 0z" clip-rule="evenodd" />
          </svg>
          <span>{{ session('error') }}</span>
        </div>
      </div>
      @endif
      {{ $slot }}
    </main>
    <x-ui.loader />

  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    setTimeout(() => {
      document.querySelector('.tost').remove();
    }, 5000);
  </script>
  <script src="{{ asset('js/script.js') }}"></script>


</body>

</html>