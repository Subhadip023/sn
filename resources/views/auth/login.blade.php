<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900 mt-2">Welcome back</h2>
        <p class="text-sm text-slate-500 mt-1">Sign in to manage your {{ config('app.name', 'Laravel') }} account</p>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   class="mt-1.5 block w-full px-3 py-2 border border-slate-300 rounded-lg text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm shadow-sm transition duration-150 ease-in-out" 
                   placeholder="you@example.com" />
            @if ($errors->has('email'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                @if (Route::has('password.request'))
                <a class="text-xs font-semibold text-brand-600 hover:text-brand-500 transition duration-150 ease-in-out" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
                @endif
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password" 
                   class="mt-1.5 block w-full px-3 py-2 border border-slate-300 rounded-lg text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm shadow-sm transition duration-150 ease-in-out" 
                   placeholder="••••••••" />
            @if ($errors->has('password'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                <span class="ml-2 text-sm text-slate-600">Remember me</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-brand-600 hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition duration-150 ease-in-out">
                Log in
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-sm text-slate-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-semibold text-brand-600 hover:text-brand-500 transition duration-150 ease-in-out">
                    Register here
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>