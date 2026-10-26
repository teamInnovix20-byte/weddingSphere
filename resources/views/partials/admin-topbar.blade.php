{{-- Admin top bar: logo, role pill, system status, search, notifications, profile --}}
<header class="sticky top-0 z-30 border-b border-line/60 bg-white/95 backdrop-blur-md">
    <div class="flex h-[60px] items-center gap-3 px-4 sm:px-6">

        {{-- hamburger (below lg) --}}
        <button type="button" data-admin-menu-open aria-expanded="false" aria-controls="adminSidebar" aria-label="Open menu"
                class="inline-flex size-9 items-center justify-center rounded-lg text-[#4a3a3f] transition hover:bg-chip hover:text-wine lg:hidden">
            <x-admin.icon name="menu" :size="20" />
        </button>

        <a href="{{ url('/') }}" class="shrink-0 transition hover:opacity-80" aria-label="WeddingSphere home">
            <img src="{{ asset('images/logo.png') }}" alt="WeddingSphere" class="h-7 w-auto sm:h-8">
        </a>

        <span class="hidden rounded-[5px] bg-gold-bg px-2 py-[3px] text-[9.5px] font-bold uppercase tracking-[.05em] text-gold-ink sm:inline-block">SuperAdmin</span>

        <span class="hidden items-center gap-1.5 rounded-full bg-[#f6f1e8] px-3 py-1.5 text-[10px] font-semibold text-[#5b4a3a] xl:inline-flex">
            <i class="inline-block size-1.5 rounded-full bg-[#2f8f5b]"></i>
            Escrow Node: Operational <span class="text-muted-2">&bull;</span> DB Sync: 100% <span class="text-muted-2">&bull;</span> Colombo UTC+05:30
        </span>

        <div class="ml-auto flex items-center gap-2 sm:gap-3">
            {{-- search (md+) --}}
            <label class="hidden h-[34px] w-[230px] items-center gap-2 rounded-lg bg-[#f4f0e9] px-3 transition focus-within:bg-white focus-within:ring-[3px] focus-within:ring-wine/10 md:flex lg:w-[250px] xl:w-[300px]">
                <x-admin.icon name="search" :size="14" class="text-muted" />
                <input id="globalSearch" type="search" placeholder="Search users, vendors, bookings, invoices..."
                       class="min-w-0 flex-1 border-0 bg-transparent text-[11px] text-ink outline-none placeholder:text-muted-2">
                <kbd class="hidden rounded bg-white px-1.5 py-0.5 font-sans text-[9px] font-semibold text-muted shadow-sm lg:inline">Ctrl+K</kbd>
            </label>

            {{-- notifications --}}
            <button type="button" class="relative inline-flex rounded-full p-1.5 text-[#4a3a3f] transition hover:bg-chip hover:text-wine" aria-label="Notifications, 5 new">
                <x-admin.icon name="bell" :size="17" />
                <span class="absolute -right-0.5 -top-0.5 inline-flex size-[15px] items-center justify-center rounded-full bg-[#c43d4b] text-[8.5px] font-bold text-white ring-2 ring-white">5</span>
            </button>

            <span class="hidden h-6 w-px bg-line sm:block"></span>

            {{-- profile --}}
            <button type="button" class="flex items-center gap-2 rounded-full bg-[#f6f1e8] py-1 pl-1 pr-2.5 text-left transition hover:bg-chip sm:pr-3">
                <span class="inline-flex size-7 shrink-0 items-center justify-center rounded-full bg-wine text-white"><x-admin.icon name="user" :size="14" /></span>
                <span class="hidden leading-tight sm:block">
                    <strong class="block text-[10.5px] font-bold text-ink">Dr. Lasantha Alwis</strong>
                    <small class="block text-[9.5px] font-semibold text-gold-ink">Lead Platform Administrator</small>
                </span>
                <x-admin.icon name="chevron-down" :size="13" class="hidden text-muted sm:block" />
            </button>
        </div>
    </div>

    {{-- search for phones (md and below) --}}
    <div class="border-t border-line/50 px-4 pb-2.5 pt-2 md:hidden">
        <label class="flex h-9 items-center gap-2 rounded-lg bg-[#f4f0e9] px-3">
            <x-admin.icon name="search" :size="14" class="text-muted" />
            <input type="search" placeholder="Search users, vendors, bookings..." class="min-w-0 flex-1 border-0 bg-transparent text-[12px] text-ink outline-none placeholder:text-muted-2">
        </label>
    </div>
</header>
