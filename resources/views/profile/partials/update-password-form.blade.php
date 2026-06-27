<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-slate-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div class="space-y-1">
            <label for="update_password_current_password" class="block text-sm font-medium text-slate-700">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="update_password_password" class="block text-sm font-medium text-slate-700">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-5 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold shadow-sm transition-colors">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
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
