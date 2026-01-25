@props([
    'title',
    'active' => false,
])

<div class="{{ $active ? 'bg-slate-100 text-brand-600' : 'hover:bg-slate-50 text-slate-600' }} rounded-lg">
    <button
        type="button"
        class="w-full flex items-center justify-between px-3 py-2 rounded-lg
               {{ $active ? 'bg-slate-100 text-brand-600' : 'hover:bg-slate-50 text-slate-600' }}"
        onclick="this.nextElementSibling.classList.toggle('hidden');
                 this.querySelector('svg').classList.toggle('rotate-180')"
    >
        <span>{{ $title }}</span>

        <svg class="w-4 h-4 transition-transform duration-200 {{ $active ? 'rotate-180' : '' }}"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div class="{{ $active ? '' : 'hidden' }} pl-4 mt-1 space-y-1">
        {{ $slot }}
    </div>
</div>
