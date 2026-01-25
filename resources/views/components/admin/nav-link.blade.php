@props([
    'href',
    'active' => false,
])

<a href="{{ $href }}"
   {{ $attributes->merge([
        'class' =>
            'block px-3 py-2 rounded-lg ' .
            ($active
                ? 'bg-slate-100 text-brand-600'
                : 'hover:bg-slate-50 text-slate-600')
   ]) }}>
    {{ $slot }}
</a>
