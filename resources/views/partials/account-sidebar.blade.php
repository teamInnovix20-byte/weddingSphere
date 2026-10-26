{{--
    Left menu for Profile & Settings.
    Desktop: vertical card.  Phone / tablet: one scrollable row of tabs.
--}}
@php
    $section = request()->route('section');

    $items = [
        ['label' => 'Profile & Identity',       'icon' => 'id-card',      'url' => route('profile.show'),                         'active' => request()->routeIs('profile.show')],
        ['label' => 'Security & Credentials',   'icon' => 'shield-check', 'url' => route('settings.show', 'security'),            'active' => $section === 'security'],
        ['label' => 'Notification Preferences', 'icon' => 'sliders',      'url' => route('settings.show', 'notifications'),       'active' => $section === 'notifications'],
        ['label' => 'Connected Accounts',       'icon' => 'share',        'url' => route('settings.show', 'connected'),           'active' => $section === 'connected'],
        ['label' => 'Escrow Billing & VAT',     'icon' => 'landmark',     'url' => route('settings.show', 'billing'),             'active' => $section === 'billing'],
        ['label' => 'Session Management',       'icon' => 'monitor',      'url' => route('settings.show', 'sessions'),            'active' => $section === 'sessions'],
    ];
@endphp

<aside class="rounded-2xl bg-bg-soft p-3 lg:p-4">
    <p class="mb-2 hidden px-2 text-[9px] font-bold uppercase tracking-[.1em] text-muted-2 lg:block">Account &amp; Governance</p>

    <nav class="-mx-1 flex gap-1.5 overflow-x-auto px-1 pb-1 lg:mx-0 lg:flex-col lg:overflow-visible lg:px-0 lg:pb-0" aria-label="Profile and settings menu">
        @foreach ($items as $item)
            <a href="{{ $item['url'] }}"
               @if ($item['active']) aria-current="page" @endif
               class="group flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-[10px] px-3 py-2.5 text-[12.5px] font-semibold transition duration-200 lg:whitespace-normal
                      {{ $item['active']
                            ? 'bg-wine text-white shadow-md shadow-wine/25'
                            : 'text-[#4a3a3f] hover:bg-white hover:text-wine hover:shadow-sm' }}">
                <x-pf-icon :name="$item['icon']" :size="16" class="transition duration-200 group-hover:scale-110" />
                <span class="leading-tight">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- desktop only: vault + back link (from the prototype) --}}
    <div class="mt-16 hidden lg:block">
        <div class="rounded-xl bg-white/70 p-3 transition duration-200 hover:bg-white hover:shadow-sm">
            <div class="flex items-center justify-between text-[9px] font-bold uppercase tracking-[.06em] text-[#4a3a3f]">
                <span>Escrow Vault</span>
                <span class="inline-flex items-center gap-1 text-[#2f7a45]"><i class="inline-block size-1.5 rounded-full bg-[#2f7a45]"></i> Active</span>
            </div>
            <p class="mt-1.5 text-[9.5px] font-medium uppercase tracking-[.03em] text-muted">Sampath Trust #902-88-COL</p>
        </div>

        <a href="{{ route('portal.index') }}" class="mt-3 flex items-center gap-2 px-2 text-[11px] font-medium text-[#4a3a3f] transition hover:-translate-x-0.5 hover:text-wine">
            <x-pf-icon name="arrow-left" :size="13" /> Back to Public Portal
        </a>
    </div>
</aside>
