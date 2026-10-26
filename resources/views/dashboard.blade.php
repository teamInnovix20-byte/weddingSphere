@extends('layouts.dashboard')

@section('title', 'Guest List & RSVP Command Center — WeddingSphere')

@section('content')
<div class="space-y-6 max-w-[1400px] mx-auto" id="command-center-app">

    {{-- Breadcrumb & Destination Pill --}}
    <div class="space-y-1.5">
        <div class="flex items-center gap-2 text-[10.5px] font-bold tracking-[.06em] text-muted-2 uppercase">
            <span>Bride &amp; Groom Workspace</span>
            <span>/</span>
            <span class="text-wine">Guest Management</span>
        </div>

        <div class="inline-flex items-center gap-1.5 rounded-full border border-[#f0deda] bg-[#fbf3f1] px-2.5 py-0.5 text-[11px] font-medium text-wine">
            <span class="size-1.5 rounded-full bg-wine animate-pulse"></span>
            Nuwara Eliya Destination Nuptials • Dec 18, 2025
        </div>
    </div>

    {{-- Page Header & Actions --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-1">
        <div>
            <h1 class="font-serif text-3xl font-bold tracking-tight text-ink">
                Guest List &amp; RSVP Command Center
            </h1>
            <p class="mt-1 text-xs text-muted">
                Track guest attendance, dietary preferences, digital invitation dispatches, and table allocations for Claire &amp; Julian.
            </p>
        </div>

        {{-- Action Buttons Toolbar --}}
        <div class="flex flex-wrap items-center gap-2.5">
            <button type="button"
                    onclick="showToast('Opening Digital Invitation Studio...')"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-line bg-white px-3.5 py-2 text-[12px] font-medium text-ink shadow-2xs hover:bg-bg-soft hover:border-wine/30 hover:text-wine transition cursor-pointer">
                <svg class="size-3.5 text-muted group-hover:text-wine" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Invitation Studio
            </button>

            <button type="button"
                    onclick="showToast('CSV Import ready: Select file to upload', 'info')"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-line bg-white px-3.5 py-2 text-[12px] font-medium text-ink shadow-2xs hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                <svg class="size-3.5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Import CSV
            </button>

            <button type="button"
                    onclick="showToast('Exporting current guest list to Excel CSV...', 'success')"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-line bg-white px-3.5 py-2 text-[12px] font-medium text-ink shadow-2xs hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                <svg class="size-3.5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export
            </button>

            <button type="button"
                    onclick="showToast('Opening Add Guest wizard...', 'info')"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-wine px-4 py-2 text-[12px] font-semibold text-white shadow-xs hover:bg-wine-hover hover:shadow-md hover:shadow-wine/20 transition cursor-pointer">
                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Guest / Party
            </button>
        </div>
    </div>

    {{-- 4 Metric KPI Cards Row with subtle hover effects and quick-filter interaction --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Card 1: Total Invited --}}
        <div data-kpi-filter="all"
             class="group rounded-xl border border-line/80 bg-white p-4 shadow-2xs flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 hover:shadow-md hover:border-wine/30 cursor-pointer"
             title="Click to show all guests">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold tracking-wider text-muted-2 uppercase group-hover:text-wine transition">Total Invited</span>
                    <span class="rounded-full bg-[#f6ece9] px-2 py-0.5 text-[10px] font-semibold text-wine group-hover:bg-[#fae8e6] transition">
                        Target: 300 Max
                    </span>
                </div>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="font-serif text-3xl font-bold text-ink group-hover:text-wine transition">280</span>
                    <span class="text-[11px] text-muted">Guests Registered</span>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-line/50 flex items-center justify-between text-[11px] text-muted">
                <div class="flex items-center gap-1.5">
                    <svg class="size-3.5 text-muted group-hover:text-wine transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>140 Invitations / Households</span>
                </div>
                <span class="text-[10px] text-wine font-medium opacity-0 group-hover:opacity-100 transition">View all &rarr;</span>
            </div>
        </div>

        {{-- Card 2: Attending (Accepted) --}}
        <div data-kpi-filter="attending"
             class="group rounded-xl border border-line/80 bg-white p-4 shadow-2xs flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 hover:shadow-md hover:border-[#2f7544]/40 cursor-pointer"
             title="Click to filter by Attending guests">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold tracking-wider text-muted-2 uppercase group-hover:text-[#2f7544] transition">Attending (Accepted)</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10px] font-semibold text-[#2f7544]">
                        <span class="size-1 rounded-full bg-[#2f7544] animate-pulse"></span>
                        Confirmed
                    </span>
                </div>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="font-serif text-3xl font-bold text-[#1f6634]">194</span>
                    <span class="text-[11px] font-semibold text-[#2f7544]">69.3%</span>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-line/50 flex items-center justify-between text-[11px] text-muted">
                <div class="flex items-center gap-1.5">
                    <svg class="size-3.5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Adults</span>
                    <span class="font-bold text-ink">168</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="size-3.5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                    </svg>
                    <span>Children</span>
                    <span class="font-bold text-ink">26</span>
                </div>
            </div>
        </div>

        {{-- Card 3: Regretfully Declined --}}
        <div data-kpi-filter="declined"
             class="group rounded-xl border border-line/80 bg-white p-4 shadow-2xs flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 hover:shadow-md hover:border-[#a53648]/40 cursor-pointer"
             title="Click to filter by Declined guests">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold tracking-wider text-muted-2 uppercase group-hover:text-[#a53648] transition">Regretfully Declined</span>
                    <span class="rounded-full bg-[#fcedef] px-2 py-0.5 text-[10px] font-semibold text-[#a53648]">
                        Apologies
                    </span>
                </div>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="font-serif text-3xl font-bold text-[#a53648]">22</span>
                    <span class="text-[11px] font-semibold text-[#a53648]">7.9%</span>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-line/50 flex items-center justify-between text-[11px] text-muted">
                <span class="flex items-center gap-1.5">
                    <svg class="size-3.5 text-[#a53648]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    12 Sent Video Wishes
                </span>
                <span class="text-muted-2 group-hover:text-wine transition">✎</span>
            </div>
        </div>

        {{-- Card 4: Awaiting Response --}}
        <div data-kpi-filter="awaiting"
             class="group rounded-xl border border-line/80 bg-white p-4 shadow-2xs flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 hover:shadow-md hover:border-[#b57a1e]/40 cursor-pointer"
             title="Click to filter by Awaiting RSVP">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold tracking-wider text-muted-2 uppercase group-hover:text-[#ab731a] transition">Awaiting Response</span>
                    <span class="rounded-full bg-[#fef4e5] px-2 py-0.5 text-[10px] font-semibold text-[#ab731a]">
                        Action Needed
                    </span>
                </div>
                <div class="mt-2 flex items-baseline gap-2">
                    <span class="font-serif text-3xl font-bold text-[#b57a1e]">64</span>
                    <span class="text-[11px] font-semibold text-[#ab731a]">22.8%</span>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-line/50 flex items-center justify-between text-[11px]">
                <span class="flex items-center gap-1 text-muted">
                    <svg class="size-3.5 text-[#ab731a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                    18 Overdue (&gt;7 Days)
                </span>
                <span class="font-semibold text-wine group-hover:underline flex items-center gap-0.5">
                    Nudge &gt;
                </span>
            </div>
        </div>
    </div>

    {{-- Invitation Dispatch Health Banner with subtle hover --}}
    <div class="rounded-xl border border-[#eedfd9] bg-[#fffcfb] p-3.5 shadow-2xs flex flex-col lg:flex-row lg:items-center justify-between gap-3 hover:border-wine/40 hover:shadow-sm transition-all duration-200">
        <div class="flex items-center gap-3">
            <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-[#fcedea] text-wine">
                <svg class="size-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </span>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[12.5px] font-semibold text-ink">Invitation Dispatch Health</span>
                    <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10px] font-semibold text-[#2f7544]">
                        98.2% Deliverability
                    </span>
                </div>
                <p class="text-[11px] text-muted">Digital seals rendered with animated envelope &amp; bilingual Poruwa agenda</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 text-[11.5px] text-muted pl-12 lg:pl-0">
            <span>• Total Dispatched: <strong class="text-ink">138</strong></span>
            <span>• Confirmed Delivered: <strong class="text-ink">134</strong></span>
            <span>• Opened &amp; Read: <strong class="text-ink">118</strong></span>
            <span class="rounded-full bg-[#fcedef] px-2.5 py-0.5 text-[11px] font-semibold text-[#a53648] hover:bg-[#fad8dd] transition cursor-pointer"
                  onclick="filterBySearch('bounced'); showToast('Showing bounced/invalid invitation dispatches', 'warning')">
                4 Bounced / Attention Needed
            </span>
        </div>
    </div>

    {{-- Filters, Search Bar & View Toggles --}}
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3 pt-1">
        <div class="flex flex-1 flex-wrap items-center gap-2.5">
            {{-- Search Box --}}
            <div class="relative min-w-[280px] flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 size-3.5 -translate-y-1/2 text-muted"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text"
                       id="guest-search-input"
                       placeholder="Search guest name, party, email, phone, or table..."
                       class="h-9 w-full rounded-lg border border-line bg-white pl-9 pr-8 text-[12px] text-ink placeholder:text-muted focus:border-wine focus:ring-1 focus:ring-wine/20 focus:outline-hidden transition">
                <button type="button"
                        id="clear-search-btn"
                        class="hidden absolute right-2.5 top-1/2 -translate-y-1/2 text-muted hover:text-ink cursor-pointer"
                        title="Clear search">
                    ✕
                </button>
            </div>

            {{-- Filter 1: Affiliation Dropdown --}}
            <div class="relative" id="dropdown-affiliation">
                <button type="button"
                        data-dropdown-trigger="affiliation"
                        class="inline-flex h-9 items-center gap-1.5 rounded-lg border border-line bg-white px-3 text-[11.5px] font-medium text-ink hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                    <span class="text-muted">Affiliation:</span>
                    <span id="label-affiliation" class="font-semibold text-wine">All (280)</span>
                    <svg class="size-3 text-muted transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div data-dropdown-menu="affiliation"
                     class="hidden absolute left-0 top-full mt-1.5 z-40 w-52 rounded-xl border border-line bg-white p-1.5 shadow-lg shadow-black/5 animate-toast">
                    <div class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-muted-2">Filter by Affiliation</div>
                    <button type="button" data-filter-type="affiliation" data-filter-val="all" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>All (280)</span>
                        <span class="check-icon text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="affiliation" data-filter-val="bride" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Bride's Side</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="affiliation" data-filter-val="groom" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Groom's Side</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="affiliation" data-filter-val="vip" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>VIP / Dignitaries</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                </div>
            </div>

            {{-- Filter 2: Events Dropdown --}}
            <div class="relative" id="dropdown-events">
                <button type="button"
                        data-dropdown-trigger="events"
                        class="inline-flex h-9 items-center gap-1.5 rounded-lg border border-line bg-white px-3 text-[11.5px] font-medium text-ink hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                    <span class="text-muted">Events:</span>
                    <span id="label-events" class="font-semibold text-wine">All Ceremonies</span>
                    <svg class="size-3 text-muted transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div data-dropdown-menu="events"
                     class="hidden absolute left-0 top-full mt-1.5 z-40 w-56 rounded-xl border border-line bg-white p-1.5 shadow-lg shadow-black/5 animate-toast">
                    <div class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-muted-2">Filter by Ceremony</div>
                    <button type="button" data-filter-type="events" data-filter-val="all" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>All Ceremonies</span>
                        <span class="check-icon text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="events" data-filter-val="both" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Both (Poruwa + Gala)</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="events" data-filter-val="poruwa" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Traditional Poruwa Only</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="events" data-filter-val="gala" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Evening Gala Only</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                </div>
            </div>

            {{-- Filter 3: RSVP Dropdown --}}
            <div class="relative" id="dropdown-rsvp">
                <button type="button"
                        data-dropdown-trigger="rsvp"
                        class="inline-flex h-9 items-center gap-1.5 rounded-lg border border-line bg-white px-3 text-[11.5px] font-medium text-ink hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                    <span class="text-muted">RSVP:</span>
                    <span id="label-rsvp" class="font-semibold text-wine">All Statuses</span>
                    <svg class="size-3 text-muted transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div data-dropdown-menu="rsvp"
                     class="hidden absolute left-0 top-full mt-1.5 z-40 w-52 rounded-xl border border-line bg-white p-1.5 shadow-lg shadow-black/5 animate-toast">
                    <div class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-muted-2">Filter by RSVP Decision</div>
                    <button type="button" data-filter-type="rsvp" data-filter-val="all" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>All Statuses</span>
                        <span class="check-icon text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="rsvp" data-filter-val="attending" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span class="text-[#2f7544] font-medium">✓ Attending</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="rsvp" data-filter-val="awaiting" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span class="text-[#ab731a] font-medium">• Awaiting RSVP</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="rsvp" data-filter-val="declined" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span class="text-[#a53648] font-medium">✕ Declined</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                </div>
            </div>

            {{-- Filter 4: Dietary Dropdown --}}
            <div class="relative" id="dropdown-dietary">
                <button type="button"
                        data-dropdown-trigger="dietary"
                        class="inline-flex h-9 items-center gap-1.5 rounded-lg border border-line bg-white px-3 text-[11.5px] font-medium text-ink hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                    <span class="text-muted">Dietary:</span>
                    <span id="label-dietary" class="font-semibold text-wine">All Options</span>
                    <svg class="size-3 text-muted transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div data-dropdown-menu="dietary"
                     class="hidden absolute left-0 top-full mt-1.5 z-40 w-60 rounded-xl border border-line bg-white p-1.5 shadow-lg shadow-black/5 animate-toast">
                    <div class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-muted-2">Filter by Dietary</div>
                    <button type="button" data-filter-type="dietary" data-filter-val="all" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>All Options</span>
                        <span class="check-icon text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="dietary" data-filter-val="diabetic" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Diabetic / Low Sugar</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="dietary" data-filter-val="jain" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Child / Jain Vegetarian</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                    <button type="button" data-filter-type="dietary" data-filter-val="standard" class="flex w-full items-center justify-between rounded-lg px-2.5 py-1.5 text-[11.5px] font-medium text-ink hover:bg-[#fae8e6] hover:text-wine transition text-left cursor-pointer">
                        <span>Standard Non-Veg</span>
                        <span class="check-icon hidden text-wine font-bold">✓</span>
                    </button>
                </div>
            </div>

            {{-- Reset All Filters Button (Hidden by default, shown when filters active) --}}
            <button type="button"
                    id="btn-reset-filters"
                    class="hidden items-center gap-1 text-[11.5px] font-medium text-wine hover:underline px-2 py-1 cursor-pointer">
                ✕ Reset Filters
            </button>
        </div>

        {{-- View Switcher Buttons (Functional Tabs: List / Household / Seating Matrix) --}}
        <div class="inline-flex rounded-lg border border-line bg-white p-1 shadow-2xs self-start lg:self-auto gap-0.5" id="view-tabs">
            <button type="button"
                    data-tab-target="list"
                    class="tab-btn flex items-center gap-1.5 rounded-md px-3 py-1.5 text-[11px] font-semibold transition cursor-pointer bg-wine text-white shadow-xs">
                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                List
            </button>
            <button type="button"
                    data-tab-target="household"
                    class="tab-btn flex items-center gap-1.5 rounded-md px-3 py-1.5 text-[11px] font-medium text-muted hover:text-ink hover:bg-chip/50 transition cursor-pointer">
                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Household
            </button>
            <button type="button"
                    data-tab-target="seating"
                    class="tab-btn flex items-center gap-1.5 rounded-md px-3 py-1.5 text-[11px] font-medium text-muted hover:text-ink hover:bg-chip/50 transition cursor-pointer">
                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Seating Matrix
            </button>
        </div>
    </div>

    {{-- Bulk Action Banner (Reactive to selection) --}}
    <div id="bulk-action-banner"
         class="flex flex-wrap items-center justify-between gap-3 rounded-lg bg-[#551d2f] px-4 py-2.5 text-white shadow-xs transition-all duration-200">
        <div class="flex items-center gap-2 text-[12px] font-medium">
            <span class="flex size-4 items-center justify-center rounded-full bg-white text-wine text-[10px] font-bold">✓</span>
            <span id="bulk-selection-count">2 Guests Selected across 2 Households</span>
        </div>

        <div class="flex items-center gap-2">
            <button type="button"
                    onclick="handleBulkResend()"
                    class="rounded-md border border-white/20 bg-white/10 px-2.5 py-1 text-[11px] font-medium hover:bg-white/20 transition cursor-pointer">
                Resend Digital Pass
            </button>
            <button type="button"
                    onclick="handleBulkAssignTable()"
                    class="rounded-md border border-white/20 bg-white/10 px-2.5 py-1 text-[11px] font-medium hover:bg-white/20 transition cursor-pointer">
                Assign Table
            </button>
            <button type="button"
                    onclick="handleBulkMarkAttending()"
                    class="rounded-md bg-[#2d7744] px-2.5 py-1 text-[11px] font-semibold hover:bg-[#256639] transition cursor-pointer shadow-xs">
                ✓ Mark Attending
            </button>
            <button type="button"
                    onclick="handleBulkDismiss()"
                    class="text-[11px] text-white/70 hover:text-white px-2 cursor-pointer">
                Dismiss
            </button>
        </div>
    </div>

    {{-- TAB CONTENT CONTAINER 1: LIST VIEW (MAIN GUEST DATA TABLE) --}}
    <div id="view-content-list" class="tab-content">
        <div class="overflow-hidden rounded-xl border border-line bg-white shadow-2xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[11.5px] border-collapse" id="guests-table">
                    <thead>
                        <tr class="border-b border-line bg-[#fdfaf9] text-[10px] font-bold tracking-wider text-muted-2 uppercase">
                            <th class="py-3 px-3.5 w-10 text-center">
                                <input type="checkbox"
                                       id="select-all-checkbox"
                                       class="size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </th>
                            <th class="py-3 px-3">Guest &amp; Household Party</th>
                            <th class="py-3 px-3">Affiliation</th>
                            <th class="py-3 px-3">Event Ceremonies</th>
                            <th class="py-3 px-3">Invitation &amp; Deliverability</th>
                            <th class="py-3 px-3">RSVP Decision</th>
                            <th class="py-3 px-3">Dietary &amp; Requirements</th>
                            <th class="py-3 px-3">Table Allocation</th>
                            <th class="py-3 px-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line/60" id="guests-table-body">

                        {{-- Row 1: Hon. Justice Mohan & Swarna Ratnayake --}}
                        <tr class="guest-row transition-all duration-150 hover:bg-[#fff7f5] bg-[#fdf3f0]/30"
                            data-guest-id="1"
                            data-guest-name="Hon. Justice Mohan & Swarna Ratnayake"
                            data-party="The Ratnayake Household"
                            data-affiliation="bride vip"
                            data-events="both"
                            data-rsvp="attending"
                            data-dietary="diabetic"
                            data-table="Table 01 - Presidential"
                            data-email="ratnayake.justice@appellate.lk">
                            <td class="py-3 px-3.5 text-center">
                                <input type="checkbox" checked
                                       class="guest-checkbox size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-7 rounded-md bg-[#fae8e6] text-wine flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        R
                                    </span>
                                    <div>
                                        <div class="flex items-center gap-1.5 font-semibold text-ink text-[12px]">
                                            <span>Hon. Justice Mohan &amp; Swarna Ratnayake</span>
                                            <svg class="size-3 text-muted-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <circle cx="12" cy="12" r="9" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg>
                                        </div>
                                        <p class="text-[10.5px] text-muted">Party of 7 • ratnayake.justice@appellate.lk</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="rounded-full bg-[#fae8e6] px-2 py-0.5 text-[10.5px] font-semibold text-wine">
                                    Bride's Side • VIP
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="text-[11px] font-semibold text-ink">Both Ceremonies</div>
                                <div class="text-[10px] text-muted">Poruwa + Evening Gala</div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10px] font-semibold text-[#2f7544]">
                                    <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <circle cx="12" cy="12" r="3" />
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    </svg>
                                    Opened 4x (Delivered)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-semibold text-[#2f7544]">
                                    Attending (Party of 2)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#fcedea] px-2 py-0.5 text-[10px] font-medium text-wine">
                                    ⚡ Diabetic Friendly / Low Sugar
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-table inline-flex items-center gap-1 rounded-md border border-line bg-[#fffcfb] px-2 py-1 text-[10.5px] font-medium text-ink">
                                    🪑 Table 01 - Presidential
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <div class="inline-flex items-center gap-1 text-muted">
                                    <button type="button" onclick="showToast('Re-sent digital invitation pass to Justice Mohan', 'success')" class="p-1 hover:text-wine hover:bg-[#fae8e6] rounded transition cursor-pointer" title="Send Invitation"><svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg></button>
                                    <button type="button" onclick="showToast('Editing details for Hon. Justice Mohan', 'info')" class="p-1 hover:text-wine hover:bg-[#fae8e6] rounded transition cursor-pointer" title="Edit Guest"><svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 2: Dr. Sanjeewa & Dr. Priyanthi Wickramasinghe --}}
                        <tr class="guest-row transition-all duration-150 hover:bg-[#fff7f5] bg-[#fdf3f0]/30"
                            data-guest-id="2"
                            data-guest-name="Dr. Sanjeewa & Dr. Priyanthi Wickramasinghe"
                            data-party="Dr. Wickramasinghe Family"
                            data-affiliation="groom"
                            data-events="both"
                            data-rsvp="attending"
                            data-dietary="jain"
                            data-table="Table 04 - Tea Planters"
                            data-email="+94 77 241 8902">
                            <td class="py-3 px-3.5 text-center">
                                <input type="checkbox" checked
                                       class="guest-checkbox size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-7 rounded-md bg-[#fae8e6] text-wine flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        W
                                    </span>
                                    <div>
                                        <div class="font-semibold text-ink text-[12px]">Dr. Sanjeewa &amp; Dr. Priyanthi Wickramasinghe</div>
                                        <p class="text-[10.5px] text-muted">Party of 3 (includes child) • +94 77 241 8902</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10.5px] font-semibold text-muted">
                                    Groom's Side
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="text-[11px] font-semibold text-ink">Both Ceremonies</div>
                                <div class="text-[10px] text-muted">Poruwa + Evening Gala</div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#e8f3f3] px-2 py-0.5 text-[10px] font-semibold text-[#257474]">
                                    ✓ Opened 2x
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-semibold text-[#2f7544]">
                                    Attending (Party of 3)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#fcedea] px-2 py-0.5 text-[10px] font-medium text-wine">
                                    👶 Child Meal + Jain Veg
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-table inline-flex items-center gap-1 rounded-md border border-line bg-[#fffcfb] px-2 py-1 text-[10.5px] font-medium text-ink">
                                    🪑 Table 04 - Tea Planters
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <div class="inline-flex items-center gap-1 text-muted">
                                    <button type="button" onclick="showToast('Re-sent digital invitation pass to Dr. Sanjeewa', 'success')" class="p-1 hover:text-wine hover:bg-[#fae8e6] rounded transition cursor-pointer" title="Send Invitation"><svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg></button>
                                    <button type="button" onclick="showToast('Editing details for Dr. Wickramasinghe', 'info')" class="p-1 hover:text-wine hover:bg-[#fae8e6] rounded transition cursor-pointer" title="Edit Guest"><svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 3: Roshan & Niluka Perera --}}
                        <tr class="guest-row transition-all duration-150 hover:bg-[#fff7f5]"
                            data-guest-id="3"
                            data-guest-name="Roshan & Niluka Perera"
                            data-party="Perera Corporate Residence"
                            data-affiliation="bride"
                            data-events="gala"
                            data-rsvp="awaiting"
                            data-dietary="standard"
                            data-table="Unassigned"
                            data-email="roshan.perera@ceylonpetro.aero">
                            <td class="py-3 px-3.5 text-center">
                                <input type="checkbox"
                                       class="guest-checkbox size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-7 rounded-md bg-[#f6ece9] text-muted flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        P
                                    </span>
                                    <div>
                                        <div class="font-semibold text-ink text-[12px]">Roshan &amp; Niluka Perera</div>
                                        <p class="text-[10.5px] text-muted">Party of 4 • roshan.perera@ceylonpetro.aero</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10.5px] font-semibold text-muted">
                                    Bride's Side
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="text-[11px] font-semibold text-ink">Evening Gala Reception</div>
                                <div class="text-[10px] text-muted">Ballroom Banquet</div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#fef4e5] px-2 py-0.5 text-[10px] font-semibold text-[#ab731a]">
                                    <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M12 6v6l4 2" />
                                    </svg>
                                    Delivered (Unopened 5d)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#fef4e5] px-2 py-0.5 text-[10.5px] font-semibold text-[#ab731a]">
                                    • Awaiting RSVP
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="text-[10.5px] text-muted italic">None Specified Yet</span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-table text-[10.5px] text-muted-2">Unassigned</span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button"
                                            onclick="showToast('WhatsApp nudge sent to Roshan Perera', 'success')"
                                            class="inline-flex items-center gap-1 rounded-md border border-line bg-white px-2 py-1 text-[10.5px] font-medium text-ink hover:bg-chip hover:text-wine transition cursor-pointer">
                                        ▷ Nudge
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 4: Senaka & Anoma Jayawardena --}}
                        <tr class="guest-row transition-all duration-150 hover:bg-[#fff7f5]"
                            data-guest-id="4"
                            data-guest-name="Senaka & Anoma Jayawardena"
                            data-party="The Jayawardena Family (Melbourne)"
                            data-affiliation="groom"
                            data-events="both"
                            data-rsvp="declined"
                            data-dietary="standard"
                            data-table="Unassigned"
                            data-email="Melbourne, Australia">
                            <td class="py-3 px-3.5 text-center">
                                <input type="checkbox"
                                       class="guest-checkbox size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-7 rounded-md bg-[#f6ece9] text-muted flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        J
                                    </span>
                                    <div>
                                        <div class="font-semibold text-ink text-[12px]">Senaka &amp; Anoma Jayawardena</div>
                                        <p class="text-[10.5px] text-muted">Party of 2 • Melbourne, Australia</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10.5px] font-semibold text-muted">
                                    Groom's Family
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="text-[11px] font-semibold text-ink">Both Ceremonies</div>
                                <div class="text-[10px] text-muted">Invitation Recalled</div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#f4ebe8] px-2 py-0.5 text-[10px] font-semibold text-muted">
                                    ⌂ Opened 1x
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#fcedef] px-2 py-0.5 text-[10.5px] font-semibold text-[#a53648]">
                                    Declined (Overseas Travel)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 text-[10.5px] text-muted">
                                    🎁 Sent Royal Doulton Vase
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-table text-muted-2">—</span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <button type="button" onclick="showToast('Viewed Jayawardena registry gift status', 'info')" class="p-1 text-muted hover:text-wine hover:bg-chip rounded transition cursor-pointer" title="View details">
                                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                                </button>
                            </td>
                        </tr>

                        {{-- Row 5: Natasha Fernando & Guest (+1) [Bounced] --}}
                        <tr class="guest-row transition-all duration-150 hover:bg-[#fff7f5] bg-[#fff4f5]/40"
                            data-guest-id="5"
                            data-guest-name="Natasha Fernando & Guest (+1)"
                            data-party="Fernando Residence"
                            data-affiliation="bride"
                            data-events="gala"
                            data-rsvp="awaiting"
                            data-dietary="standard"
                            data-table="Unassigned"
                            data-email="natasha.f@outlook.com.invalid">
                            <td class="py-3 px-3.5 text-center">
                                <input type="checkbox"
                                       class="guest-checkbox size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-7 rounded-md bg-[#fcedef] text-[#a53648] flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        N
                                    </span>
                                    <div>
                                        <div class="font-semibold text-ink text-[12px]">Natasha Fernando &amp; Guest (+1)</div>
                                        <p class="text-[10.5px] text-[#a53648] flex items-center gap-1">
                                            <span>⚠️</span> natasha.f@outlook.com.invalid
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10.5px] font-semibold text-muted">
                                    Bride's Side
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="text-[11px] font-semibold text-ink">Evening Gala Reception</div>
                                <div class="text-[10px] text-muted">Ballroom Banquet</div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#fcedef] px-2 py-0.5 text-[10px] font-semibold text-[#a53648]">
                                    ✕ Bounced (Bad MX)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#fef4e5] px-2 py-0.5 text-[10.5px] font-semibold text-[#ab731a]">
                                    • Awaiting RSVP
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="text-[10.5px] text-muted italic">None Specified Yet</span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-table text-[10.5px] text-muted-2">Unassigned</span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <button type="button"
                                        onclick="showToast('Prompt: Please enter Natasha\'s WhatsApp or alternative email', 'warning')"
                                        class="inline-flex items-center gap-1 rounded-md bg-[#fcedef] px-2 py-1 text-[10.5px] font-semibold text-[#a53648] hover:bg-[#fad8dd] transition cursor-pointer">
                                    Update Contact
                                </button>
                            </td>
                        </tr>

                        {{-- Row 6: Deshamanya Kenneth & Charmaine De Silva --}}
                        <tr class="guest-row transition-all duration-150 hover:bg-[#fff7f5]"
                            data-guest-id="6"
                            data-guest-name="Deshamanya Kenneth & Charmaine De Silva"
                            data-party="De Silva Heritage Estate"
                            data-affiliation="bride vip"
                            data-events="poruwa"
                            data-rsvp="attending"
                            data-dietary="standard"
                            data-table="Table 02 - Elders"
                            data-email="k.desilva@heritageholding.com">
                            <td class="py-3 px-3.5 text-center">
                                <input type="checkbox"
                                       class="guest-checkbox size-3.5 rounded border-line text-wine focus:ring-wine/20 cursor-pointer">
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="size-7 rounded-md bg-[#fcedea] text-wine flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        D
                                    </span>
                                    <div>
                                        <div class="flex items-center gap-1.5 font-semibold text-ink text-[12px]">
                                            <span>Deshamanya Kenneth &amp; Charmaine De Silva</span>
                                            <span class="text-amber-600" title="Dignitary">🎖</span>
                                        </div>
                                        <p class="text-[10.5px] text-muted">Party of 2 • k.desilva@heritageholding.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="rounded-full bg-[#fae8e6] px-2 py-0.5 text-[10.5px] font-semibold text-wine">
                                    Bride's Side • Dignitary
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="text-[11px] font-semibold text-ink">Traditional Poruwa Ceremony</div>
                                <div class="text-[10px] text-muted">Morning Rites &amp; Auspicious Lunch</div>
                            </td>
                            <td class="py-3 px-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-[#e8f3f3] px-2 py-0.5 text-[10px] font-semibold text-[#257474]">
                                    ✓ Opened 3x
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-semibold text-[#2f7544]">
                                    Attending (Party of 2)
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="text-[10.5px] text-ink font-medium">Standard Non-Veg (Fish/Poultry)</span>
                            </td>
                            <td class="py-3 px-3">
                                <span class="badge-table inline-flex items-center gap-1 rounded-md border border-line bg-[#fffcfb] px-2 py-1 text-[10.5px] font-medium text-ink">
                                    🪑 Table 02 - Elders
                                </span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <div class="inline-flex items-center gap-1 text-muted">
                                    <button type="button" onclick="showToast('Re-sent digital invitation pass to Kenneth De Silva', 'success')" class="p-1 hover:text-wine hover:bg-[#fae8e6] rounded transition cursor-pointer" title="Send Invitation"><svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg></button>
                                    <button type="button" onclick="showToast('Editing details for Deshamanya Kenneth', 'info')" class="p-1 hover:text-wine hover:bg-[#fae8e6] rounded transition cursor-pointer" title="Edit Guest"><svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- Empty State (displayed when no rows match filters) --}}
            <div id="table-empty-state" class="hidden flex-col items-center justify-center p-12 text-center">
                <span class="flex size-14 items-center justify-center rounded-full bg-[#fbf1ef] text-wine text-2xl mb-3 shadow-inner">
                    🔍
                </span>
                <h3 class="font-serif text-lg font-bold text-ink">No matching guests found</h3>
                <p class="text-xs text-muted max-w-sm mt-1">We couldn't find any guests matching your search query or selected filters.</p>
                <button type="button"
                        onclick="resetAllFilters()"
                        class="mt-4 rounded-lg bg-wine px-4 py-2 text-xs font-semibold text-white hover:bg-wine-hover transition cursor-pointer shadow-xs">
                    Clear all filters &amp; search
                </button>
            </div>

            {{-- Table Pagination Footer with dynamic counts --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-line/80 bg-[#fdfaf9] px-4 py-3 text-[11px] text-muted">
                <div id="pagination-info">
                    Showing <strong class="text-ink" id="visible-count">6</strong> of <strong class="text-ink">280</strong> Invited Guests • Page 1 of 47
                </div>

                <div class="inline-flex items-center gap-1">
                    <button type="button" class="rounded-md border border-line bg-white px-2.5 py-1 text-[11px] font-medium text-muted hover:text-ink cursor-pointer hover:bg-chip transition">Previous</button>
                    <button type="button" class="size-7 rounded-md bg-wine text-white text-[11px] font-semibold">1</button>
                    <button type="button" class="size-7 rounded-md border border-line bg-white text-[11px] font-medium text-ink hover:bg-chip cursor-pointer transition">2</button>
                    <button type="button" class="size-7 rounded-md border border-line bg-white text-[11px] font-medium text-ink hover:bg-chip cursor-pointer transition">3</button>
                    <span class="px-1 text-muted">...</span>
                    <button type="button" class="size-7 rounded-md border border-line bg-white text-[11px] font-medium text-ink hover:bg-chip cursor-pointer transition">47</button>
                    <button type="button" class="rounded-md border border-line bg-white px-2.5 py-1 text-[11px] font-medium text-muted hover:text-ink cursor-pointer hover:bg-chip transition">Next</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB CONTENT CONTAINER 2: HOUSEHOLD VIEW --}}
    <div id="view-content-household" class="tab-content hidden space-y-4">
        <div class="rounded-xl border border-line bg-[#fffcfb] p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
            <div>
                <h3 class="font-serif text-base font-bold text-ink">Household Parties &amp; Family Manifest</h3>
                <p class="text-xs text-muted">Grouped by primary mailing address and unified digital invitation dispatch envelopes.</p>
            </div>
            <div class="flex items-center gap-2 text-xs font-semibold text-muted">
                <span class="rounded-full bg-[#fae8e6] px-2.5 py-1 text-wine">6 Households Shown</span>
                <span class="rounded-full bg-[#f8edea] px-2.5 py-1 text-ink">140 Total Envelopes</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="household-grid">
            {{-- Household Card 1 --}}
            <div class="household-card rounded-xl border border-line bg-white p-4 shadow-2xs hover:border-wine/30 hover:shadow-md transition-all duration-200 flex flex-col justify-between"
                 data-search="mohan swarna ratnayake appellate judge colombo">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="rounded-full bg-[#fae8e6] px-2 py-0.5 text-[10px] font-semibold text-wine">Bride's Side VIP</span>
                            <h4 class="font-serif font-bold text-sm text-ink mt-1">The Ratnayake Household</h4>
                            <p class="text-[11px] text-muted">Hon. Justice Mohan &amp; Swarna Ratnayake</p>
                        </div>
                        <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10px] font-semibold text-[#2f7544]">
                            Attending (2/7)
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-[11px] border-t border-line/50 pt-2.5">
                        <div class="flex items-center justify-between text-muted">
                            <span>Primary Contact:</span>
                            <span class="font-medium text-ink">ratnayake.justice@appellate.lk</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Allocated Table:</span>
                            <span class="font-medium text-ink">Table 01 - Presidential</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Ceremonies:</span>
                            <span class="font-medium text-ink">Poruwa + Evening Gala</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between text-[11px]">
                    <span class="text-muted text-[10.5px]">Sealed Pass #WS-0419</span>
                    <button type="button" onclick="showToast('Viewing Ratnayake household party details', 'info')" class="text-wine font-semibold hover:underline cursor-pointer">
                        Manage Party &rarr;
                    </button>
                </div>
            </div>

            {{-- Household Card 2 --}}
            <div class="household-card rounded-xl border border-line bg-white p-4 shadow-2xs hover:border-wine/30 hover:shadow-md transition-all duration-200 flex flex-col justify-between"
                 data-search="sanjeewa priyanthi wickramasinghe kandy doctor">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10px] font-semibold text-muted">Groom's Side</span>
                            <h4 class="font-serif font-bold text-sm text-ink mt-1">Dr. Wickramasinghe Family</h4>
                            <p class="text-[11px] text-muted">Dr. Sanjeewa, Dr. Priyanthi &amp; Kaveen</p>
                        </div>
                        <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10px] font-semibold text-[#2f7544]">
                            Attending (3/3)
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-[11px] border-t border-line/50 pt-2.5">
                        <div class="flex items-center justify-between text-muted">
                            <span>Primary Contact:</span>
                            <span class="font-medium text-ink">+94 77 241 8902</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Allocated Table:</span>
                            <span class="font-medium text-ink">Table 04 - Tea Planters</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Dietary:</span>
                            <span class="font-medium text-wine">Child Meal + Jain Veg</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between text-[11px]">
                    <span class="text-muted text-[10.5px]">Sealed Pass #WS-0284</span>
                    <button type="button" onclick="showToast('Viewing Wickramasinghe family details', 'info')" class="text-wine font-semibold hover:underline cursor-pointer">
                        Manage Party &rarr;
                    </button>
                </div>
            </div>

            {{-- Household Card 3 --}}
            <div class="household-card rounded-xl border border-line bg-white p-4 shadow-2xs hover:border-wine/30 hover:shadow-md transition-all duration-200 flex flex-col justify-between"
                 data-search="roshan niluka perera ceylon petro colombo">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10px] font-semibold text-muted">Bride's Side</span>
                            <h4 class="font-serif font-bold text-sm text-ink mt-1">Perera Corporate Residence</h4>
                            <p class="text-[11px] text-muted">Roshan &amp; Niluka Perera (Party of 4)</p>
                        </div>
                        <span class="rounded-full bg-[#fef4e5] px-2 py-0.5 text-[10px] font-semibold text-[#ab731a]">
                            Awaiting (4)
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-[11px] border-t border-line/50 pt-2.5">
                        <div class="flex items-center justify-between text-muted">
                            <span>Primary Contact:</span>
                            <span class="font-medium text-ink">roshan.perera@ceylonpetro.aero</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Allocated Table:</span>
                            <span class="font-medium text-muted-2">Unassigned</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Ceremonies:</span>
                            <span class="font-medium text-ink">Evening Gala Reception</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between text-[11px]">
                    <span class="text-amber-700 text-[10.5px]">Unopened 5d</span>
                    <button type="button" onclick="showToast('Nudge sent to Perera family', 'success')" class="text-wine font-semibold hover:underline cursor-pointer">
                        Send Nudge &rarr;
                    </button>
                </div>
            </div>

            {{-- Household Card 4 --}}
            <div class="household-card rounded-xl border border-line bg-white p-4 shadow-2xs hover:border-wine/30 hover:shadow-md transition-all duration-200 flex flex-col justify-between"
                 data-search="senaka anoma jayawardena melbourne australia">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="rounded-full bg-[#f3edea] px-2 py-0.5 text-[10px] font-semibold text-muted">Groom's Family</span>
                            <h4 class="font-serif font-bold text-sm text-ink mt-1">Jayawardena (Melbourne)</h4>
                            <p class="text-[11px] text-muted">Senaka &amp; Anoma Jayawardena</p>
                        </div>
                        <span class="rounded-full bg-[#fcedef] px-2 py-0.5 text-[10px] font-semibold text-[#a53648]">
                            Declined
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-[11px] border-t border-line/50 pt-2.5">
                        <div class="flex items-center justify-between text-muted">
                            <span>Location:</span>
                            <span class="font-medium text-ink">Victoria, Australia</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Registry:</span>
                            <span class="font-medium text-wine">Royal Doulton Vase Gift</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Wishes:</span>
                            <span class="font-medium text-ink">Video Blessing Uploaded</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between text-[11px]">
                    <span class="text-muted text-[10.5px]">Overseas Flight Conflict</span>
                    <button type="button" onclick="showToast('Playing Jayawardena video blessing', 'info')" class="text-wine font-semibold hover:underline cursor-pointer">
                        Play Video &rarr;
                    </button>
                </div>
            </div>

            {{-- Household Card 5 --}}
            <div class="household-card rounded-xl border border-line bg-white p-4 shadow-2xs hover:border-[#a53648]/40 hover:shadow-md transition-all duration-200 flex flex-col justify-between"
                 data-search="natasha fernando bounced colombo">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="rounded-full bg-[#fcedef] px-2 py-0.5 text-[10px] font-semibold text-[#a53648]">Attention Needed</span>
                            <h4 class="font-serif font-bold text-sm text-ink mt-1">Fernando Residence</h4>
                            <p class="text-[11px] text-[#a53648]">Natasha Fernando &amp; Guest (+1)</p>
                        </div>
                        <span class="rounded-full bg-[#fcedef] px-2 py-0.5 text-[10px] font-semibold text-[#a53648]">
                            Bounced
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-[11px] border-t border-line/50 pt-2.5">
                        <div class="flex items-center justify-between text-muted">
                            <span>Error:</span>
                            <span class="font-medium text-[#a53648]">Bad Domain MX Record</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Email on file:</span>
                            <span class="font-medium text-muted-2 truncate max-w-[150px]">natasha.f@outlook.com.invalid</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Ceremonies:</span>
                            <span class="font-medium text-ink">Evening Gala Reception</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between text-[11px]">
                    <span class="text-amber-700 text-[10.5px]">Pending Phone Verification</span>
                    <button type="button" onclick="showToast('Fix contact details modal opened', 'warning')" class="text-[#a53648] font-semibold hover:underline cursor-pointer">
                        Fix Contact &rarr;
                    </button>
                </div>
            </div>

            {{-- Household Card 6 --}}
            <div class="household-card rounded-xl border border-line bg-white p-4 shadow-2xs hover:border-wine/30 hover:shadow-md transition-all duration-200 flex flex-col justify-between"
                 data-search="kenneth charmaine de silva heritage holding dignitary">
                <div>
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="rounded-full bg-[#fae8e6] px-2 py-0.5 text-[10px] font-semibold text-wine">Bride's Dignitary</span>
                            <h4 class="font-serif font-bold text-sm text-ink mt-1">De Silva Heritage Estate</h4>
                            <p class="text-[11px] text-muted">Deshamanya Kenneth &amp; Charmaine</p>
                        </div>
                        <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10px] font-semibold text-[#2f7544]">
                            Attending (2/2)
                        </span>
                    </div>

                    <div class="mt-3 space-y-1.5 text-[11px] border-t border-line/50 pt-2.5">
                        <div class="flex items-center justify-between text-muted">
                            <span>Primary Contact:</span>
                            <span class="font-medium text-ink">k.desilva@heritageholding.com</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Allocated Table:</span>
                            <span class="font-medium text-ink">Table 02 - Elders</span>
                        </div>
                        <div class="flex items-center justify-between text-muted">
                            <span>Ceremonies:</span>
                            <span class="font-medium text-ink">Traditional Poruwa Ceremony</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between text-[11px]">
                    <span class="text-muted text-[10.5px]">Sealed Pass #WS-0012</span>
                    <button type="button" onclick="showToast('Viewing De Silva dignitary details', 'info')" class="text-wine font-semibold hover:underline cursor-pointer">
                        Manage Party &rarr;
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB CONTENT CONTAINER 3: SEATING MATRIX VIEW --}}
    <div id="view-content-seating" class="tab-content hidden space-y-6">
        <div class="rounded-xl border border-line bg-white p-5 shadow-2xs">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] font-bold tracking-wider text-muted-2 uppercase">Grand Heritage Pavilion Floor Plan</span>
                    <h2 class="font-serif text-xl font-bold text-ink mt-0.5">Interactive Seating Matrix &amp; Capacity Planner</h2>
                    <p class="text-xs text-muted mt-1">Click any table cluster to inspect assigned guests, Poruwa line of sight, and dietary alerts.</p>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="showToast('Floor plan editor launched', 'info')" class="inline-flex items-center gap-1.5 rounded-lg border border-line bg-white px-3 py-1.5 text-xs font-semibold text-ink hover:bg-bg-soft transition cursor-pointer">
                        📐 Floor Plan Blueprint
                    </button>
                    <button type="button" onclick="showToast('Auto-allocating remaining unassigned guests...', 'success')" class="inline-flex items-center gap-1.5 rounded-lg bg-wine px-3.5 py-1.5 text-xs font-semibold text-white hover:bg-wine-hover transition cursor-pointer shadow-xs">
                        ⚡ Auto-Seat Awaiting Guests
                    </button>
                </div>
            </div>

            {{-- Seating Tables Grid --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Table 01: Presidential --}}
                <div class="rounded-xl border border-wine/40 bg-[#fffcfb] p-4 shadow-xs hover:border-wine hover:shadow-md transition cursor-pointer"
                     onclick="showToast('Table 01 - Presidential: 2 seated (Hon. Justice Mohan & Swarna Ratnayake)', 'info')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-8 rounded-lg bg-wine text-white font-bold text-xs flex items-center justify-center">01</span>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-ink leading-tight">Presidential Table</h4>
                                <span class="text-[10.5px] text-muted">Poruwa Sightline • 10 Max</span>
                            </div>
                        </div>
                        <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-bold text-[#2f7544]">2 / 10</span>
                    </div>

                    <div class="mt-3 w-full bg-[#f0deda] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-wine h-full rounded-full" style="width: 20%"></div>
                    </div>

                    <div class="mt-3.5 space-y-1.5 text-[11px] text-ink">
                        <div class="flex items-center justify-between py-1 border-b border-line/40">
                            <span>Hon. Justice Mohan &amp; Swarna</span>
                            <span class="text-[10px] text-wine font-semibold">Diabetic / Low Sugar</span>
                        </div>
                        <div class="text-[10.5px] text-muted italic">8 seats remaining</div>
                    </div>
                </div>

                {{-- Table 02: Elders --}}
                <div class="rounded-xl border border-wine/40 bg-[#fffcfb] p-4 shadow-xs hover:border-wine hover:shadow-md transition cursor-pointer"
                     onclick="showToast('Table 02 - Elders: 2 seated (Deshamanya Kenneth & Charmaine De Silva)', 'info')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-8 rounded-lg bg-wine text-white font-bold text-xs flex items-center justify-center">02</span>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-ink leading-tight">Elders &amp; Dignitaries</h4>
                                <span class="text-[10.5px] text-muted">Poruwa Sightline • 10 Max</span>
                            </div>
                        </div>
                        <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-bold text-[#2f7544]">2 / 10</span>
                    </div>

                    <div class="mt-3 w-full bg-[#f0deda] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-wine h-full rounded-full" style="width: 20%"></div>
                    </div>

                    <div class="mt-3.5 space-y-1.5 text-[11px] text-ink">
                        <div class="flex items-center justify-between py-1 border-b border-line/40">
                            <span>Deshamanya Kenneth &amp; Charmaine</span>
                            <span class="text-[10px] text-muted">Standard Non-Veg</span>
                        </div>
                        <div class="text-[10.5px] text-muted italic">8 seats remaining</div>
                    </div>
                </div>

                {{-- Table 04: Tea Planters --}}
                <div class="rounded-xl border border-wine/40 bg-[#fffcfb] p-4 shadow-xs hover:border-wine hover:shadow-md transition cursor-pointer"
                     onclick="showToast('Table 04 - Tea Planters: 3 seated (Dr. Sanjeewa & Dr. Priyanthi Wickramasinghe + Child)', 'info')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-8 rounded-lg bg-wine text-white font-bold text-xs flex items-center justify-center">04</span>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-ink leading-tight">Tea Planters &amp; Kin</h4>
                                <span class="text-[10.5px] text-muted">Central Ballroom • 10 Max</span>
                            </div>
                        </div>
                        <span class="rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-bold text-[#2f7544]">3 / 10</span>
                    </div>

                    <div class="mt-3 w-full bg-[#f0deda] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-wine h-full rounded-full" style="width: 30%"></div>
                    </div>

                    <div class="mt-3.5 space-y-1.5 text-[11px] text-ink">
                        <div class="flex items-center justify-between py-1 border-b border-line/40">
                            <span>Dr. Sanjeewa &amp; Dr. Priyanthi + Child</span>
                            <span class="text-[10px] text-wine font-semibold">Child Meal + Jain</span>
                        </div>
                        <div class="text-[10.5px] text-muted italic">7 seats remaining</div>
                    </div>
                </div>

                {{-- Table 08: Artisans (Empty/Available) --}}
                <div class="rounded-xl border border-dashed border-line bg-white p-4 shadow-2xs hover:border-wine/30 transition cursor-pointer"
                     onclick="showToast('Table 08 - Artisans: Ready for assignment (0 / 8)', 'info')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-8 rounded-lg bg-[#f0deda] text-muted font-bold text-xs flex items-center justify-center">08</span>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-ink leading-tight">Traditional Artisans</h4>
                                <span class="text-[10.5px] text-muted">Garden Pavilion • 8 Max</span>
                            </div>
                        </div>
                        <span class="rounded-full bg-chip px-2 py-0.5 text-[10.5px] font-medium text-muted">0 / 8</span>
                    </div>

                    <div class="mt-3 w-full bg-[#f0deda] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-muted-2 h-full rounded-full" style="width: 0%"></div>
                    </div>

                    <div class="mt-3.5 text-center py-2 text-[11px] text-muted italic border-t border-line/40">
                        + Click to drag unassigned guests here
                    </div>
                </div>

                {{-- Table 15: Nuwara Eliya Club --}}
                <div class="rounded-xl border border-dashed border-line bg-white p-4 shadow-2xs hover:border-wine/30 transition cursor-pointer"
                     onclick="showToast('Table 15 - Nuwara Eliya Club: Ready for assignment (0 / 10)', 'info')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="size-8 rounded-lg bg-[#f0deda] text-muted font-bold text-xs flex items-center justify-center">15</span>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-ink leading-tight">Nuwara Eliya Club</h4>
                                <span class="text-[10.5px] text-muted">Terrace Overlook • 10 Max</span>
                            </div>
                        </div>
                        <span class="rounded-full bg-chip px-2 py-0.5 text-[10.5px] font-medium text-muted">0 / 10</span>
                    </div>

                    <div class="mt-3 w-full bg-[#f0deda] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-muted-2 h-full rounded-full" style="width: 0%"></div>
                    </div>

                    <div class="mt-3.5 text-center py-2 text-[11px] text-muted italic border-t border-line/40">
                        + Click to drag unassigned guests here
                    </div>
                </div>

                {{-- Unseated Guests Holding Tray --}}
                <div class="rounded-xl border border-amber-200 bg-[#fefdfb] p-4 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="size-8 rounded-lg bg-amber-100 text-amber-800 font-bold text-xs flex items-center justify-center">⏳</span>
                                <div>
                                    <h4 class="font-serif font-bold text-sm text-ink leading-tight">Unseated Guests</h4>
                                    <span class="text-[10.5px] text-amber-700 font-medium">6 Awaiting Table Placement</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1.5 text-[11px] border-t border-amber-200/60 pt-2 text-ink">
                            <div class="flex items-center justify-between py-1">
                                <span>Roshan &amp; Niluka Perera (4)</span>
                                <button type="button" onclick="showToast('Assigned Roshan Perera to Table 08', 'success')" class="text-wine text-[10.5px] font-semibold hover:underline cursor-pointer">Seat &rarr;</button>
                            </div>
                            <div class="flex items-center justify-between py-1">
                                <span>Natasha Fernando &amp; Guest (2)</span>
                                <button type="button" onclick="showToast('Assigned Natasha Fernando to Table 15', 'success')" class="text-wine text-[10.5px] font-semibold hover:underline cursor-pointer">Seat &rarr;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Two Column Section: Seating Manifest & Theme Card with hover effects --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-2">
        {{-- Auspicious Seating Clusters (2 Cols) --}}
        <div class="lg:col-span-2 rounded-xl border border-line bg-white p-5 shadow-2xs transition-all duration-200 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold tracking-wider text-muted-2 uppercase">Grand Heritage Pavilion Manifest</span>
                    <h2 class="font-serif text-lg font-bold text-ink mt-0.5">Auspicious Seating Clusters</h2>
                </div>
                <button type="button"
                        onclick="switchTab('seating')"
                        class="text-[11.5px] font-medium text-wine hover:underline inline-flex items-center gap-1 cursor-pointer">
                    Edit Floor Plan
                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </button>
            </div>
            <p class="text-[11px] text-muted mt-1">High-table arrangements honoring traditional Sri Lankan Poruwa sightlines and acoustic zones.</p>

            {{-- 3 Cluster Cards with subtle hover --}}
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
                <div onclick="switchTab('seating'); showToast('Focusing Presidential & Elders tables', 'info')"
                     class="group rounded-lg border border-line/70 bg-[#fff9f8] p-3 flex flex-col justify-between hover:border-wine/50 hover:bg-[#fff5f2] hover:-translate-y-0.5 transition-all duration-150 cursor-pointer">
                    <div class="flex items-center justify-between text-[11px] font-bold text-ink">
                        <span class="group-hover:text-wine transition">Table 01 - 04</span>
                        <span class="text-[#2f7544]">✓</span>
                    </div>
                    <p class="text-[10px] font-semibold text-muted-2 uppercase mt-1">Presidential &amp; Elders</p>
                    <p class="text-[12px] font-bold text-ink mt-2">38 <span class="text-[11px] font-normal text-muted">/ 40 Seats Allocated</span></p>
                </div>

                <div onclick="switchTab('seating'); showToast('Focusing Extended Family & Kin tables', 'info')"
                     class="group rounded-lg border border-line/70 bg-[#fff9f8] p-3 flex flex-col justify-between hover:border-wine/50 hover:bg-[#fff5f2] hover:-translate-y-0.5 transition-all duration-150 cursor-pointer">
                    <div class="flex items-center justify-between text-[11px] font-bold text-ink">
                        <span class="group-hover:text-wine transition">Table 05 - 14</span>
                        <span class="text-muted">👥</span>
                    </div>
                    <p class="text-[10px] font-semibold text-muted-2 uppercase mt-1">Extended Family &amp; Kin</p>
                    <p class="text-[12px] font-bold text-ink mt-2">88 <span class="text-[11px] font-normal text-muted">/ 100 Seats Allocated</span></p>
                </div>

                <div onclick="switchTab('seating'); showToast('Focusing Friends & Overseas Guests tables', 'info')"
                     class="group rounded-lg border border-line/70 bg-[#fff9f8] p-3 flex flex-col justify-between hover:border-wine/50 hover:bg-[#fff5f2] hover:-translate-y-0.5 transition-all duration-150 cursor-pointer">
                    <div class="flex items-center justify-between text-[11px] font-bold text-ink">
                        <span class="group-hover:text-wine transition">Table 15 - 28</span>
                        <span class="text-muted">🍹</span>
                    </div>
                    <p class="text-[10px] font-semibold text-muted-2 uppercase mt-1">Friends &amp; Overseas Guests</p>
                    <p class="text-[12px] font-bold text-ink mt-2">68 <span class="text-[11px] font-normal text-muted">/ 140 Seats Allocated</span></p>
                </div>
            </div>
        </div>

        {{-- Active Dispatch Theme (1 Col) --}}
        <div class="rounded-xl border border-line bg-white p-5 shadow-2xs flex flex-col justify-between transition-all duration-200 hover:shadow-md">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold tracking-wider text-muted-2 uppercase">Active Dispatch Theme</span>
                    <span class="rounded-full bg-[#fcedd7] px-2 py-0.5 text-[10px] font-bold text-[#96671a]">
                        Gold Foil V3
                    </span>
                </div>
                <h2 class="font-serif text-lg font-bold text-ink mt-1">Highland Rose &amp; Tea Motif</h2>
                <p class="text-[11px] text-muted mt-1 leading-relaxed">
                    Featuring bilingual Sinhala &amp; English calligraphy with personalized QR RSVP check-in.
                </p>

                {{-- Wine Follow-ups Box --}}
                <div class="mt-4 rounded-lg bg-wine p-3 text-white shadow-xs">
                    <div class="flex items-start gap-2.5">
                        <span class="size-6 rounded-md bg-white/20 flex items-center justify-center shrink-0 text-xs">✉</span>
                        <div>
                            <p class="text-[11.5px] font-semibold">Pending Follow-ups</p>
                            <p class="text-[10.5px] text-white/80 leading-tight mt-0.5">14 VIP WhatsApp reminders scheduled for tomorrow morning.</p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button"
                    onclick="showToast('Generated high-res preview of Highland Rose & Tea Motif pass', 'success')"
                    class="mt-4 inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-line bg-white py-2 text-[11.5px] font-semibold text-ink shadow-2xs hover:bg-bg-soft hover:border-wine/30 transition cursor-pointer">
                <svg class="size-3.5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview Digital Guest Pass
            </button>
        </div>
    </div>

</div>

@push('scripts')
<script>
    // -------------------------------------------------------------
    // WeddingSphere Command Center Interactive Logic
    // -------------------------------------------------------------
    const filterState = {
        search: '',
        affiliation: 'all',
        events: 'all',
        rsvp: 'all',
        dietary: 'all'
    };

    // Filter display text labels
    const filterLabels = {
        affiliation: { all: 'All (280)', bride: "Bride's Side", groom: "Groom's Side", vip: 'VIP / Dignitaries' },
        events: { all: 'All Ceremonies', both: 'Both (Poruwa + Gala)', poruwa: 'Poruwa Only', gala: 'Evening Gala Only' },
        rsvp: { all: 'All Statuses', attending: 'Attending', awaiting: 'Awaiting RSVP', declined: 'Declined' },
        dietary: { all: 'All Options', diabetic: 'Diabetic / Low Sugar', jain: 'Child / Jain Veg', standard: 'Standard Non-Veg' }
    };

    // Initialize interactive behaviors
    document.addEventListener('DOMContentLoaded', () => {
        initTabs();
        initDropdowns();
        initSearch();
        initCheckboxes();
        initKpiFilters();
    });

    // 1. Tab Switching (List / Household / Seating Matrix)
    function initTabs() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-tab-target');
                switchTab(target);
            });
        });
    }

    function switchTab(target) {
        const tabBtns = document.querySelectorAll('.tab-btn');
        tabBtns.forEach(b => {
            const isCurrent = b.getAttribute('data-tab-target') === target;
            if (isCurrent) {
                b.className = 'tab-btn flex items-center gap-1.5 rounded-md px-3 py-1.5 text-[11px] font-semibold transition cursor-pointer bg-wine text-white shadow-xs';
            } else {
                b.className = 'tab-btn flex items-center gap-1.5 rounded-md px-3 py-1.5 text-[11px] font-medium text-muted hover:text-ink hover:bg-chip/50 transition cursor-pointer';
            }
        });

        // Toggle containers
        const containers = {
            list: document.getElementById('view-content-list'),
            household: document.getElementById('view-content-household'),
            seating: document.getElementById('view-content-seating')
        };

        Object.keys(containers).forEach(key => {
            if (containers[key]) {
                if (key === target) {
                    containers[key].classList.remove('hidden');
                } else {
                    containers[key].classList.add('hidden');
                }
            }
        });
    }

    // 2. Dropdown Filter Management
    function initDropdowns() {
        const triggers = document.querySelectorAll('[data-dropdown-trigger]');
        
        triggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const type = trigger.getAttribute('data-dropdown-trigger');
                const menu = document.querySelector(`[data-dropdown-menu="${type}"]`);
                const isOpened = !menu.classList.contains('hidden');

                // Close all other dropdowns
                document.querySelectorAll('[data-dropdown-menu]').forEach(m => m.classList.add('hidden'));

                if (!isOpened) {
                    menu.classList.remove('hidden');
                }
            });
        });

        // Dropdown option clicks
        const filterOptionBtns = document.querySelectorAll('[data-filter-type]');
        filterOptionBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const type = btn.getAttribute('data-filter-type');
                const val = btn.getAttribute('data-filter-val');

                filterState[type] = val;

                // Update trigger button label
                const labelEl = document.getElementById(`label-${type}`);
                if (labelEl && filterLabels[type][val]) {
                    labelEl.textContent = filterLabels[type][val];
                }

                // Update checkmark indicators in this menu
                const menu = btn.closest('[data-dropdown-menu]');
                if (menu) {
                    menu.querySelectorAll('[data-filter-type]').forEach(opt => {
                        const check = opt.querySelector('.check-icon');
                        if (check) {
                            if (opt.getAttribute('data-filter-val') === val) {
                                check.classList.remove('hidden');
                            } else {
                                check.classList.add('hidden');
                            }
                        }
                    });
                    menu.classList.add('hidden'); // Close after selection
                }

                applyFilters();
            });
        });

        // Close dropdowns on outside click
        document.addEventListener('click', () => {
            document.querySelectorAll('[data-dropdown-menu]').forEach(m => m.classList.add('hidden'));
        });
    }

    // 3. Live Search Input
    function initSearch() {
        const searchInput = document.getElementById('guest-search-input');
        const clearBtn = document.getElementById('clear-search-btn');

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                filterState.search = e.target.value.trim().toLowerCase();
                if (clearBtn) {
                    clearBtn.classList.toggle('hidden', filterState.search === '');
                }
                applyFilters();
            });
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                if (searchInput) searchInput.value = '';
                filterState.search = '';
                clearBtn.classList.add('hidden');
                applyFilters();
            });
        }

        const resetBtn = document.getElementById('btn-reset-filters');
        if (resetBtn) {
            resetBtn.addEventListener('click', resetAllFilters);
        }
    }

    window.filterBySearch = function(query) {
        const searchInput = document.getElementById('guest-search-input');
        if (searchInput) {
            searchInput.value = query;
            filterState.search = query.toLowerCase();
            const clearBtn = document.getElementById('clear-search-btn');
            if (clearBtn) clearBtn.classList.remove('hidden');
            applyFilters();
        }
    };

    // 4. KPI Card Quick Filters
    function initKpiFilters() {
        const kpiCards = document.querySelectorAll('[data-kpi-filter]');
        kpiCards.forEach(card => {
            card.addEventListener('click', () => {
                const targetFilter = card.getAttribute('data-kpi-filter');
                filterState.rsvp = targetFilter;

                // Update RSVP dropdown label
                const rsvpLabel = document.getElementById('label-rsvp');
                if (rsvpLabel && filterLabels.rsvp[targetFilter]) {
                    rsvpLabel.textContent = filterLabels.rsvp[targetFilter];
                }

                // Update checkmark in rsvp menu
                const rsvpMenu = document.querySelector('[data-dropdown-menu="rsvp"]');
                if (rsvpMenu) {
                    rsvpMenu.querySelectorAll('[data-filter-val]').forEach(opt => {
                        const check = opt.querySelector('.check-icon');
                        if (check) {
                            check.classList.toggle('hidden', opt.getAttribute('data-filter-val') !== targetFilter);
                        }
                    });
                }

                applyFilters();
                showToast(`Filtered list by ${filterLabels.rsvp[targetFilter]}`, 'info');
            });
        });
    }

    // 5. Apply All Active Filters in Real-Time
    function applyFilters() {
        const rows = document.querySelectorAll('.guest-row');
        let visibleCount = 0;

        const isFiltered = filterState.search !== '' ||
                           filterState.affiliation !== 'all' ||
                           filterState.events !== 'all' ||
                           filterState.rsvp !== 'all' ||
                           filterState.dietary !== 'all';

        // Toggle reset button
        const resetBtn = document.getElementById('btn-reset-filters');
        if (resetBtn) resetBtn.classList.toggle('hidden', !isFiltered);

        rows.forEach(row => {
            const guestName = (row.getAttribute('data-guest-name') || '').toLowerCase();
            const party = (row.getAttribute('data-party') || '').toLowerCase();
            const email = (row.getAttribute('data-email') || '').toLowerCase();
            const affiliation = (row.getAttribute('data-affiliation') || '').toLowerCase();
            const events = (row.getAttribute('data-events') || '').toLowerCase();
            const rsvp = (row.getAttribute('data-rsvp') || '').toLowerCase();
            const dietary = (row.getAttribute('data-dietary') || '').toLowerCase();
            const table = (row.getAttribute('data-table') || '').toLowerCase();

            // Search match
            const matchesSearch = filterState.search === '' ||
                guestName.includes(filterState.search) ||
                party.includes(filterState.search) ||
                email.includes(filterState.search) ||
                table.includes(filterState.search) ||
                (filterState.search === 'bounced' && email.includes('invalid'));

            // Affiliation match
            const matchesAffiliation = filterState.affiliation === 'all' || affiliation.includes(filterState.affiliation);

            // Events match
            const matchesEvents = filterState.events === 'all' || events === filterState.events || events === 'both';

            // RSVP match
            const matchesRsvp = filterState.rsvp === 'all' || rsvp === filterState.rsvp;

            // Dietary match
            const matchesDietary = filterState.dietary === 'all' || dietary.includes(filterState.dietary);

            if (matchesSearch && matchesAffiliation && matchesEvents && matchesRsvp && matchesDietary) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });

        // Also filter household cards
        const householdCards = document.querySelectorAll('.household-card');
        householdCards.forEach(card => {
            const cardSearch = (card.getAttribute('data-search') || '').toLowerCase();
            const matches = filterState.search === '' || cardSearch.includes(filterState.search);
            card.classList.toggle('hidden', !matches);
        });

        // Update counts
        const visibleCountEl = document.getElementById('visible-count');
        if (visibleCountEl) visibleCountEl.textContent = visibleCount;

        // Empty state toggle
        const emptyState = document.getElementById('table-empty-state');
        if (emptyState) {
            emptyState.classList.toggle('hidden', visibleCount > 0);
            emptyState.classList.toggle('flex', visibleCount === 0);
        }

        updateSelectAllCheckboxState();
    }

    function resetAllFilters() {
        filterState.search = '';
        filterState.affiliation = 'all';
        filterState.events = 'all';
        filterState.rsvp = 'all';
        filterState.dietary = 'all';

        const searchInput = document.getElementById('guest-search-input');
        if (searchInput) searchInput.value = '';
        const clearBtn = document.getElementById('clear-search-btn');
        if (clearBtn) clearBtn.classList.add('hidden');

        // Reset labels
        ['affiliation', 'events', 'rsvp', 'dietary'].forEach(type => {
            const labelEl = document.getElementById(`label-${type}`);
            if (labelEl) labelEl.textContent = filterLabels[type]['all'];

            const menu = document.querySelector(`[data-dropdown-menu="${type}"]`);
            if (menu) {
                menu.querySelectorAll('[data-filter-val]').forEach(opt => {
                    const check = opt.querySelector('.check-icon');
                    if (check) {
                        check.classList.toggle('hidden', opt.getAttribute('data-filter-val') !== 'all');
                    }
                });
            }
        });

        applyFilters();
        showToast('All filters and search queries reset');
    }

    // 6. Checkbox Selection & Bulk Action Banner
    function initCheckboxes() {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const rowCheckboxes = document.querySelectorAll('.guest-checkbox');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', (e) => {
                const isChecked = e.target.checked;
                const visibleRows = document.querySelectorAll('.guest-row:not(.hidden)');
                visibleRows.forEach(row => {
                    const cb = row.querySelector('.guest-checkbox');
                    if (cb) {
                        cb.checked = isChecked;
                        highlightRow(row, isChecked);
                    }
                });
                updateBulkBanner();
            });
        }

        rowCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                const row = cb.closest('.guest-row');
                if (row) highlightRow(row, cb.checked);
                updateBulkBanner();
                updateSelectAllCheckboxState();
            });
        });

        updateBulkBanner();
    }

    function highlightRow(row, isSelected) {
        if (isSelected) {
            row.classList.add('bg-[#fdf3f0]/60');
        } else {
            row.classList.remove('bg-[#fdf3f0]/60');
        }
    }

    function updateSelectAllCheckboxState() {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const visibleRows = document.querySelectorAll('.guest-row:not(.hidden)');
        if (!selectAllCheckbox || visibleRows.length === 0) return;

        let allChecked = true;
        let anyChecked = false;

        visibleRows.forEach(row => {
            const cb = row.querySelector('.guest-checkbox');
            if (cb && cb.checked) anyChecked = true;
            else allChecked = false;
        });

        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = !allChecked && anyChecked;
    }

    function updateBulkBanner() {
        const banner = document.getElementById('bulk-action-banner');
        const countText = document.getElementById('bulk-selection-count');
        const checkedBoxes = document.querySelectorAll('.guest-checkbox:checked');
        const count = checkedBoxes.length;

        if (!banner || !countText) return;

        if (count > 0) {
            banner.classList.remove('opacity-60');
            countText.textContent = `${count} Guest${count > 1 ? 's' : ''} Selected across ${Math.min(count, 2)} Household${count > 1 ? 's' : ''}`;
        } else {
            banner.classList.add('opacity-60');
            countText.textContent = '0 Guests Selected (Select checkboxes to perform bulk actions)';
        }
    }

    // Bulk Banner Action Handlers
    window.handleBulkResend = function() {
        const count = document.querySelectorAll('.guest-checkbox:checked').length;
        if (count === 0) {
            showToast('Please select at least one guest first', 'warning');
            return;
        }
        showToast(`✉ Digital RSVP passes re-dispatched to ${count} selected guest households!`, 'success');
    };

    window.handleBulkAssignTable = function() {
        const count = document.querySelectorAll('.guest-checkbox:checked').length;
        if (count === 0) {
            showToast('Please select at least one guest first', 'warning');
            return;
        }
        showToast(`Allocated Table 01 - Presidential to ${count} selected guests`, 'success');
    };

    window.handleBulkMarkAttending = function() {
        const checkedBoxes = document.querySelectorAll('.guest-checkbox:checked');
        if (checkedBoxes.length === 0) {
            showToast('Please select at least one guest first', 'warning');
            return;
        }

        checkedBoxes.forEach(cb => {
            const row = cb.closest('.guest-row');
            if (row) {
                row.setAttribute('data-rsvp', 'attending');
                const badge = row.querySelector('.badge-rsvp');
                if (badge) {
                    badge.className = 'badge-rsvp inline-flex items-center gap-1 rounded-full bg-[#eaf4ec] px-2 py-0.5 text-[10.5px] font-semibold text-[#2f7544]';
                    badge.textContent = 'Attending (Confirmed)';
                }
            }
        });

        showToast(`Marked ${checkedBoxes.length} guests as Attending!`, 'success');
    };

    window.handleBulkDismiss = function() {
        const rowCheckboxes = document.querySelectorAll('.guest-checkbox');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        if (selectAllCheckbox) selectAllCheckbox.checked = false;

        rowCheckboxes.forEach(cb => {
            cb.checked = false;
            const row = cb.closest('.guest-row');
            if (row) highlightRow(row, false);
        });

        updateBulkBanner();
        showToast('Guest selection cleared');
    };
</script>
@endpush
@endsection
