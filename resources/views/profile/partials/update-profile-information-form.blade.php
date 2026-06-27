<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div class="space-y-1">
            <label for="name" class="block text-sm font-medium text-slate-700">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name', 'updateProfileInformation')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-slate-700">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email', 'updateProfileInformation')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 rounded-lg bg-amber-50 border border-amber-200 text-amber-800 text-sm">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="font-semibold underline hover:text-amber-950 ml-1">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 font-semibold text-green-700 text-xs">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-5 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold shadow-sm transition-colors">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium"
                >{{ __('Saved successfully.') }}</p>
            @endif
        </div>
    </form>
</section>
