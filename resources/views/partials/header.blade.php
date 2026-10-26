{{-- Responsive header: full menu on desktop (lg+), hamburger menu on tablet / phone --}}
<header class="sticky top-0 z-30 bg-bg/90 backdrop-blur-md">
    <div class="ws-container relative flex h-16 items-center gap-3 lg:gap-[18px]">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="shrink-0 transition duration-200 hover:opacity-80" aria-label="WeddingSphere home">
            <img src="{{ asset('images/logo.png') }}" alt="WeddingSphere" class="h-8 w-auto sm:h-9">
        </a>

        {{-- Mode pill (wide screens only) --}}
        <span class="hidden items-center gap-[5px] rounded-full bg-[#efe5e3] px-[11px] py-1.5 text-[9.5px] font-bold uppercase tracking-[.06em] text-[#5b4a4f] xl:inline-flex">
            <x-icon name="swap" :size="11" /> Couple Mode
        </span>

        {{-- Desktop navigation --}}
        <nav class="ml-2 hidden gap-5 lg:flex xl:ml-3.5 xl:gap-[26px]" aria-label="Main navigation">
            <a href="{{ url('/') }}" class="text-[12px] font-medium text-[#4a3a3f] transition hover:text-wine">Home</a>
            <a href="#" class="text-[12px] font-medium text-[#4a3a3f] transition hover:text-wine">Explore Vendors</a>
            <a href="#" class="text-[12px] font-medium text-[#4a3a3f] transition hover:text-wine">How It Works</a>
            <a href="#" class="text-[12px] font-medium text-[#4a3a3f] transition hover:text-wine">About Us</a>
        </nav>

        {{-- Right side --}}
        <div class="ml-auto flex items-center gap-3 sm:gap-4">
            <button type="button" class="relative inline-flex rounded-full p-1 text-[#4a3a3f] transition hover:bg-chip hover:text-wine" aria-label="Notifications">
                <x-icon name="bell" :size="17" />
                <span class="absolute right-[3px] top-0.5 size-[7px] rounded-full border-[1.5px] border-bg bg-[#c43d4b]"></span>
            </button>

            <a href="{{ route('login') }}" class="hidden text-[12px] font-medium text-[#4a3a3f] transition hover:text-wine lg:inline">Log In</a>
            <a href="{{ route('portal.index') }}" class="btn-sm hidden lg:inline-flex">Start Planning</a>

            {{-- Profile picture: shows the photo the user uploaded in Edit Profile --}}
            <x-avatar />

            {{-- Hamburger (below lg) --}}
            <button type="button" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu" aria-label="Open menu"
                    class="inline-flex size-9 items-center justify-center rounded-lg text-[#4a3a3f] transition hover:bg-chip hover:text-wine lg:hidden">
                <svg data-icon-open xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg data-icon-close xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true" class="hidden"><path d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile / tablet menu --}}
    <div id="mobile-menu" data-mobile-menu class="hidden border-t border-line bg-bg shadow-lg shadow-wine/10 lg:hidden">
        <div class="ws-container flex flex-col gap-1 py-3">
            <span class="mb-1 inline-flex w-fit items-center gap-[5px] rounded-full bg-[#efe5e3] px-[11px] py-1.5 text-[9.5px] font-bold uppercase tracking-[.06em] text-[#5b4a4f]">
                <x-icon name="swap" :size="11" /> Couple Mode
            </span>

            <a href="{{ url('/') }}" class="rounded-lg px-3 py-2.5 text-[13px] font-medium text-[#4a3a3f] transition hover:bg-chip hover:text-wine">Home</a>
            <a href="#" class="rounded-lg px-3 py-2.5 text-[13px] font-medium text-[#4a3a3f] transition hover:bg-chip hover:text-wine">Explore Vendors</a>
            <a href="#" class="rounded-lg px-3 py-2.5 text-[13px] font-medium text-[#4a3a3f] transition hover:bg-chip hover:text-wine">How It Works</a>
            <a href="#" class="rounded-lg px-3 py-2.5 text-[13px] font-medium text-[#4a3a3f] transition hover:bg-chip hover:text-wine">About Us</a>

            <div class="mt-2 grid grid-cols-2 gap-2 border-t border-line pt-3">
                <a href="{{ route('login') }}" class="btn btn-soft">Log In</a>
                <a href="{{ route('portal.index') }}" class="btn btn-primary">Start Planning</a>
            </div>
        </div>
    </div>
</header>
