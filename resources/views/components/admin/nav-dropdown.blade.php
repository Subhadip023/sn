@props([
    'title',
    'active' => false,
])

<div class="group">
    <button
        type="button"
        class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200
               {{ $active 
                    ? 'bg-brand-50 text-brand-600 font-bold' 
                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800' }}"
        onclick="this.nextElementSibling.classList.toggle('hidden');
                 this.querySelector('.arrow-icon').classList.toggle('rotate-180')"
    >
        <div class="flex items-center gap-3">
            @if(isset($icon))
                <div class="{{ $active ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600' }}">
                    {{ $icon }}
                </div>
            @endif
            <span class="sidebar-text">{{ $title }}</span>
        </div>

        <svg class="arrow-icon w-4 h-4 transition-transform duration-300 {{ $active ? 'rotate-180' : '' }} sidebar-text"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div class="{{ $active ? '' : 'hidden' }} mt-1 space-y-1 pl-11 pr-2 sidebar-text">
        {{ $slot }}
    </div>
</div>
