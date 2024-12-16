@extends('layouts.superadmin')

@section('content')
<div class="container mx-auto px-4 pt-0" x-data="{ showLogoutConfirm: false }">
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

    <!-- Main Content -->
    <main class="pt-16 px-6">
        <div class="container mx-auto">
            <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10">
                <h2 class="text-2xl font-bold mb-4">Welcome to Super Admin Panel</h2>
                <!-- Add your super admin dashboard content here -->
            </div>
        </div>
    </main>
</div>
@endsection
