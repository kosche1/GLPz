<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Teacher Dashboard</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#1a3f5c] to-[#2a5f6f]">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 h-screen w-64 bg-black/30 backdrop-blur-md border-r border-white/10 pt-16">
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('teacher.subjects') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors {{ request()->routeIs('teacher.subjects') ? 'bg-white/10' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Classes</span>
                    </a>

                    <a href="{{ route('teacher.activities.index') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors {{ request()->routeIs('teacher.activities.index') ? 'bg-white/10' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Activities</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 h-16 bg-black/30 backdrop-blur-md border-b border-white/10 z-50">
            <div class="flex items-center justify-between h-full px-6 ml-64">
                <h1 class="text-xl font-bold">Game<span class="text-[#5fbbd1]">LearnPro</span> - Teacher</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-white/70">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/70 hover:text-white transition-colors">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="pt-16 pl-64">
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html> 