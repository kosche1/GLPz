<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GameLearnPro - Gamified Learning Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes gentle-pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        .animate-gentle-pulse {
            animation: gentle-pulse 2s infinite;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#1a3f5c] to-[#2a5f6f] text-white">
    <div class="absolute inset-0 bg-black opacity-20 z-0"></div>
    <div class="relative z-10">
        <!-- Header -->
        <header class="bg-opacity-90 backdrop-blur-md fixed w-full top-0 z-50 bg-gradient-to-r from-[#1a3f5c] to-[#2a5f6f] shadow-lg">
            <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-white">GameLearnPro</a>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-gray-300 hover:text-white transition">Features</a>
                        <a href="#courses" class="text-gray-300 hover:text-white transition">Courses</a>
                        <a href="#community" class="text-gray-300 hover:text-white transition">Community</a>
                        <a href="#about" class="text-gray-300 hover:text-white transition">About Us</a>
                        <a href="#faq" class="text-gray-300 hover:text-white transition">FAQ</a>
                        <a href="#contact" class="text-gray-300 hover:text-white transition">Contact</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white bg-[#3d9bd6] hover:bg-[#5fbbd1] px-4 py-2 rounded transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('login') }}" class="text-white bg-[#3d9bd6] hover:bg-[#5fbbd1] px-4 py-2 rounded transition">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button class="mobile-menu-button text-gray-300 hover:text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Mobile menu -->
                <div class="mobile-menu hidden md:hidden mt-4">
                    <a href="#features" class="block py-2 text-gray-300 hover:text-white transition">Features</a>
                    <a href="#courses" class="block py-2 text-gray-300 hover:text-white transition">Courses</a>
                    <a href="#community" class="block py-2 text-gray-300 hover:text-white transition">Community</a>
                    <a href="#about" class="block py-2 text-gray-300 hover:text-white transition">About Us</a>
                    <a href="#faq" class="block py-2 text-gray-300 hover:text-white transition">FAQ</a>
                    <a href="#contact" class="block py-2 text-gray-300 hover:text-white transition">Contact</a>
                </div>
            </nav>
        </header>

        <main class="relative z-20">
            <!-- Hero Section -->
            <section class="pt-40 pb-20 px-4 sm:px-6 lg:px-20">
                <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between">
                    <div class="lg:w-1/2 mb-10 lg:mb-0">
                        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-6 leading-tight">
                            Learn Through <span class="text-[#5fbbd1]">Play</span>
                        </h1>
                        <p class="text-xl sm:text-2xl mb-8 text-gray-300 max-w-xl">
                            Master new skills with our interactive educational games. Engage, challenge yourself, and grow!
                        </p>
                        <a href="{{ route('dashboard') }}" class="inline-block text-lg px-8 py-3 bg-[#3d9bd6] text-white hover:bg-[#5fbbd1] transition-all duration-300 shadow-lg rounded animate-gentle-pulse hover:animate-none hover:scale-105">
                            Start Learning Now
                        </a>
                    </div>
                    <div class="lg:w-1/2 flex justify-center">
                        <div class="w-80 h-80 rounded-full bg-gradient-to-br from-[#3d9bd6] to-[#5fbbd1] shadow-2xl flex items-center justify-center animate-float overflow-hidden">
                            <div class="w-65 h-65">
                                <img src="{{ url('GLP-LOGO.png') }}" alt="GameLearn Logo" class="w-full h-full object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-15 px-4 sm:px-6 lg:px-8">
                <div class="container mx-auto">
                    <h2 class="text-4xl font-bold text-center mb-12">
                        Why Choose <span class="text-[#5fbbd1]">GLP</span>?
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @php
                        $features = [
                            [
                                'title' => 'Interactive Learning',
                                'description' => 'Engage with dynamic content that adapts to your learning style and pace.',
                                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>'
                            ],
                            [
                                'title' => 'Progress Tracking',
                                'description' => 'Track your learning journey with detailed analytics and personalized recommendations.',
                                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>'
                            ],
                            [
                                'title' => 'Competitive Challenges',
                                'description' => 'Compete with peers in educational challenges and climb the leaderboards.',
                                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>'
                            ],
                            [
                                'title' => 'Reward System',
                                'description' => 'Earn badges, points, and unlock achievements as you master new concepts.',
                                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>'
                            ],
                            [
                                'title' => 'Social Learning',
                                'description' => 'Connect with fellow learners, form study groups, and share knowledge.',
                                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'
                            ],
                            [
                                'title' => 'Personalized Path',
                                'description' => 'Follow a customized learning journey tailored to your goals and interests.',
                                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>'
                            ]
                        ];
                        @endphp

                        @foreach($features as $feature)
                            <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-lg p-6 shadow-xl transform transition duration-500 hover:scale-105">
                                <div class="flex justify-center items-center w-16 h-16 bg-[#3d9bd6] text-white rounded-full mb-6 mx-auto">
                                    {!! $feature['icon'] !!}
                                </div>
                                <h3 class="text-2xl font-semibold text-center mb-4 text-[#5fbbd1]">{{ $feature['title'] }}</h3>
                                <p class="text-gray-300 text-center">{{ $feature['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Learning Paths -->
            <section class="py-9 px-4 sm:px-6 lg:px-8">
                <div class="container mx-auto">
                    <h2 class="text-4xl font-bold text-center mb-12">
                        Choose Your <span class="text-[#5fbbd1]">Learning Path</span>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Web Development Path -->
                        <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-lg p-6 shadow-xl transform transition duration-500 hover:scale-105">
                            <div class="flex justify-center items-center w-16 h-16 bg-[#3d9bd6] text-white rounded-full mb-6 mx-auto">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-center mb-4 text-[#5fbbd1]">Web Development</h3>
                            <ul class="space-y-3 text-gray-300">
                                <li>• HTML5, CSS3 & JavaScript</li>
                                <li>• React & Vue.js Frameworks</li>
                                <li>• Backend with PHP & Node.js</li>
                                <li>• Database Management</li>
                            </ul>
                            <p class="text-sm text-gray-400 mt-4">Master Full-Stack Development</p>
                        </div>

                        <!-- Software Engineering Path -->
                        <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-lg p-6 shadow-xl transform transition duration-500 hover:scale-105">
                            <div class="flex justify-center items-center w-16 h-16 bg-[#3d9bd6] text-white rounded-full mb-6 mx-auto">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-center mb-4 text-[#5fbbd1]">Software Engineering</h3>
                            <ul class="space-y-3 text-gray-300">
                                <li>• Python Programming</li>
                                <li>• Java Development</li>
                                <li>• C++ & Data Structures</li>
                                <li>• Software Architecture</li>
                            </ul>
                            <p class="text-sm text-gray-400 mt-4">Complete Developer Track</p>
                        </div>

                        <!-- Cybersecurity Path -->
                        <div class="backdrop-blur-md bg-black bg-opacity-30 rounded-lg p-6 shadow-xl transform transition duration-500 hover:scale-105">
                            <div class="flex justify-center items-center w-16 h-16 bg-[#3d9bd6] text-white rounded-full mb-6 mx-auto">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-center mb-4 text-[#5fbbd1]">Cybersecurity</h3>
                            <ul class="space-y-3 text-gray-300">
                                <li>• Network Security</li>
                                <li>• Ethical Hacking</li>
                                <li>• Security Tools & Scripts</li>
                                <li>• Cryptography Basics</li>
                            </ul>
                            <p class="text-sm text-gray-400 mt-4">Security Professional Path</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Game Elements Preview -->
            <section class="py-20 px-4 sm:px-6 lg:px-8 bg-black/20 backdrop-blur-sm">
                <div class="container mx-auto">
                    <h2 class="text-4xl font-bold text-center mb-16">Experience Learning Like Never Before</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- XP Points -->
                        <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl p-6 text-center transform transition hover:scale-105">
                            <div class="text-5xl font-bold mb-2">XP</div>
                            <p class="text-lg">Earn experience points as you learn</p>
                        </div>
                        <!-- Leaderboard -->
                        <div class="bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-xl p-6 text-center transform transition hover:scale-105">
                            <div class="text-5xl font-bold mb-2">🏆</div>
                            <p class="text-lg">Compete on global leaderboards</p>
                        </div>
                        <!-- Achievements -->
                        <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-xl p-6 text-center transform transition hover:scale-105">
                            <div class="text-5xl font-bold mb-2">🌟</div>
                            <p class="text-lg">Unlock special achievements</p>
                        </div>
                        <!-- Daily Challenges -->
                        <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-xl p-6 text-center transform transition hover:scale-105">
                            <div class="text-5xl font-bold mb-2">⚔️</div>
                            <p class="text-lg">Complete daily challenges</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8">
                <div class="container mx-auto backdrop-blur-md bg-black bg-opacity-30 rounded-2xl p-10 shadow-2xl">
                    <div class="text-center">
                        <h2 class="text-4xl sm:text-5xl font-bold mb-6">
                            Ready to Start Your Learning Adventure?
                        </h2>
                        <p class="text-xl mb-8 max-w-2xl mx-auto text-gray-300">
                            Join thousands of learners who are already enjoying our gamified learning experience!
                        </p>
                        <a href="#" class="inline-block text-lg px-8 py-3 bg-[#3d9bd6] text-white hover:bg-[#5fbbd1] transition-all duration-300 shadow-lg rounded animate-gentle-pulse hover:animate-none hover:scale-105">
                            Get Started for Free
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="py-8 px-4 sm:px-6 lg:px-8 backdrop-blur-md bg-black bg-opacity-40">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 mb-4 md:mb-0">
                    {{ date('Y') }} GameLearnPro. All rights reserved.
                </div>
                <nav class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-[#5fbbd1] transition-colors duration-300">About</a>
                    <a href="#" class="text-gray-400 hover:text-[#5fbbd1] transition-colors duration-300">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-[#5fbbd1] transition-colors duration-300">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-[#5fbbd1] transition-colors duration-300">Contact</a>
                </nav>
            </div>
        </footer>
    </div>

    @vite('resources/js/app.js')
</body>
</html>