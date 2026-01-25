@props([
    'href',
    'active' => false,
])

<a href="{{ $href }}"
   class="block px-3 py-2 rounded-lg
          {{ $active
                ? 'text-brand-600 font-medium'
                : 'text-slate-500 hover:text-slate-700' }}">
    {{ $slot }}
</a>
