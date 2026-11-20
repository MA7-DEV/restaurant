<x-layouts.app title="My Profile - GustoBite">

    <div class="min-h-screen bg-cream dark:bg-royal-800 py-12 transition-colors duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in-up">

            <div class="text-center mb-10">
                <h1 class="text-4xl font-serif text-brown dark:text-white mb-2">My Profile</h1>
                <p class="text-gray-500">Manage your account settings and preferences.</p>
            </div>

            <div class="space-y-6">

                <!-- 1. Update Profile Information -->
                <div class="bg-white dark:bg-royal-900 rounded-2xl p-6 md:p-8 shadow-lg border border-gold-500/10">
                    <h2 class="text-xl font-serif text-brown dark:text-white mb-6">Profile Information</h2>
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0 transition-all">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0 transition-all">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 px-6 py-3 rounded-xl font-bold hover:shadow-lg transition-all">
                            Save Changes
                        </button>
                    </form>
                </div>

                <!-- 2. Update Password -->
                <div class="bg-white dark:bg-royal-900 rounded-2xl p-6 md:p-8 shadow-lg border border-gold-500/10">
                    <h2 class="text-xl font-serif text-brown dark:text-white mb-6">Update Password</h2>
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                            <input type="password" name="current_password" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0 transition-all">
                            @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0 transition-all">
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-royal-700 bg-gray-50 dark:bg-royal-800 text-gray-800 dark:text-white focus:border-gold-500 focus:ring-0 transition-all">
                        </div>

                        <button type="submit" class="bg-gradient-to-r from-gold-600 to-gold-500 text-royal-900 px-6 py-3 rounded-xl font-bold hover:shadow-lg transition-all">
                            Update Password
                        </button>
                    </form>
                </div>

                <!-- 3. Delete Account -->
                <div class="bg-white dark:bg-royal-900 rounded-2xl p-6 md:p-8 shadow-lg border border-red-500/10">
                    <h2 class="text-xl font-serif text-red-500 mb-2">Delete Account</h2>
                    <p class="text-sm text-gray-500 mb-4">Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 px-6 py-3 rounded-xl font-bold hover:bg-red-100 dark:hover:bg-red-500/20 transition-all">
                            Delete Account
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-layouts.app>