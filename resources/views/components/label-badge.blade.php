@props(['label'])

@php
    $colorClass = match (crc32($label->name) % 10) {
        0 => 'bg-blue-100 text-blue-800',
        1 => 'bg-sky-100 text-sky-800',
        2 => 'bg-indigo-100 text-indigo-800',
        3 => 'bg-violet-100 text-violet-800',
        4 => 'bg-teal-100 text-teal-800',
        5 => 'bg-emerald-100 text-emerald-800',
        6 => 'bg-cyan-100 text-cyan-800',
        7 => 'bg-amber-100 text-amber-800',
        8 => 'bg-rose-100 text-rose-800',
        9 => 'bg-fuchsia-100 text-fuchsia-800',
    };
@endphp

<div @class(['label-badge', $colorClass])>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
    </svg>
    {{ $label->name }}
</div>
