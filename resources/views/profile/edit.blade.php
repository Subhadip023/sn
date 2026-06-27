@php
    $layout = auth()->user()->role === 0 ? 'user-layout' : 'admin-layout';
@endphp

<x-dynamic-component :component="$layout" title="My Profile">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">My Profile</h1>
    </header>

    <div class="grid grid-cols-1 gap-6 max-w-4xl">
        <!-- Profile Info -->
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @include('profile.partials.update-profile-information-form')
        </section>

        <!-- Update Password -->
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @include('profile.partials.update-password-form')
        </section>

        <!-- Delete User -->
        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @include('profile.partials.delete-user-form')
        </section>
    </div>
</x-dynamic-component>
