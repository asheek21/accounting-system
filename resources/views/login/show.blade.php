<x-guest-layout title="Account Hub - Login">
    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-primary-600 mb-2">Account Hub</h1>
            <p class="text-gray-600">Sign in to manage your Finances</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                        autocomplete="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition text-black"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                        autocomplete="current-password"
                        class="text-black w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember"
                            class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                        >
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-sm hover:shadow-md"
                >
                    Sign In
                </button>
                
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-8">
            © {{ date('Y') }} Account Hub. All rights reserved.
        </p>
    </div>
</x-guest-layout>