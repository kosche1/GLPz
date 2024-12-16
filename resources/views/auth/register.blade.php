<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showPassword(inputId, iconId) {
            document.getElementById(inputId).type = 'text';
            document.getElementById(iconId).innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
        }
        function hidePassword(inputId, iconId) {
            document.getElementById(inputId).type = 'password';
            document.getElementById(iconId).innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    </script>
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
        <!-- Success Message -->
        @if (session('success'))
            <div id="success-message" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500/10 backdrop-blur-lg border border-green-500/20 rounded-lg p-4 text-green-200 max-w-md text-center z-50">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    const successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.transition = 'opacity 0.5s ease-out';
                        successMessage.style.opacity = '0';
                        setTimeout(() => successMessage.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif
        <div class="w-full max-w-md">
            <!-- Navigation Links -->
            <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-2xl p-8 shadow-2xl border border-white/10">
                <div class="text-center">
                <div class="flex rounded-lg backdrop-blur-md bg-black/20 p-1 mb-8">
                <a href="{{ route('login') }}" 
                    class="flex-1 py-2 px-4 rounded-md text-white/60 font-medium hover:text-white transition-colors duration-300 {{ request()->is('login') ? 'bg-[#3d9bd6]' : 'text-white/60 hover:text-white' }}">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                    class="flex-1 py-2 px-4 rounded-md text-white font-medium transition-colors duration-300 {{ request()->is('register') ? 'bg-[#3d9bd6]' : 'text-white/60 hover:text-white' }}">
                    Register
                </a>
            </div>
                    <div class="space-y-6">
                        <div class="text-center">
                            <div class="flex justify-center mb-6">
                                <img src="{{ url('GLP-LOGO.png') }}" alt="GLP Logo" class="h-24 w-auto">
                            </div>
                            <h2 class="text-2xl font-bold text-white mb-2">Create Account</h2>
                            <p class="text-white/60">Join our learning community today</p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                                <ul class="list-disc list-inside text-sm text-red-400">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf
                            <div>
                                <div class="flex items-center mb-1">
                                    <label for="register-name" class="text-sm font-medium text-white/80">Full Name</label>
                                </div>
                                <input 
                                    type="text" 
                                    id="register-name"
                                    name="name" 
                                    class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                    placeholder="Enter your full name"
                                    required>
                            </div>
                            <div>
                                <div class="flex items-center mb-1">
                                    <label for="register-id" class="text-sm font-medium text-white/80">School ID</label>
                                </div>
                                <input 
                                    type="text" 
                                    id="register-id"
                                    name="school_id" 
                                    class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                    placeholder="Enter your School ID"
                                    required>
                            </div>
                            <div>
                                <div class="flex items-center mb-1">
                                    <label for="register-email" class="text-sm font-medium text-white/80">Email Address</label>
                                </div>
                                <input 
                                    type="email" 
                                    id="register-email"
                                    name="email" 
                                    class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                    placeholder="Enter your email address"
                                    required>
                            </div>
                            <div>
                                <div class="flex items-center mb-1">
                                    <label for="register-password" class="text-sm font-medium text-white/80">Password</label>
                                </div>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        id="register-password"
                                        name="password" 
                                        class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                        placeholder="Enter your password"
                                        required>
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/60 hover:text-white"
                                            onmousedown="showPassword('register-password', 'registerPasswordToggleIcon')"
                                            onmouseup="hidePassword('register-password', 'registerPasswordToggleIcon')"
                                            onmouseleave="hidePassword('register-password', 'registerPasswordToggleIcon')">
                                        <svg id="registerPasswordToggleIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center mb-1">
                                    <label for="register-password-confirm" class="text-sm font-medium text-white/80">Confirm Password</label>
                                </div>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        id="register-password-confirm"
                                        name="password_confirmation" 
                                        class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                        placeholder="Confirm your password"
                                        required>
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/60 hover:text-white"
                                            onmousedown="showPassword('register-password-confirm', 'registerPasswordConfirmToggleIcon')"
                                            onmouseup="hidePassword('register-password-confirm', 'registerPasswordConfirmToggleIcon')"
                                            onmouseleave="hidePassword('register-password-confirm', 'registerPasswordConfirmToggleIcon')">
                                        <svg id="registerPasswordConfirmToggleIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="w-full py-2 bg-[#3d9bd6] hover:bg-[#5fbbd1] text-white font-bold rounded-lg transition-colors duration-300">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>