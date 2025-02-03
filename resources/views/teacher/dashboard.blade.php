@extends('layouts.teacher')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10">
        <h1 class="text-2xl font-bold text-white mb-4">Welcome Back, {{ Auth::user()->name }}!</h1>
        <p class="text-white/70">Here's an overview of your teaching activities and student progress.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Students -->
        <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/60 text-sm">Total Students</p>
                    {{-- <h3 class="text-2xl font-bold text-white mt-1">{{ $studentCount }}</h3> --}}
                </div>
                <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Courses -->
        <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/60 text-sm">Active Courses</p>
                    {{-- <h3 class="text-2xl font-bold text-white mt-1">{{ $courseCount }}</h3> --}}
                </div>
                <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Assignments -->
        <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/60 text-sm">Pending Assignments</p>
                    <h3 class="text-2xl font-bold text-white mt-1">12</h3>
                </div>
                <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Average Progress -->
        <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10 hover:bg-black/40 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/60 text-sm">Average Progress</p>
                    <h3 class="text-2xl font-bold text-white mt-1">78%</h3>
                </div>
                <div class="bg-[#5fbbd1]/20 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10">
            <h2 class="text-xl font-bold text-white mb-4">Recent Activity</h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-4 p-3 bg-white/5 rounded-lg">
                    <div class="bg-[#5fbbd1]/20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white">New student joined Python Basics</p>
                        <p class="text-white/60 text-sm">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4 p-3 bg-white/5 rounded-lg">
                    <div class="bg-[#5fbbd1]/20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white">Assignment submitted by John Doe</p>
                        <p class="text-white/60 text-sm">5 hours ago</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-black/30 backdrop-blur-md rounded-lg p-6 border border-white/10">
            <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-4">
                <button class="p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors text-left">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-white">Create Course</span>
                    </div>
                </button>
                <button class="p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors text-left">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-white">Add Assignment</span>
                    </div>
                </button>
                <button class="p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors text-left">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="text-white">Review Progress</span>
                    </div>
                </button>
                <button class="p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors text-left">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-white">Schedule Class</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection 