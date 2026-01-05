<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Brooklyns Babes')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#050505] text-gray-300 font-sans antialiased selection:bg-[#C5A059] selection:text-black overflow-x-hidden">

    <!-- Phone Number - Top Right (Desktop & Mobile) -->
    <a href="tel:01270215600"
       class="fixed top-6 right-6 md:top-8 md:right-8 z-50 flex items-center gap-2 text-[#C5A059] hover:text-white transition-colors group">
        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
        </svg>
        <span class="font-medium text-sm md:text-base tracking-wide">01270 215 600</span>
    </a>

    <!-- Desktop Sidebar Navigation -->
    <aside class="hidden md:flex fixed left-0 top-0 h-screen bg-[#0A0A0A]/80 backdrop-blur-xl border-r border-white/30 z-50 w-28 flex-col shadow-2xl shadow-black/50">

        <!-- Logo Section -->
        <div class="h-24 flex items-center justify-center border-b border-white/5 px-4">
            <a href="{{ route('home') }}"
               class="text-[#C5A059] font-serif tracking-wider hover:opacity-80 transition-opacity text-2xl">
                BB
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col flex-1 py-8">
            <a href="{{ route('home') }}"
               class="nav-link-vertical {{ request()->routeIs('home') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[9px]">Home</span>
            </a>

            <a href="{{ route('girls.index') }}"
               class="nav-link-vertical {{ request()->routeIs('girls.index') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[9px]">All Girls</span>
            </a>

            <a href="{{ route('girls.week') }}"
               class="nav-link-vertical {{ request()->routeIs('girls.week') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-[9px]">This Week</span>
            </a>

            <a href="{{ route('news.index') }}"
               class="nav-link-vertical {{ request()->routeIs('news.*') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span class="text-[9px]">News</span>
            </a>

            <a href="{{ route('contact') }}"
               class="nav-link-vertical {{ request()->routeIs('contact') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-[9px]">Contact</span>
            </a>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-white/5">
            <p class="text-[8px] text-gray-600 text-center uppercase tracking-wider">
                &copy; {{ date('Y') }}
            </p>
        </div>
    </aside>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-[#0A0A0A]/90 backdrop-blur-xl border-t border-white/10 z-50 shadow-2xl shadow-black/50">
        <div class="flex justify-around items-center h-20 px-2">
            <a href="{{ route('home') }}"
               class="nav-link-mobile {{ request()->routeIs('home') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[9px]">Home</span>
            </a>

            <a href="{{ route('girls.index') }}"
               class="nav-link-mobile {{ request()->routeIs('girls.index') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[9px]">All Girls</span>
            </a>

            <a href="{{ route('girls.week') }}"
               class="nav-link-mobile {{ request()->routeIs('girls.week') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-[9px]">Week</span>
            </a>

            <a href="{{ route('news.index') }}"
               class="nav-link-mobile {{ request()->routeIs('news.*') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span class="text-[9px]">News</span>
            </a>

            <a href="{{ route('contact') }}"
               class="nav-link-mobile {{ request()->routeIs('contact') ? 'active' : '' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-[9px]">Contact</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <div class="md:ml-28 min-h-screen flex flex-col pb-20 md:pb-0">
        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-8 border-t border-white/5 mt-auto">
            <div class="max-w-7xl mx-auto px-8 md:px-12 lg:px-16 text-center">
                <p class="text-xs uppercase tracking-widest text-gray-600">
                    &copy; {{ date('Y') }} Brooklyns Babes. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>
