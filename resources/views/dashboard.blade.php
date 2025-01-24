<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#1a3f5c] to-[#2a5f6f] text-white">
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-[#1a3f5c] border-b border-white/10">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <!-- Left Section: Logo and Navigation -->
                    <div class="flex items-center space-x-8">
                        <a href="/" class="text-2xl font-bold text-white">
                            Game<span class="text-[#5fbbd1]">LearnPro</span>
                        </a>
                        <nav class="hidden md:flex space-x-6">
                            <a href="#" class="flex items-center space-x-2 text-white hover:text-[#5fbbd1] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <span>Daily Challenges</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 text-white hover:text-[#5fbbd1] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Quick Tasks</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 text-white hover:text-[#5fbbd1] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Study Timer</span>
                            </a>
                        </nav>
                        <button id="mobileMenuBtn" class="md:hidden text-white hover:text-[#5fbbd1] transition-colors" onclick="toggleMobileMenu()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Middle Section: Search Bar -->
                    <div class="hidden md:flex flex-1 max-w-xl mx-8">
                        <div class="relative w-full">
                            <input type="text" placeholder="Search..." 
                                class="w-full bg-black/20 border border-white/10 rounded-lg py-2 px-4 text-white placeholder-white/50 focus:outline-none focus:border-[#5fbbd1] transition-colors">
                            <button class="absolute right-3 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Right Section: Notifications and Profile -->
                    <div class="flex items-center space-x-6">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-white hover:text-[#5fbbd1] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">369</span>
                            </button>
                        </div>

                        <!-- Messages -->
                        <div class="relative">
                            <button class="text-white hover:text-[#5fbbd1] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">2</span>
                            </button>
                        </div>

                        <!-- Profile -->
                        <div class="relative" x-data="{ isOpen: false, showLogoutConfirm: false }" @keydown.escape.window="isOpen = false; showLogoutConfirm = false">
                            <button @click="isOpen = !isOpen" class="flex items-center space-x-3 text-white hover:text-[#5fbbd1] transition-colors">
                                <img src="{{ url('profile-pic.png') }}" alt="Profile" class="w-8 h-8 rounded-full border-2 border-[#5fbbd1]">
                                <span>Welcome, {{ explode(' ', Auth::user()->name)[0] }}!</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="isOpen" 
                                @click.away="isOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-[#1a3f5c] rounded-lg shadow-lg border border-white/10 py-1">
                                <a href="settings" class="block px-4 py-2 text-white hover:bg-white/10 transition-colors">
                                    <div class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37.996.608 2.296.07 2.572-1.065z" />
                                        </svg>
                                        <span>Settings</span>
                                    </div>
                                </a>
                                <button @click="showLogoutConfirm = true" class="w-full text-left px-4 py-2 text-white hover:bg-white/10 transition-colors">
                                    <div class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Logout</span>
                                    </div>
                                </button>
                            </div>

                            <!-- Logout Confirmation Modal -->
                            <div x-cloak
                                x-show="showLogoutConfirm" 
                                class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0">
                                <div class="bg-[#1a3f5c] rounded-lg p-5 max-w-xs mx-4 border border-white/10"
                                    @click.away="showLogoutConfirm = false"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    <h3 class="text-lg font-bold text-white mb-3">Confirm Logout</h3>
                                    <p class="text-white/70 mb-5">Are you sure you want to log out?</p>
                                    <div class="flex justify-end space-x-3">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                                                Logout
                                            </button>
                                        </form>
                                        <button @click="showLogoutConfirm = false" 
                                            class="px-4 py-2 text-white hover:bg-white/10 rounded-lg transition-colors">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Menu Overlay -->
        <div id="mobileMenu" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[100] hidden">
            <div class="h-full w-full flex flex-col pt-20 px-6">
                <button onclick="toggleMobileMenu()" class="absolute top-4 right-4 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <nav class="flex flex-col space-y-4">
                    <a href="#" class="flex items-center space-x-2 text-white hover:text-[#5fbbd1] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <span>Daily Challenges</span>
                    </a>
                    <a href="#" class="flex items-center space-x-2 text-white hover:text-[#5fbbd1] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Quick Tasks</span>
                    </a>
                    <a href="#" class="flex items-center space-x-2 text-white hover:text-[#5fbbd1] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Study Timer</span>
                    </a>
                </nav>
                <!-- Mobile Search -->
                <div class="mt-6">
                    <div class="relative w-full">
                        <input type="text" placeholder="Search missions, rewards, or users..." 
                            class="w-full bg-black/20 border border-white/10 rounded-lg py-2 px-4 text-white placeholder-white/50 focus:outline-none focus:border-[#5fbbd1] transition-colors">
                        <button class="absolute right-3 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-black/30 backdrop-blur-md pt-20 border-r border-white/10 transition-all duration-300">
            <!-- Toggle Button -->
            <button onclick="toggleSidebar()" class="absolute -right-4 top-1/2 transform -translate-y-1/2 bg-[#1a3f5c] rounded-full p-2 border border-white/10 hover:bg-[#2a5f6f] transition-colors">
                <svg id="sidebarArrow" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <div class="flex flex-col h-full p-4">
                <!-- Profile Section -->
                <div class="text-center mb-4">
                    <div class="w-24 h-24 mx-auto mb-2 rounded-full bg-gradient-to-br from-[#3d9bd6] to-[#5fbbd1] flex items-center justify-center overflow-hidden">
                        <div class="w-24 h-24">
                            <img src="{{ url('profile-pic.png') }}" alt="Profile Picture" class="w-full h-full object-contain">
                        </div>
                    </div>
                    <h3 class="font-bold text-[#5fbbd1] mb-4">{{ Auth::user()->name }}</h3>
                    <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-lg p-4">
                        <div class="flex items-center space-x-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <h3 class="text-white">Learning Experience</h3>
                        </div>
                        <div class="space-y-2">
                            <div class="text-sm text-white/80">Level 1</div>
                            <div class="w-full bg-black/20 rounded-full h-2">
                                <div class="bg-gradient-to-r from-[#3d9bd6] to-[#5fbbd1] h-2 rounded-full" style="width: 25%"></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-white/60">250 XP</div>
                                <div class="text-xs text-white/60">1000 XP</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-1 flex-grow">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('courses') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Courses</span>
                    </a>
                    <a href="{{ route('missions') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Missions</span>
                    </a>
                    <a href="{{ route('rewards') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM17 16v2a2 2 0 01-2 2H9a2 2 0 01-2-2v-2" />
                        </svg>
                        <span>Rewards</span>
                    </a>
                    <a href="{{ route('leaderboard') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Leaderboard</span>
                    </a>
                    <a href="{{ route('community') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Community</span>
                    </a>
                    <a href="{{ route('action-center') }}" class="flex items-center space-x-3 text-white hover:bg-white/10 rounded-lg p-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Action Center</span>
                        <span class="bg-[#5fbbd1] text-xs px-2 py-1 rounded-full">New</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="mainContent" class="pt-16 pl-64 transition-all duration-300">
            <div class="p-6 space-y-6">
                <!-- Statistics Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Students -->
                    <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 hover:border-white/20 transform hover:scale-105 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/60 text-sm">Total Students</p>
                                <h3 class="text-2xl font-bold text-white mt-1">1,234</h3>
                            </div>
                            <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-400">+12%</span>
                            <span class="text-white/60 ml-2">from last month</span>
                        </div>
                    </div>

                    <!-- Active Courses -->
                    <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 hover:border-white/20 transform hover:scale-105 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/60 text-sm">Active Courses</p>
                                <h3 class="text-2xl font-bold text-white mt-1">42</h3>
                            </div>
                            <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-400">+3</span>
                            <span class="text-white/60 ml-2">new this week</span>
                        </div>
                    </div>

                    <!-- Completed Missions -->
                    <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 hover:border-white/20 transform hover:scale-105 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/60 text-sm">Completed Missions</p>
                                <h3 class="text-2xl font-bold text-white mt-1">8,567</h3>
                            </div>
                            <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-400">+25%</span>
                            <span class="text-white/60 ml-2">completion rate</span>
                        </div>
                    </div>

                    <!-- Total Points Awarded -->
                    <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 hover:border-white/20 transform hover:scale-105 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white/60 text-sm">Total Points Awarded</p>
                                <h3 class="text-2xl font-bold text-white mt-1">156.7K</h3>
                            </div>
                            <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-green-400">+18.5K</span>
                            <span class="text-white/60 ml-2">points this week</span>
                        </div>
                    </div>
                </div>

                <!-- Learning Progress Chart -->
                <div class="backdrop-blur-md bg-black bg-opacity-30 border border-white/10 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Learning Progress</h2>
                    <canvas id="learningProgressChart" class="w-full h-64"></canvas>
                    <div class="mt-4">
                        <p class="text-white/60 text-sm">Time Spent: 12h 30m</p>
                        <p class="text-white/60 text-sm">Lessons Completed: 15/20</p>
                        <p class="text-white/60 text-sm">Upcoming Tasks: 5</p>
                    </div>
                    <div class="mt-4">
                        <button class="bg-[#3d9bd6] text-white py-2 px-4 rounded hover:bg-[#5fbbd1] transition-all">
                            Provide Feedback
                        </button>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('learningProgressChart').getContext('2d');
                    const learningProgressChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                            datasets: [
                                {
                                    label: 'Percentage of Completion',
                                    data: [60, 75, 50, 80, 90, 85],
                                    backgroundColor: 'rgba(93, 187, 209, 0.5)',
                                    borderColor: 'rgba(93, 187, 209, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Lessons Completed',
                                    data: [3, 5, 2, 4, 6, 4],
                                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Time Spent (hrs)',
                                    data: [2, 3.5, 1.5, 4, 5, 3],
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Points Earned',
                                    data: [50, 70, 30, 80, 100, 60],
                                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                                    borderColor: 'rgba(255, 206, 86, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Engagement Level',
                                    data: [70, 85, 60, 90, 95, 80],
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>

            <!-- Footer -->
            <footer id="footer" class="bg-[#1a3f5c] border-t border-white/10 py-4 mt-6">
                <div class="container mx-auto px-6">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-white/60 text-sm order-2 md:order-1">
                            &copy; 2024 GameLearnPro. All rights reserved.
                        </div>
                        <nav class="flex space-x-6 order-1 md:order-2">
                            <a href="/privacy" class="text-white/60 hover:text-white text-sm transition-colors">Privacy Policy</a>
                            <a href="/terms" class="text-white/60 hover:text-white text-sm transition-colors">Terms of Service</a>
                            <a href="/contact" class="text-white/60 hover:text-white text-sm transition-colors">Contact Us</a>
                        </nav>
                    </div>
                </div>
            </footer>
        </main>

        <script>
            function toggleDropdown() {
                const dropdown = document.getElementById('profileDropdown');
                dropdown.classList.toggle('hidden');
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('profileDropdown');
                const profileButton = event.target.closest('button');
                
                if (!profileButton && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            });

            // Sidebar Toggle Function
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('mainContent');
                const arrow = document.getElementById('sidebarArrow');
                
                if (sidebar.style.left === '-16rem') {
                    // Show sidebar
                    sidebar.style.left = '0';
                    mainContent.classList.remove('pl-0');
                    mainContent.classList.add('pl-64');
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    // Hide sidebar
                    sidebar.style.left = '-16rem';
                    mainContent.classList.remove('pl-64');
                    mainContent.classList.add('pl-0');
                    arrow.style.transform = 'rotate(180deg)';
                }
            }

            function confirmLogout() {
                if (confirm('Are you sure you want to logout?')) {
                    document.getElementById('logout-form').submit();
                }
            }

            function toggleMobileMenu() {
                const mobileMenu = document.getElementById('mobileMenu');
                const body = document.body;
                
                mobileMenu.classList.toggle('hidden');
                body.classList.toggle('overflow-hidden');
            }
        </script>
    </div>
</body>
</html>