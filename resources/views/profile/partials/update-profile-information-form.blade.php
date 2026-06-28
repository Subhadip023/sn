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

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('patch')

        <div class="flex items-center gap-4 py-2">
            <div class="relative w-16 h-16 rounded-full overflow-hidden border border-slate-200 bg-slate-100 flex items-center justify-center">
                @if($user->profile_image)
                    <img id="avatar-preview" src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    <div id="avatar-placeholder" class="text-slate-400 font-semibold text-lg uppercase">{{ substr($user->name, 0, 1) }}</div>
                    <img id="avatar-preview" class="w-full h-full object-cover hidden">
                @endif
            </div>
            <div>
                <label for="profile_image" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Profile Image') }}</label>
                <input id="profile_image" name="profile_image" type="file" accept="image/*" class="text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
                @error('profile_image', 'updateProfileInformation')
                    <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

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

        <div class="space-y-1">
            <label for="position" class="block text-sm font-medium text-slate-700">{{ __('Position / Designation') }}</label>
            <input id="position" name="position" type="text" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" value="{{ old('position', $user->position) }}" placeholder="e.g. Senior Technology Writer, Guest Author">
            @error('position', 'updateProfileInformation')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="short_desc" class="block text-sm font-medium text-slate-700">{{ __('Short Description') }}</label>
            <textarea id="short_desc" name="short_desc" rows="3" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" placeholder="Write a short description about yourself...">{{ old('short_desc', $user->short_desc) }}</textarea>
            @error('short_desc', 'updateProfileInformation')
                <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
            @enderror
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
