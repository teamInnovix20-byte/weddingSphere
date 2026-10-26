{{-- Admin sidebar: fixed on desktop (lg+), slide-in drawer on tablet / phone --}}
@php
    $nav = [
        ['title' => 'Core', 'items' => [
            ['label' => 'Overview', 'icon' => 'layout-grid', 'href' => '#'],
            ['label' => 'Analytics & Intelligence', 'icon' => 'trending-up', 'href' => '#'],
        ]],
        ['title' => 'Directory & Governance', 'items' => [
            ['label' => 'User Management', 'icon' => 'users', 'href' => '#'],
            ['label' => 'Vendor Applications', 'icon' => 'user-check', 'href' => route('admin.vendor-applications'), 'active' => request()->routeIs('admin.vendor-applications'), 'badge' => '14', 'badgeTone' => 'gold'],
            ['label' => 'Vendor Management', 'icon' => 'store', 'href' => '#'],
            ['label' => 'Categories & Subcategories', 'icon' => 'shapes', 'href' => '#'],
        ]],
        ['title' => 'Commerce & Escrow', 'items' => [
            ['label' => 'Bookings Oversight', 'icon' => 'calendar-check', 'href' => '#'],
            ['label' => 'Payments & Escrow Ledger', 'icon' => 'landmark', 'href' => '#'],
            ['label' => 'Tax Invoices & Payouts', 'icon' => 'receipt', 'href' => '#'],
        ]],
        ['title' => 'Integrity & Compliance', 'items' => [
            ['label' => 'Reviews & Reports', 'icon' => 'message-alert', 'href' => '#', 'badge' => '3', 'badgeTone' => 'red'],
            ['label' => 'Document Vault', 'icon' => 'shield-check', 'href' => '#'],
            ['label' => 'System Activity & Audit Logs', 'icon' => 'history', 'href' => '#'],
        ]],
        ['title' => 'System', 'items' => [
            ['label' => 'Platform Settings & Fee Rules', 'icon' => 'settings', 'href' => '#'],
        ]],
    ];
@endphp

<aside id="adminSidebar"
       class="fixed inset-y-0 left-0 z-50 flex w-[260px] -translate-x-full flex-col border-r border-line/70 bg-white transition-transform duration-300 lg:w-[232px] lg:translate-x-0">

    {{-- Operations centre switcher --}}
    <div class="flex items-start justify-between bg-bg-soft px-4 pb-3 pt-3.5">
        <div class="min-w-0">
            <span class="block text-[9.5px] font-bold uppercase tracking-[.08em] text-wine-dark/80">Operations Center</span>
            <button type="button" class="mt-1 flex items-center gap-2 text-[14px] font-semibold text-wine-dark">
                <x-admin.icon name="nodes" :size="16" class="text-wine" /> Core Engine
            </button>
        </div>
        <div class="flex items-center gap-2 pt-0.5">
            <span class="size-1.5 rounded-full bg-[#2f8f5b]" title="Online"></span>
            <button type="button" class="text-muted-2 lg:hidden" data-admin-menu-close aria-label="Close menu"><x-admin.icon name="x" :size="16" /></button>
            <x-admin.icon name="chevrons-up-down" :size="13" class="hidden text-muted-2 lg:block" />
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-2.5 pb-3 pt-4" aria-label="Admin navigation">
        @foreach ($nav as $group)
            <p class="{{ $loop->first ? '' : 'mt-4' }} px-2 pb-1.5 text-[9.5px] font-semibold uppercase tracking-[.1em] text-muted-2">{{ $group['title'] }}</p>
            <ul class="space-y-0.5">
                @foreach ($group['items'] as $item)
                    @php $active = $item['active'] ?? false; @endphp
                    <li>
                        <a href="{{ $item['href'] }}" @if($active) aria-current="page" @endif
                           class="flex h-[34px] items-center gap-2.5 rounded-lg px-2.5 text-[12.5px] transition
                                  {{ $active ? 'bg-wine font-medium text-white shadow-[0_4px_10px_rgba(115,47,70,.25)]' : 'text-[#4a3a3f] hover:bg-chip hover:text-wine' }}">
                            <x-admin.icon :name="$item['icon']" :size="15" />
                            <span class="min-w-0 flex-1 truncate">{{ $item['label'] }}</span>
                            @isset($item['badge'])
                                <span class="inline-flex min-w-[18px] items-center justify-center rounded-full px-1.5 py-px text-[9.5px] font-bold
                                             {{ ($item['badgeTone'] ?? '') === 'gold' ? 'bg-gold-bg text-gold-ink' : 'bg-[#fde0e0] text-[#c43d4b]' }}">{{ $item['badge'] }}</span>
                            @endisset
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </nav>

    {{-- Security / session footer --}}
    <div class="bg-bg-soft px-3 pb-3 pt-3">
        <div class="flex items-center gap-1.5 rounded-md bg-white px-2.5 py-1.5 text-[9.5px] text-muted">
            <x-admin.icon name="lock" :size="11" /> Tier-4 PCI-DSS / AES-256 Vault Active
        </div>
        <div class="mt-2.5 flex items-end justify-between gap-2 px-0.5">
            <div class="min-w-0 text-[9.5px] leading-snug text-muted">
                <strong class="block text-[10.5px] font-semibold text-ink">Session #WSL-88204</strong>
                IP 192.241.140.2 (Secured)
            </div>
            <a href="{{ route('login') }}" class="inline-flex shrink-0 items-center gap-1 text-[10.5px] font-semibold text-ink transition hover:text-wine">
                <x-admin.icon name="log-out" :size="12" /> Exit
            </a>
        </div>
    </div>
</aside>
