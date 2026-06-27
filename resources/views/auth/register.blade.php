<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900 mt-2">Create an account</h2>
        <p class="text-sm text-slate-500 mt-1">Get started with your {{ config('app.name', 'Laravel') }} profile</p>
    </x-slot>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700">Full Name</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   class="mt-1.5 block w-full px-3 py-2 border border-slate-300 rounded-lg text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm shadow-sm transition duration-150 ease-in-out" 
                   placeholder="John Doe" />
            @if ($errors->has('name'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username" 
                   class="mt-1.5 block w-full px-3 py-2 border border-slate-300 rounded-lg text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm shadow-sm transition duration-150 ease-in-out" 
                   placeholder="you@example.com" />
            @if ($errors->has('email'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password" 
                   class="mt-1.5 block w-full px-3 py-2 border border-slate-300 rounded-lg text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm shadow-sm transition duration-150 ease-in-out" 
                   placeholder="••••••••" />
            @if ($errors->has('password'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirm Password</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password" 
                   class="mt-1.5 block w-full px-3 py-2 border border-slate-300 rounded-lg text-slate-900 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm shadow-sm transition duration-150 ease-in-out" 
                   placeholder="••••••••" />
            @if ($errors->has('password_confirmation'))
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-brand-600 hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition duration-150 ease-in-out">
                Register
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-sm text-slate-600">
                Already registered? 
                <a href="{{ route('login') }}" class="font-semibold text-brand-600 hover:text-brand-500 transition duration-150 ease-in-out">
                    Log in here
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
