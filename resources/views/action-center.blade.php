@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#1a3f5c] to-[#2a5f6f] rounded-lg p-8 mb-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl font-bold text-white mb-4">Welcome to the Action Center</h1>
                <p class="text-white/70">Your hub for gamified learning experiences and challenges!</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-center">
                    <div class="text-4xl font-bold text-[#5fbbd1]">{{ $user->experience }}</div>
                    <div class="text-white/70">Total XP</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-[#5fbbd1]">{{ $currentLevel->level }}</div>
                    <div class="text-white/70">Current Level</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Level Progress -->
        <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-4">Level Progress</h2>
            <div class="mb-4">
                <div class="flex justify-between text-sm text-white/70 mb-2">
                    <span>Level {{ $currentLevel->level }}</span>
                    <span>Level {{ $nextLevel ? $nextLevel->level : $currentLevel->level }}</span>
                </div>
                <div class="w-full bg-black/20 rounded-full h-2">
                    @php
                        $progress = $nextLevel 
                            ? (($user->experience - $currentLevel->next_level_experience) / ($nextLevel->next_level_experience - $currentLevel->next_level_experience)) * 100
                            : 100;
                    @endphp
                    <div class="bg-gradient-to-r from-[#3d9bd6] to-[#5fbbd1] h-2 rounded-full" 
                         style="width: {{ $progress }}%"></div>
                </div>
            </div>
            <p class="text-white/70 text-sm">
                @if($nextLevel)
                    {{ $nextLevel->next_level_experience - $user->experience }} XP needed for next level
                @else
                    Maximum level reached!
                @endif
            </p>
        </div>

        <!-- Recent Achievements -->
        <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
            <h2 class="text-xl font-bold text-white mb-4">Recent Achievements</h2>
            <div class="space-y-4">
                @forelse($userAchievements->take(3) as $achievement)
                    <div class="flex items-center space-x-4">
                        @if($achievement->image)
                            <img src="{{ $achievement->image }}" alt="{{ $achievement->name }}" class="w-12 h-12 rounded-lg">
                        @else
                            <div class="w-12 h-12 bg-[#5fbbd1]/20 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5fbbd1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-white font-semibold">{{ $achievement->name }}</h3>
                            <p class="text-white/70 text-sm">{{ $achievement->description }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-white/70">No achievements yet. Start completing activities to earn them!</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Available Activities -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Quests -->
        <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">Daily Quests</h2>
                <span class="bg-[#5fbbd1] text-xs px-2 py-1 rounded-full">3 Available</span>
            </div>
            <div class="space-y-4">
                <a href="#" class="block bg-black/20 rounded-lg p-4 hover:bg-black/30 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Complete Chapter 1 Quiz</h3>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/70">Reward:</span>
                        <span class="text-[#5fbbd1]">100 XP</span>
                    </div>
                </a>
                <a href="#" class="block bg-black/20 rounded-lg p-4 hover:bg-black/30 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Study for 30 Minutes</h3>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/70">Reward:</span>
                        <span class="text-[#5fbbd1]">50 XP</span>
                    </div>
                </a>
                <a href="#" class="block bg-black/20 rounded-lg p-4 hover:bg-black/30 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Complete Practice Exercise</h3>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/70">Reward:</span>
                        <span class="text-[#5fbbd1]">75 XP</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Challenges -->
        <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">Weekly Challenges</h2>
                <span class="bg-[#5fbbd1] text-xs px-2 py-1 rounded-full">2 Active</span>
            </div>
            <div class="space-y-4">
                <a href="#" class="block bg-black/20 rounded-lg p-4 hover:bg-black/30 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Complete All Chapter Tests</h3>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-white/70">Progress:</span>
                        <span class="text-[#5fbbd1]">2/5 Complete</span>
                    </div>
                    <div class="w-full bg-black/20 rounded-full h-2">
                        <div class="bg-[#5fbbd1] h-2 rounded-full" style="width: 40%"></div>
                    </div>
                </a>
                <a href="#" class="block bg-black/20 rounded-lg p-4 hover:bg-black/30 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Achieve 90% Accuracy</h3>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-white/70">Progress:</span>
                        <span class="text-[#5fbbd1]">85% Current</span>
                    </div>
                    <div class="w-full bg-black/20 rounded-full h-2">
                        <div class="bg-[#5fbbd1] h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Special Events -->
        <div class="bg-white/10 backdrop-blur-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-white">Special Events</h2>
                <span class="bg-[#5fbbd1] text-xs px-2 py-1 rounded-full">1 Active</span>
            </div>
            <div class="space-y-4">
                <div class="bg-black/20 rounded-lg p-4 border border-[#5fbbd1]/30">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-white font-semibold">Weekend XP Boost</h3>
                        <span class="text-[#5fbbd1] text-sm">2X XP</span>
                    </div>
                    <p class="text-white/70 text-sm mb-3">Complete any activity this weekend to earn double XP!</p>
                    <div class="flex justify-between text-sm">
                        <span class="text-white/70">Time Remaining:</span>
                        <span class="text-[#5fbbd1]">1d 12h 30m</span>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="text-white/70 text-sm">More events coming soon!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 