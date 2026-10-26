{{--
    Small rounded label ("Bride", "Active", "Fully Compliant" ...).
    Usage:  <x-pf-chip tone="green">Active</x-pf-chip>
    tone = green | gold | gray | wine
--}}
@props(['tone' => 'gray'])
@php
    $tones = [
        'green' => 'bg-[#b9f1b4] text-[#1f5a2c]',
        'gold'  => 'bg-[#fde7a8] text-[#6b4c0a]',
        'gray'  => 'bg-[#efe5e3] text-[#4a3a3f]',
        'wine'  => 'bg-wine-dark text-white',
    ];
@endphp
<span {{ $attributes->class(['inline-flex items-center gap-1 whitespace-nowrap rounded-full px-2.5 py-1 text-[9.5px] font-bold leading-none', $tones[$tone] ?? $tones['gray']]) }}>{{ $slot }}</span>
