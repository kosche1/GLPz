@extends('layouts.teacher')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-white">My Classes</h2>
        <button class="bg-[#5fbbd1] hover:bg-[#4da9bf] text-white px-4 py-2 rounded-lg transition-colors">
            Add New Class
        </button>
    </div>

    <!-- Classes Table -->
    <div class="bg-black/30 backdrop-blur-md rounded-lg border border-white/10">
        <div class="overflow-x-auto">
            <table class="w-full text-white">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="px-6 py-4 text-left">Subject</th>
                        <th class="px-6 py-4 text-left">Students</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-white/10 hover:bg-white/5">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="bg-[#5fbbd1]/20 p-2 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <span>Mathematics 101</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">32 Students</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-500/10 text-green-500 px-3 py-1 rounded-full text-sm">Active</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end space-x-3">
                                <button class="text-[#5fbbd1] hover:text-[#4da9bf]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button class="text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 