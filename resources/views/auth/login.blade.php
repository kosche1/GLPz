<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        <!-- Auth Card -->
        <div class="w-full max-w-md">
            <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-2xl p-8 shadow-2xl border border-white/10">
                <!-- Toggle Buttons -->
                <div class="flex rounded-lg backdrop-blur-md bg-black/20 p-1 mb-8">
                    <a href="{{ route('login') }}" 
                        class="flex-1 py-2 px-4 rounded-md text-white font-medium transition-colors duration-300 {{ request()->is('login') ? 'bg-[#3d9bd6]' : 'text-white/60 hover:text-white' }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                        class="flex-1 py-2 px-4 rounded-md text-white/60 font-medium hover:text-white transition-colors duration-300 {{ request()->is('register') ? 'bg-[#3d9bd6]' : 'text-white/60 hover:text-white' }}">
                        Register
                    </a>
                </div>

                <!-- Login Form -->
                <div id="loginForm" class="space-y-6">
                    <div class="text-center">
                        <div class="flex justify-center mb-6">
                            <img src="{{ url('GLP-LOGO.png') }}" alt="GLP Logo" class="h-24 w-auto">
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Welcome Back!</h2>
                        <p class="text-white/60">Log in to continue your learning journey</p>
                    </div>

                    @if ($errors->has('login'))
                        <div class="mb-4 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                            <ul class="list-disc list-inside text-sm text-red-400">
                                @foreach ($errors->get('login') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div x-data="{ loading: false }">
                        <form @submit.prevent="loading = true; setTimeout(() => $el.submit(), 1500)" 
                              method="POST" 
                              action="{{ route('login.authenticate') }}" 
                              class="space-y-4">
                            @csrf
                            <div>
                                <label for="login" class="block text-sm font-medium text-white/80 mb-2">School ID or Email</label>
                                <div class="relative">
                                    <input 
                                        id="login" 
                                        name="login" 
                                        type="text" 
                                        value="{{ old('login') }}" 
                                        required
                                        class="w-full py-2 px-3 rounded-lg bg-white/10 text-white focus:outline-none focus:ring focus:ring-white/20"
                                    >
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-white/80 mb-1">Password</label>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        class="w-full py-2 px-3 rounded-lg bg-white/10 text-white focus:outline-none focus:ring focus:ring-white/20"
                                        required
                                    >
                                    <button 
                                        type="button"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/60 hover:text-white"
                                        onmousedown="showPassword('password', 'passwordToggleIcon')"
                                        onmouseup="hidePassword('password', 'passwordToggleIcon')"
                                        onmouseleave="hidePassword('password', 'passwordToggleIcon')">
                                        <svg id="passwordToggleIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-sm text-red-400">Incorrect password</span>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/10 bg-black/20 text-[#5fbbd1] focus:ring-[#5fbbd1]">
                                    <span class="ml-2 text-sm text-white/60">Remember me</span>
                                </label>
                                <a href="#" onclick="showForgotPasswordForm(event)" class="text-sm text-[#5fbbd1] hover:text-white transition-colors duration-300">Forgot password?</a>
                            </div>

                            <button 
                                type="submit" 
                                class="w-full py-3 px-4 bg-[#3d9bd6] hover:bg-[#5fbbd1] text-white rounded-lg transition-colors duration-300 font-medium flex items-center justify-center space-x-2"
                                :class="{ 'opacity-75 cursor-wait': loading }"
                                :disabled="loading">
                                <span x-show="!loading">Login</span>
                                <span x-show="loading" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Confirming...
                                </span>
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Forgot Password Form -->
                <div id="forgotPasswordForm" class="hidden space-y-6">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-white mb-2">Reset Password</h2>
                        <p class="text-white/60">Enter your School ID and email to reset your password</p>
                    </div>

                    <form method="POST" action="{{ route('password.verify') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="forgot-school-id" class="block text-sm font-medium text-white/80 mb-1">School ID</label>
                            <input 
                                type="text" 
                                id="forgot-school-id"
                                name="school_id" 
                                class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                placeholder="Enter your School ID"
                                required>
                        </div>

                        <div>
                            <label for="forgot-email" class="block text-sm font-medium text-white/80 mb-1">Email</label>
                            <input 
                                type="email" 
                                id="forgot-email"
                                name="email" 
                                class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                placeholder="Enter your email address"
                                required>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 bg-[#3d9bd6] hover:bg-[#5fbbd1] text-white rounded-lg transition-colors duration-300 font-medium">
                            Verify Identity
                        </button>

                        <div class="text-center">
                            <a href="#" onclick="showLoginForm()" class="text-sm text-[#5fbbd1] hover:text-white transition-colors duration-300">
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('notification'))
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        message: '{{ session('notification')['message'] }}',
                        type: '{{ session('notification')['type'] }}'
                    }
                }));
            @endif
        });
    </script>

    <script>
        function switchForm(form) {
            const loginForm = document.getElementById('loginForm');
            const forgotPasswordForm = document.getElementById('forgotPasswordForm');

            if (form === 'login') {
                loginForm.classList.remove('hidden');
                forgotPasswordForm.classList.add('hidden');
            } else {
                loginForm.classList.add('hidden');
                forgotPasswordForm.classList.remove('hidden');
            }
        }

        function showLoginForm() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('forgotPasswordForm').classList.add('hidden');
        }

        function showForgotPasswordForm(event) {
            event.preventDefault();
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('forgotPasswordForm').classList.remove('hidden');
        }

        function showPassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
        }

        function hidePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }

        document.querySelectorAll('.logout-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm('Are you sure you want to logout?')) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
    
</body>
</html>