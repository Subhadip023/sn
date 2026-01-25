@props(['title' => null, 'pages' => [], 'meta' => []])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $meta['title'] ?? ($title ?? 'Sohoj News') }}</title>

    @if(isset($meta))
        @if(isset($meta['description']))
            <meta name="description" content="{{ $meta['description'] }}">
        @endif
        @if(isset($meta['keywords']))
            <meta name="keywords" content="{{ $meta['keywords'] }}">
        @endif
        @if(isset($meta['canonical']))
            <link rel="canonical" href="{{ $meta['canonical'] }}">
        @endif

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ $meta['canonical'] ?? url()->current() }}">
        <meta property="og:title" content="{{ $meta['title'] ?? ($title ?? 'Sohoj News') }}">
        <meta property="og:description" content="{{ $meta['description'] ?? '' }}">
        @if(isset($meta['og_image']))
            <meta property="og:image" content="{{ $meta['og_image'] }}">
        @endif
        @if(isset($meta['og_image_url']))
            <meta property="og:image" content="{{ $meta['og_image_url'] }}">
        @endif

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ $meta['canonical'] ?? url()->current() }}">
        <meta property="twitter:title" content="{{ $meta['title'] ?? ($title ?? 'Sohoj News') }}">
        <meta property="twitter:description" content="{{ $meta['description'] ?? '' }}">
        @if(isset($meta['og_image']))
            <meta property="twitter:image" content="{{ $meta['og_image'] }}">
        @endif
        @if(isset($meta['og_image_url']))
            <meta property="twitter:image" content="{{ $meta['og_image_url'] }}">
        @endif
    @endif
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.tailwindcss.com?plugins=typography"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-red': '#e31837',
                        'primary-blue': '#0e4e8e',
                    }
                }
            }
        }
    </script>
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

</head>



<body class="bg-white text-gray-800">
    <!-- Top Navigation -->
    <nav class="bg-gray-100 border-b border-gray-200 text-sm py-1">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex gap-4">
                <span class="cursor-pointer hover:text-primary-red transition-colors"><i class="fas fa-bolt mr-1"></i> Live TV</span>
                <span class="cursor-pointer hover:text-primary-red transition-colors"><i class="far fa-newspaper mr-1"></i> ePaper</span>
                <span onclick="showPopup();" class="cursor-pointer hover:text-primary-red transition-colors"><i class="fas fa-bell mr-1"></i> Daily Newsletter</span>
            </div>
            @auth
            <a href="{{ route('dashboard') }}">
                <span class="cursor-pointer hover:text-primary-red transition-colors"><i class="fas fa-user mr-1"></i> Dashboard</span>
            </a>
            @endauth
            @guest
            <a href="{{ route('login') }}">
                <span class="cursor-pointer hover:text-primary-red transition-colors"><i class="fas fa-sign-in-alt mr-1"></i> Sign In</span>
            </a>
            @endguest
        </div>
    </nav>

    <!-- Main Header -->
    <header class="py-4 border-b-2 border-primary-red">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="text-4xl font-bold tracking-tight">
                <span class="text-primary-red">Sohoj </span><span class="text-primary-blue">News</span>
            </div>
            <div class="text-right text-gray-600 text-sm">
                <span id="date"></span>
                <span id="time" class="ml-2"></span>
            </div>
        </div>
    </header>

    <!-- Main Navigation -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex overflow-x-auto whitespace-nowrap py-2.5 gap-5">
                <li class=""><a href="/" class="py-2.5 font-medium {{ request()->is('/') ? 'text-primary-red hover:text-gray-800 border-b-2 border-primary-red' : 'text-gray-800 hover:text-primary-red' }}   block"><i class="fas fa-home mr-1"></i> Home</a></li>
                @if(count($pages) > 0)
                    @foreach ($pages as $page)
                    <li class="{{ request()->is('page/'.$page['slug']) ? 'text-primary-red' : '' }}"><a href="/page/{{ $page['slug'] }}" class="py-2.5 font-medium {{ request()->is('page/'.$page['slug']) ? 'text-primary-red hover:text-gray-800 border-b-2 border-primary-red' : 'text-gray-800 hover:text-primary-red' }}   transition-colors block">{{ $page['title'] }}</a></li>
                    @endforeach
                @endif

            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 pt-10 pb-5 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                <div>
                    <h4 class="text-white mb-5 text-lg relative pb-2.5 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-0.5 after:bg-primary-red">Trending Topics</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">Election 2024</a></li>
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">Stock Market</a></li>
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">IPL 2024</a></li>
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">Coronavirus</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white mb-5 text-lg relative pb-2.5 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-0.5 after:bg-primary-red">Services</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">ePaper</a></li>
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">Subscribe</a></li>
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">Advertise</a></li>
                        <li><a href="#" class="hover:text-white hover:pl-1 transition-all block">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white mb-5 text-lg relative pb-2.5 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-0.5 after:bg-primary-red">Follow Us</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-red hover:-translate-y-1 transition-all"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-red hover:-translate-y-1 transition-all"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-red hover:-translate-y-1 transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary-red hover:-translate-y-1 transition-all"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10 pt-5 flex flex-wrap justify-between items-center text-sm">
                <p>&copy; 2024 News Paper. All rights reserved.</p>
                <div class="flex gap-4 mt-4 sm:mt-0">
                    <a href="#" class="hover:text-white hover:underline">Terms of Use</a>
                    <a href="#" class="hover:text-white hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:text-white hover:underline">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <x-ui.loader />

               @guest
               <x-ui.news-later />
               @endguest    

    <!-- user assert for js not vite -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>