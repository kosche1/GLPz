<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - GameLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#1a3f5c] to-[#2a5f6f] flex items-center justify-center p-4">
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

        <!-- Logo -->
        <div class="fixed top-6 left-6">
            <a href="{{ route('welcome') }}" class="flex items-center text-2xl font-bold text-white hover:text-[#5fbbd1] transition-colors duration-300">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Game<span class="text-[#5fbbd1]">Learn</span>
            </a>
        </div>

        <!-- Main Container -->
        <div 
            x-data="{ showNotification: false, message: '', type: 'success' }"
            @notify.window="message = $event.detail.message; type = $event.detail.type || 'success'; showNotification = true; setTimeout(() => showNotification = false, 3000)"
            class="relative w-full max-w-md"
        >
            <!-- Notification Toast -->
            <div
                x-show="showNotification"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2"
                :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
                class="fixed top-20 right-4 text-white px-6 py-3 rounded-lg shadow-lg z-50"
            >
                <div class="flex items-center space-x-2">
                    <template x-if="type === 'success'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                    <span x-text="message"></span>
                </div>
            </div>

            <div class="bg-black/30 backdrop-blur-xl rounded-xl p-8">
                <div class="space-y-6">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-white mb-2">Create New Password</h2>
                        <p class="text-white/60">Please enter your new password below</p>
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

                    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="password" class="block text-sm font-medium text-white/80 mb-1">New Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                    placeholder="Enter your new password"
                                    required>
                                <button 
                                    type="button"
                                    onmousedown="showPassword('password', 'passwordIcon')"
                                    onmouseup="hidePassword('password', 'passwordIcon')"
                                    onmouseleave="hidePassword('password', 'passwordIcon')"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-white/40 hover:text-white/60">
                                    <svg id="passwordIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-white/80 mb-1">Confirm New Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password_confirmation"
                                    name="password_confirmation" 
                                    class="w-full px-4 py-2 bg-black/20 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-[#5fbbd1]"
                                    placeholder="Confirm your new password"
                                    required>
                                <button 
                                    type="button"
                                    onmousedown="showPassword('password_confirmation', 'confirmPasswordIcon')"
                                    onmouseup="hidePassword('password_confirmation', 'confirmPasswordIcon')"
                                    onmouseleave="hidePassword('password_confirmation', 'confirmPasswordIcon')"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-white/40 hover:text-white/60">
                                    <svg id="confirmPasswordIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 bg-[#3d9bd6] hover:bg-[#5fbbd1] text-white rounded-lg transition-colors duration-300 font-medium">
                            Reset Password
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-sm text-[#5fbbd1] hover:text-white transition-colors duration-300">
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
    </script>
</body>
</html>