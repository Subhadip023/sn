<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }} - {{ $title }}</title>
    <meta name="description" content="Admin overview for Newsroom Pro." />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .sidebar-collapsed {
            width: 80px;
        }
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        .sidebar-collapsed .sidebar-header-text {
            display: none;
        }
        .sidebar-collapsed aside {
            width: 80px;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#5164ff',
                            400: '#7c8fff',
                            600: '#3d4ed1'
                        },
                        ink: '#0b1221'
                    }
                }
            }
        };
    </script>
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="flex min-h-screen overflow-hidden" id="admin-layout">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-all duration-300 transform lg:relative lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="h-10 w-10 shrink-0 rounded-xl bg-brand-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-brand-500/20">
                            N
                        </div>
                        <div class="sidebar-text transition-all duration-300 whitespace-nowrap">
                            <div class="font-bold text-slate-800 leading-tight">{{ config('app.name') }}</div>
                            <p class="text-[10px] uppercase tracking-wider font-semibold text-slate-400">Management</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto main-nav">
                    <x-admin.nav-link href="/admin" :active="request()->is('admin')">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span class="sidebar-text whitespace-nowrap">Dashboard</span>
                        </div>
                    </x-admin.nav-link>

                    <x-admin.nav-dropdown title="Content" :active="request()->routeIs('articles.*') || request()->routeIs('categories.*') || request()->routeIs('tags.*')">
                        <x-slot name="icon">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </x-slot>
                        <x-admin.nav-sub-link href="{{ route('articles.index') }}" :active="request()->routeIs('articles.index')">
                            All Articles
                        </x-admin.nav-sub-link>
                        <x-admin.nav-sub-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.index')">
                            Categories
                        </x-admin.nav-sub-link>
                        <x-admin.nav-sub-link href="{{ route('tags.index') }}" :active="request()->routeIs('tags.index')">
                            Tags
                        </x-admin.nav-sub-link>
                    </x-admin.nav-dropdown>

                    <x-admin.nav-dropdown title="Pages" :active="request()->routeIs('pages.*')">
                        <x-slot name="icon">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </x-slot>
                        <x-admin.nav-sub-link href="{{ route('pages.index') }}" :active="request()->routeIs('pages.index')">
                            All Pages
                        </x-admin.nav-sub-link>
                    </x-admin.nav-dropdown>

                    <x-admin.nav-link href="/admin/users" :active="request()->is('admin/users*')">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="sidebar-text whitespace-nowrap">Users</span>
                        </div>
                    </x-admin.nav-link>

                    <x-admin.nav-link href="/" target="_blank">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span class="sidebar-text whitespace-nowrap">View Site</span>
                        </div>
                    </x-admin.nav-link>
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t border-slate-100 overflow-hidden">
                    <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3 transition-all duration-300">
                        <div class="w-2 h-2 shrink-0 rounded-full bg-green-500 animate-pulse"></div>
                        <div class="sidebar-text text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">System Online</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 z-30 sticky top-0">
                <div class="flex items-center gap-4">
                    <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-slate-100 text-slate-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-lg font-semibold text-slate-800 tracking-tight">{{ $title ?? 'Dashboard' }}</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notifications? -->
                    
                    <!-- Profile Dropdown -->
                    <div class="relative" id="profile-wrapper">
                        <button id="profile-btn" class="flex items-center gap-3 p-1 rounded-full hover:bg-slate-50 transition-colors">
                            <img class="h-8 w-8 rounded-full object-cover ring-2 ring-slate-100" 
                                 src="https://images.pexels.com/users/avatars/1663974969/subhadip-chakraborty-890.jpg?auto=compress&fit=crop&h=130&w=130&dpr=1" 
                                 alt="User">
                            <div class="hidden md:block text-left">
                                <div class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->name ?? 'Subhadip' }}</div>
                                <div class="text-[10px] text-slate-400 mt-0.5 uppercase font-bold tracking-wider">Administrator</div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="profile-menu" class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 hidden animate-fade-in ring-1 ring-black/5">
                            <div class="px-4 py-3 border-b border-slate-50 mb-1">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Signed in as</p>
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
                            </div>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <span class="font-medium">My Profile</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="font-medium">Settings</span>
                            </a>
                            <div class="my-1.5 border-t border-slate-50"></div>
                            <form method="POST" action="/logout" class="px-2">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <span class="font-bold">Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-4 lg:p-8">
                <!-- Notifications (Toasts) -->
                @if (session('success'))
                <div class="fixed top-20 right-4 z-[99] animate-fade-in toast">
                    <div class="bg-white border-l-4 border-green-500 rounded-r-2xl shadow-2xl p-4 flex items-center gap-4 min-w-[320px] ring-1 ring-black/5">
                        <div class="h-10 w-10 shrink-0 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-800">Mission Accomplished</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.closest('.toast').remove()" class="p-1 text-slate-300 hover:text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                @if (session('error'))
                <div class="fixed top-20 right-4 z-[99] animate-fade-in toast">
                    <div class="bg-white border-l-4 border-red-500 rounded-r-2xl shadow-2xl p-4 flex items-center gap-4 min-w-[320px] ring-1 ring-black/5">
                        <div class="h-10 w-10 shrink-0 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-800">Action Required</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.closest('.toast').remove()" class="p-1 text-slate-300 hover:text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                <div class="max-w-7xl mx-auto flex flex-col gap-y-2">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <x-ui.loader />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Auto-hide toast notifications with fade-out
        document.querySelectorAll('.toast').forEach(toast => {
            setTimeout(() => {
                toast.classList.add('opacity-0', 'transition-all', 'duration-500', '-translate-y-2');
                setTimeout(() => toast.remove(), 500);
            }, 6000);
        });
    </script>
</body>

</html>