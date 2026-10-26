{{-- Responsive Collapsible Sidebar for WeddingSphere Dashboard --}}
<aside id="dashboard-sidebar"
       class="fixed inset-y-0 left-0 z-50 flex flex-col border-r border-line bg-[#fbf5f3] transition-all duration-300 ease-in-out -translate-x-full lg:translate-x-0"
       aria-label="Dashboard Sidebar">

    {{-- Top: Brand Logo & Status Badge --}}
    <div class="px-4 pt-4 pb-3 flex flex-col gap-3 transition-all duration-300">
        {{-- Header row with Logo and Collapse Toggle --}}
        <div class="flex items-center justify-between min-h-[36px]">
            {{-- Expanded Logo --}}
            <a href="{{ url('/') }}" class="sidebar-expanded-only flex items-center gap-2 overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="WeddingSphere" class="h-7 w-auto object-contain">
            </a>

            {{-- Collapsed Monogram Logo (visible only in icon-only mode) --}}
            <a href="{{ url('/') }}" class="sidebar-collapsed-only hidden mx-auto items-center justify-center size-9 rounded-xl bg-gradient-to-br from-wine to-[#4d1928] text-white font-serif font-bold text-sm shadow-xs ring-1 ring-white/50" title="WeddingSphere Dashboard">
                WS
            </a>

            {{-- Mobile Close Button --}}
            <button type="button" data-sidebar-close class="rounded-lg p-1 text-muted hover:bg-chip lg:hidden cursor-pointer" aria-label="Close Sidebar">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Active Wedding Planner pill --}}
        {{-- Expanded Pill --}}
        <div class="sidebar-expanded-only flex items-center justify-between rounded-md border border-[#edd5c3] bg-[#fbf0e7] px-2.5 py-1 text-[11px] font-medium text-[#7a5a14]">
            <span class="flex items-center gap-1.5">
                <span class="size-1.5 rounded-full bg-[#c08628] animate-pulse"></span>
                Active Wedding Planner
            </span>
            <svg class="size-3.5 text-[#a17024]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
        </div>

        {{-- Collapsed Pill (Icon only with tooltip) --}}
        <div class="sidebar-collapsed-only hidden mx-auto items-center justify-center size-8 rounded-lg border border-[#edd5c3] bg-[#fbf0e7] text-[#c08628] relative group cursor-pointer" title="Active Wedding Planner">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <span class="sidebar-tooltip">Active Wedding Planner</span>
        </div>
    </div>

    {{-- Navigation Links List --}}
    <nav class="flex-1 overflow-y-auto px-3 py-2 space-y-0.5 text-[12.5px] custom-scrollbar">
        @php
            $navItems = [
                ['name' => 'Overview', 'icon' => 'home', 'url' => '#'],
                ['name' => 'My Weddings', 'icon' => 'rings', 'url' => '#'],
                ['name' => 'Wedding Checklist', 'icon' => 'check-square', 'url' => '#'],
                ['name' => 'Planning Progress', 'icon' => 'chart', 'url' => '#'],
                ['name' => 'Explore Vendors', 'icon' => 'search', 'url' => '#'],
                ['name' => 'Wedding Packages', 'icon' => 'box', 'url' => '#'],
                ['name' => 'My Bookings', 'icon' => 'calendar', 'url' => '#'],
                ['name' => 'Budget & Expenses', 'icon' => 'credit-card', 'url' => '#'],
                ['name' => 'Guest Management', 'icon' => 'users', 'url' => route('dashboard'), 'active' => true],
                ['name' => 'Wishlist', 'icon' => 'heart', 'url' => '#'],
                ['name' => 'Messages', 'icon' => 'mail', 'url' => '#'],
                ['name' => 'Reports', 'icon' => 'file-text', 'url' => '#'],
                ['name' => 'My Profile', 'icon' => 'user', 'url' => '#'],
                ['name' => 'Settings', 'icon' => 'settings', 'url' => '#'],
            ];
        @endphp

        @foreach ($navItems as $item)
            @php $isActive = $item['active'] ?? false; @endphp
            <a href="{{ $item['url'] }}"
               class="sidebar-nav-link group relative flex items-center gap-3 rounded-lg px-3 py-2 font-medium transition-all duration-150 {{ $isActive ? 'bg-wine text-white shadow-xs' : 'text-[#4e3c42] hover:bg-[#f3e5e2] hover:text-wine' }}"
               data-nav-name="{{ $item['name'] }}">
                {{-- Dynamic SVG Icon matching Figma --}}
                <span class="shrink-0 flex items-center justify-center {{ $isActive ? 'text-white' : 'text-muted group-hover:text-wine' }}">
                    @if ($item['name'] === 'Overview')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                    @elseif ($item['name'] === 'Guest Management')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    @elseif ($item['name'] === 'Budget & Expenses')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    @elseif ($item['name'] === 'Wedding Checklist')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    @elseif ($item['name'] === 'Explore Vendors')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    @elseif ($item['name'] === 'My Weddings')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11a6 6 0 11-12 0 6 6 0 0112 0zm-3-9a3 3 0 10-6 0 3 3 0 006 0z" /></svg>
                    @elseif ($item['name'] === 'Planning Progress')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    @elseif ($item['name'] === 'Wedding Packages')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    @elseif ($item['name'] === 'My Bookings')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    @elseif ($item['name'] === 'Wishlist')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    @elseif ($item['name'] === 'Messages')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                    @elseif ($item['name'] === 'Reports')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    @elseif ($item['name'] === 'My Profile')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    @elseif ($item['name'] === 'Settings')
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    @else
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="2"/></svg>
                    @endif
                </span>
                <span class="sidebar-expanded-text truncate transition-opacity duration-200">{{ $item['name'] }}</span>

                {{-- Hover Tooltip for Collapsed Icon Mode --}}
                <span class="sidebar-tooltip">
                    {{ $item['name'] }}
                </span>
            </a>
        @endforeach
    </nav>

    {{-- Bottom User Profile Card --}}
    <div class="border-t border-line/60 p-3 bg-[#f8edea]/60 transition-all duration-300">
        {{-- Expanded Profile View --}}
        <div class="sidebar-expanded-only flex items-center justify-between gap-2 rounded-lg p-1.5">
            <div class="flex items-center gap-2.5 min-w-0">
                <span class="inline-flex size-8 shrink-0 items-center justify-center rounded-full bg-[#dec3be] text-xs font-semibold text-wine-dark shadow-2xs">
                    SD
                </span>
                <div class="truncate">
                    <p class="truncate text-[12px] font-semibold text-ink leading-tight">Shenali & Dinuka</p>
                    <p class="truncate text-[10.5px] text-muted leading-tight">Bride & Groom</p>
                </div>
            </div>

            <button type="button" class="shrink-0 p-1.5 text-muted hover:text-wine hover:bg-chip rounded-md transition cursor-pointer" title="Log out">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </div>

        {{-- Collapsed Profile View (Icon only with Tooltip) --}}
        <div class="sidebar-collapsed-only hidden items-center justify-center relative group">
            <span class="inline-flex size-9 items-center justify-center rounded-full bg-[#dec3be] text-xs font-semibold text-wine-dark shadow-2xs cursor-pointer" title="Shenali & Dinuka (Bride & Groom)">
                SD
            </span>
            <span class="sidebar-tooltip">
                Shenali & Dinuka (Bride & Groom)
            </span>
        </div>
    </div>
</aside>

{{-- Mobile Overlay Backdrop --}}
<div id="sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-xs lg:hidden transition-opacity"></div>
