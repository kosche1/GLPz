<header class="fixed w-full top-0 z-50 bg-gradient-to-r from-[#1a3f5c] to-[#2a5f6f] shadow-lg">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <!-- Logo and Name -->
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    <svg class="w-10 h-10 text-[#5fbbd1]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L1 12h3v9h6v-6h4v6h6v-9h3L12 2zm0 3.5L18 10v8h-2v-6H8v6H6v-8l6-4.5z"/>
                    </svg>
                    <span class="text-2xl font-bold bg-gradient-to-r from-white to-[#5fbbd1] text-transparent bg-clip-text">GameLearnPro</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/about') }}" class="text-white/80 hover:text-white transition-colors">About</a>
                <a href="{{ url('/features') }}" class="text-white/80 hover:text-white transition-colors">Features</a>
                <a href="{{ url('/contact') }}" class="text-white/80 hover:text-white transition-colors">Contact</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white/80 hover:text-white transition-colors">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-white transition-colors">Logout</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="px-4 py-2 rounded-lg bg-[#3d9bd6] text-white hover:bg-[#5fbbd1] transition-colors">Login</a>
                @endauth
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4">
            <div class="flex flex-col space-y-4">
                <a href="{{ url('/about') }}" class="text-white/80 hover:text-white transition-colors">About</a>
                <a href="{{ url('/features') }}" class="text-white/80 hover:text-white transition-colors">Features</a>
                <a href="{{ url('/contact') }}" class="text-white/80 hover:text-white transition-colors">Contact</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white/80 hover:text-white transition-colors">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-white transition-colors">Logout</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="px-4 py-2 rounded-lg bg-[#3d9bd6] text-white hover:bg-[#5fbbd1] transition-colors inline-block w-fit">Login</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    }
</script>
