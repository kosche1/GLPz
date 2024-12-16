<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="backdrop-blur-md bg-black/30 border border-white/10 overflow-hidden shadow-xl rounded-lg">
                <div class="p-6">
                    <!-- Profile Header -->
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                        <!-- Profile Picture Section -->
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-[#5fbbd1]">
                                <img id="profileImage" src="{{ asset('images/default-avatar.png') }}" 
                                     alt="Profile Picture" class="w-full h-full object-cover">
                            </div>
                            <label for="profilePicture" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 rounded-full cursor-pointer transition-opacity">
                                <span>Change Photo</span>
                            </label>
                            <input type="file" id="profilePicture" name="profile_picture" class="hidden" accept="image/*">
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-white">Your Name</h1>
                            <p class="text-[#5fbbd1]">Level 15 Learner</p>
                            <div class="mt-2 flex items-center space-x-4">
                                <span class="text-white/60">Total Points: 2,450</span>
                                <span class="text-white/60">Completed Missions: 28</span>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-black/20 rounded-lg p-4 border border-white/10">
                            <h3 class="text-lg font-semibold text-white">Achievements</h3>
                            <p class="text-2xl font-bold text-[#5fbbd1] mt-2">12</p>
                            <p class="text-white/60 text-sm">Unlocked</p>
                        </div>
                        <div class="bg-black/20 rounded-lg p-4 border border-white/10">
                            <h3 class="text-lg font-semibold text-white">Current Streak</h3>
                            <p class="text-2xl font-bold text-[#5fbbd1] mt-2">7 Days</p>
                            <p class="text-white/60 text-sm">Personal Best: 15 Days</p>
                        </div>
                        <div class="bg-black/20 rounded-lg p-4 border border-white/10">
                            <h3 class="text-lg font-semibold text-white">Learning Hours</h3>
                            <p class="text-2xl font-bold text-[#5fbbd1] mt-2">45.5</p>
                            <p class="text-white/60 text-sm">This Month</p>
                        </div>
                    </div>

                    <!-- Profile Settings -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-white mb-4">Profile Settings</h3>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-white/60 mb-2" for="name">Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full bg-black/20 border border-white/10 rounded-lg py-2 px-4 text-white placeholder-white/50 focus:outline-none focus:border-[#5fbbd1] transition-colors"
                                    placeholder="Enter your name">
                            </div>
                            <div>
                                <label class="block text-white/60 mb-2" for="email">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full bg-black/20 border border-white/10 rounded-lg py-2 px-4 text-white placeholder-white/50 focus:outline-none focus:border-[#5fbbd1] transition-colors"
                                    placeholder="Enter your email">
                            </div>
                            <div>
                                <label class="block text-white/60 mb-2" for="bio">Bio</label>
                                <textarea id="bio" name="bio" rows="3"
                                    class="w-full bg-black/20 border border-white/10 rounded-lg py-2 px-4 text-white placeholder-white/50 focus:outline-none focus:border-[#5fbbd1] transition-colors"
                                    placeholder="Tell us about yourself..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-[#5fbbd1] hover:bg-[#4da9bf] text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Profile picture preview
        document.getElementById('profilePicture').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
    @endpush
</x-app-layout>
