@props([
    'href',
    'active' => false,
])

<a href="{{ $href }}"
   class="block px-3 py-2 rounded-lg text-sm transition-colors
          {{ $active
                ? 'text-brand-600 font-bold bg-brand-50/50'
                : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
    {{ $slot }}
</a>
