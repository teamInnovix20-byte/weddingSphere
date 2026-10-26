@extends('layouts.app')

@section('title', 'Choose Your Portal - WeddingSphere')

@section('content')
<section class="pb-[52px] pt-[34px] text-center">
    <div class="ws-container">

        <span class="inline-flex items-center gap-1.5 rounded-full bg-gold-bg px-[13px] py-1.5 text-[9.5px] font-bold uppercase tracking-[.08em] text-gold-ink transition duration-300 hover:-translate-y-0.5 hover:shadow-md"><x-icon name="badge" :size="12" /> Join the Collective</span>

        <h1 class="mb-2 mt-4 font-serif text-[25px] font-bold leading-[1.2] text-ink sm:text-[31px]">How would you like to use <em class="font-semibold italic text-wine">WeddingSphere</em>?</h1>
        <p class="mx-auto max-w-[440px] text-[13.5px] text-muted">Choose how you would like to join Sri Lanka's premier wedding planning network.</p>

        @if (session('status'))
            <div class="mt-4 inline-block rounded-lg bg-success-bg px-4 py-2 text-[12px] font-medium text-success-ink">{{ session('status') }}</div>
        @endif

        <div class="mx-auto mt-[34px] grid max-w-[880px] grid-cols-1 gap-4 text-left md:grid-cols-2">

            {{-- Card: couple --}}
            <article class="group relative flex flex-col overflow-hidden rounded-[14px] bg-white shadow-[0_12px_30px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_22px_48px_rgba(92,19,46,.18),0_1px_3px_rgba(92,19,46,.06)]">
                {{-- OPTIONAL BACKGROUND PICTURE: put your photo at public/images/portal-couple.jpg --}}
                <x-bg-image src="images/portal-couple.jpg" overlay="bg-white/80" />
                {{-- decorative glow + small circle (top-right) --}}
                <span class="pointer-events-none absolute -right-[50px] -top-[50px] size-[180px] rounded-full bg-[radial-gradient(circle,rgba(255,226,160,.6),transparent_70%)]"></span>
                <span class="pointer-events-none absolute right-5 top-[18px] size-[22px] rounded-full bg-[#f1e8e6]"></span>

                <div class="relative z-10 flex flex-1 flex-col px-5 pb-[26px] pt-6 sm:px-[26px]">
                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full px-2.5 py-[5px] text-[9px] font-bold uppercase tracking-[.07em] bg-gold-bg text-gold-ink"><x-icon name="heart" :size="11" /> For Couples &amp; Planners</span>
                    <span class="mb-3.5 mt-[22px] inline-flex size-11 items-center justify-center rounded-[10px] bg-[#f5e8e6] text-wine transition duration-300 group-hover:scale-110 group-hover:bg-wine group-hover:text-white"><x-icon name="sparkles" :size="22" /></span>
                    <h3 class="mb-2 font-serif text-[21px] font-bold">I'm Planning a Wedding</h3>
                    <p class="text-[12px] leading-[1.6] text-muted sm:min-h-[76px]">Discover top-tier Sri Lankan vendors, manage budgets, track RSVPs, curate your poruwa ceremony timeline, and streamline bookings in one place.</p>
                    <ul class="m-0 mt-[18px] flex-1 list-none p-0">
                        <li class="mb-[9px] flex items-center gap-2 text-[11.5px] text-[#4a3a3f]"><span class="inline-flex size-4 shrink-0 items-center justify-center rounded-full bg-success-bg text-success-ink"><x-icon name="check" :size="10" /></span> 1,200+ verified island-wide vendors</li>
                        <li class="mb-[9px] flex items-center gap-2 text-[11.5px] text-[#4a3a3f]"><span class="inline-flex size-4 shrink-0 items-center justify-center rounded-full bg-success-bg text-success-ink"><x-icon name="check" :size="10" /></span> Master itinerary &amp; nekath time sync</li>
                        <li class="mb-[9px] flex items-center gap-2 text-[11.5px] text-[#4a3a3f]"><span class="inline-flex size-4 shrink-0 items-center justify-center rounded-full bg-success-bg text-success-ink"><x-icon name="check" :size="10" /></span> Zero-fee direct messaging &amp; inquiries</li>
                    </ul>
                    <a href="{{ route('portal.choose', 'couple') }}" class="btn btn-primary mt-6">
                        Continue as Bride / Groom <x-icon name="arrow-right" :size="13" />
                    </a>
                </div>
            </article>

            {{-- Card: vendor --}}
            <article class="group relative flex flex-col overflow-hidden rounded-[14px] bg-white shadow-[0_12px_30px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_22px_48px_rgba(92,19,46,.18),0_1px_3px_rgba(92,19,46,.06)]">
                {{-- OPTIONAL BACKGROUND PICTURE: put your photo at public/images/portal-vendor.jpg --}}
                <x-bg-image src="images/portal-vendor.jpg" overlay="bg-white/80" />
                {{-- decorative glow + small circle (top-right) --}}
                <span class="pointer-events-none absolute -right-[50px] -top-[50px] size-[180px] rounded-full bg-[radial-gradient(circle,rgba(255,205,220,.5),transparent_70%)]"></span>
                <span class="pointer-events-none absolute right-5 top-[18px] size-[22px] rounded-full bg-[#f1e8e6]"></span>

                <div class="relative z-10 flex flex-1 flex-col px-5 pb-[26px] pt-6 sm:px-[26px]">
                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full px-2.5 py-[5px] text-[9px] font-bold uppercase tracking-[.07em] bg-[#efe8e6] text-[#5b4a4f]"><x-icon name="building" :size="11" /> For Businesses &amp; Artisans</span>
                    <span class="mb-3.5 mt-[22px] inline-flex size-11 items-center justify-center rounded-[10px] bg-[#f5e8e6] text-wine transition duration-300 group-hover:scale-110 group-hover:bg-wine group-hover:text-white"><x-icon name="building" :size="22" /></span>
                    <h3 class="mb-2 font-serif text-[21px] font-bold">I Provide Wedding Services</h3>
                    <p class="text-[12px] leading-[1.6] text-muted sm:min-h-[76px]">Showcase your portfolio, receive qualified inquiry leads, manage availability calendars with automated date locking, and grow your wedding business.</p>
                    <ul class="m-0 mt-[18px] flex-1 list-none p-0">
                        <li class="mb-[9px] flex items-center gap-2 text-[11.5px] text-[#4a3a3f]"><span class="inline-flex size-4 shrink-0 items-center justify-center rounded-full bg-success-bg text-success-ink"><x-icon name="check" :size="10" /></span> Automated availability &amp; booking locks</li>
                        <li class="mb-[9px] flex items-center gap-2 text-[11.5px] text-[#4a3a3f]"><span class="inline-flex size-4 shrink-0 items-center justify-center rounded-full bg-success-bg text-success-ink"><x-icon name="check" :size="10" /></span> Direct inquiry inbox &amp; contract management</li>
                        <li class="mb-[9px] flex items-center gap-2 text-[11.5px] text-[#4a3a3f]"><span class="inline-flex size-4 shrink-0 items-center justify-center rounded-full bg-success-bg text-success-ink"><x-icon name="check" :size="10" /></span> Verified Partner &amp; Super Vendor badge perks</li>
                    </ul>
                    <a href="{{ route('portal.choose', 'vendor') }}" class="btn btn-soft mt-6">
                        Continue as Vendor <x-icon name="arrow-right" :size="13" />
                    </a>
                </div>
            </article>
        </div>

        <p class="mt-6 text-[12px] text-muted">Already have an account? <a href="{{ route('login') }}" class="font-semibold text-wine-dark underline underline-offset-2 transition hover:text-wine">Log In</a></p>

        <span class="pill mt-3 bg-[#f3e9e7] px-4 py-2 text-[10.5px]"><x-icon name="check" :size="12" /><span>Trusted by over <strong class="font-bold text-ink">10,000+ couples</strong> and <strong class="font-bold text-ink">1,200+ premier vendors</strong> in Sri Lanka</span></span>
    </div>
</section>
@endsection
