@props([
    'href',
    'active' => false,
])

<a href="{{ $href }}"
   {{ $attributes->merge([
        'class' =>
            'flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group ' .
            ($active
                ? 'bg-brand-500 text-white font-bold shadow-lg shadow-brand-500/20'
                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-800')
   ]) }}>
    {{ $slot }}
</a>
