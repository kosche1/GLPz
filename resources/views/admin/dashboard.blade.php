@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#1a3f5c] to-[#2a5f6f] text-white">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#1a3f5c] border-b border-white/10">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Left: Logo -->
                <div class="flex items-center space-x-8">
                    <div class="text-2xl font-bold text-white">
                        Game<span class="text-[#5fbbd1]">LearnPro</span> - Admin
                    </div>
                </div>

                <!-- Right: Profile and Logout -->
                <div class="flex items-center space-x-6">
                    <!-- Profile Dropdown -->
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
                        <div x-show="showLogoutConfirm" 
                            class="fixed inset-0 z-50 overflow-y-auto" 
                            x-cloak>
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
                                <div class="relative bg-[#1a3f5c] rounded-lg max-w-md w-full p-6 border border-white/10"
                                    @click.away="showLogoutConfirm = false"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    <div class="text-center">
                                        <h3 class="text-xl font-medium text-white mb-4">Confirm Logout</h3>
                                        <p class="text-white/70 mb-6">Are you sure you want to logout?</p>
                                        <div class="flex justify-center space-x-4">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
                                                    Yes, Logout
                                                </button>
                                            </form>
                                            <button @click="showLogoutConfirm = false" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16 px-6">
        <div class="container mx-auto">
            <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10">
                <h2 class="text-2xl font-bold mb-4">Welcome to Admin Panel</h2>
                <!-- Add your admin dashboard content here -->
            </div>
        </div>
    </main>
</div>
@endsection
