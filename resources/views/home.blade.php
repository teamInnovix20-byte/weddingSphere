{{--
    WeddingSphere homepage (hero + vendor search).

    NOTE: the project archive had no WeddingSphere homepage Blade (the "/" route redirects to /login
    and welcome.blade.php is Laravel's default page). This page recreates the hero from the supplied
    screenshot so the vendor search section has a home. If your team builds the real homepage,
    keep only the <x-vendor-search-form> line and the two "Explore Vendors" links.
--}}
@extends('layouts.app')

@section('title', 'WeddingSphere - Your Dream Wedding, Beautifully Organised')

@section('content')
<section class="pb-16 pt-10 sm:pt-14 lg:pt-[72px]">
    <div class="ws-container grid items-center gap-10 lg:grid-cols-[minmax(0,1.25fr)_minmax(0,.85fr)] lg:gap-12">

        {{-- Left: copy + search --}}
        <div class="min-w-0">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-gold-bg px-3 py-1.5 text-[10.5px] font-medium text-gold-ink">
                <x-icon name="badge" :size="12" /> 1,200+ Verified Sri Lankan Vendors &bull; 4.9/5 Couple Rating
            </span>

            <h1 class="mt-5 font-serif text-[34px] font-bold leading-[1.12] text-ink sm:text-[42px]">
                Your Dream Wedding,
                <em class="block font-semibold italic text-wine">Beautifully Organised.</em>
            </h1>

            <p class="mt-5 max-w-[500px] text-[14px] leading-[1.7] text-muted">
                Plan your perfect wedding, discover trusted island-wide vendors, manage bookings, and bring every
                sacred ritual and celebration together in one timeless canvas.
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
                <a href="{{ route('portal.index') }}" class="btn btn-primary w-auto px-6">
                    Start Planning Free <x-icon name="arrow-right" :size="13" />
                </a>
                <a href="{{ route('vendors.explore') }}" class="btn btn-soft w-auto px-5">
                    <x-icon name="compass" :size="14" /> Explore Vendors
                </a>
            </div>

            {{-- Vendor search form (shared component) --}}
            <x-vendor-search-form prefix="hero" class="mt-8 max-w-[600px]" />
        </div>

        {{-- Right: picture card. No wedding photo exists in the project yet, so this is a placeholder.
             Drop a real photo at public/images/hero-couple.jpg and it will appear automatically. --}}
        <div class="group relative mx-auto aspect-[4/5] w-full max-w-[380px] overflow-hidden rounded-[18px]
                    bg-[linear-gradient(160deg,#c9a89a_0%,#7d3b50_55%,#5c132e_100%)]
                    shadow-[0_24px_56px_rgba(92,19,46,.22)] lg:mx-0 lg:max-w-none">
            <x-bg-image src="images/hero-couple.jpg" />
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,transparent_45%,rgba(92,19,46,.8)_100%)]"></div>
            <p class="absolute inset-x-6 bottom-6 font-serif text-[19px] font-semibold text-white">Poruwa Ceremony, Galle Fort</p>
        </div>
    </div>
</section>
@endsection
