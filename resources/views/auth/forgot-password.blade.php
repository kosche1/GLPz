<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#1a3f5c] to-[#2a5f6f] flex items-center justify-center p-4">
        <!-- Logo -->
        <div class="fixed top-6 left-6">
            <a href="{{ route('welcome') }}" class="flex items-center text-2xl font-bold text-white hover:text-[#5fbbd1] transition-colors duration-300">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Game<span class="text-[#5fbbd1]">Learn</span>
            </a>
        </div>

        <div class="w-full max-w-md">
            <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-2xl p-8 shadow-2xl border border-white/10">
                <div class="space-y-6">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-white mb-2">Reset Password</h2>
                        <p class="text-white/60">
                            Enter your School ID and email to reset your password
                        </p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Error Message -->
                    @if ($errors->has('verification'))
                        <div class="p-4 bg-red-500/10 border-l-4 border-red-500 text-red-400">
                            <p class="font-medium">{{ $errors->first('verification') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.verify') }}" class="space-y-4">
                        @csrf

                        <!-- School ID -->
                        <div>
                            <label for="school_id" class="block text-sm font-medium text-gray-300 mb-1">School ID</label>
                            <input id="school_id" 
                                   type="text" 
                                   name="school_id" 
                                   value="{{ old('school_id') }}" 
                                   required 
                                   autofocus
                                   class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:border-[#5fbbd1] focus:ring focus:ring-[#5fbbd1]/50 transition-colors duration-300" />
                            @error('school_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required
                                   class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:border-[#5fbbd1] focus:ring focus:ring-[#5fbbd1]/50 transition-colors duration-300" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" 
                                    class="w-full py-3 px-4 bg-[#3d9bd6] hover:bg-[#5fbbd1] text-white rounded-lg transition-colors duration-300 font-medium flex items-center justify-center">
                                Verify Identity
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition-colors duration-300">
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>