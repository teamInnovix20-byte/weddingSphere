{{--
    Explore Vendors (couples) - FRONTEND ONLY.
    Searching, filtering, sorting and pagination run in the browser with the sample data in
    resources/js/vendor-data.js. The script is resources/js/explore-vendors.js (loaded from app.js
    when it finds the [data-explore-vendors] attribute below).
--}}
@extends('layouts.app')

@section('title', 'Explore Vendors - WeddingSphere')

@section('content')
@php
    $selectClass = 'h-[42px] w-full cursor-pointer appearance-none rounded-lg border border-transparent bg-field pl-3 pr-8 text-[12.5px] text-ink outline-none transition
                    focus:border-wine focus:bg-white focus:ring-[3px] focus:ring-wine/10 hover:border-wine/30';
    $optionLabel = 'block rounded-lg bg-field px-3 py-2 text-[12px] text-[#4a3a3f] transition hover:bg-chip
                    peer-checked:bg-wine peer-checked:font-semibold peer-checked:text-white
                    peer-focus-visible:ring-[3px] peer-focus-visible:ring-wine/30';
@endphp

<section class="pb-16 pt-8 sm:pt-10" data-explore-vendors>
    <div class="ws-container">

        {{-- Heading --}}
        <header class="max-w-[620px]">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-gold-bg px-3 py-1.5 text-[9.5px] font-bold uppercase tracking-[.08em] text-gold-ink">
                <x-icon name="compass" :size="12" /> Vendor Directory
            </span>
            <h1 class="mb-2 mt-4 font-serif text-[27px] font-bold leading-[1.15] text-ink sm:text-[34px]">
                Explore <em class="font-semibold italic text-wine">Wedding Vendors</em>
            </h1>
            <p class="text-[13.5px] leading-[1.65] text-muted">
                Discover trusted wedding service providers across Sri Lanka. Search by category, location and your wedding date,
                then narrow the results by budget and rating.
            </p>
        </header>

        {{-- Search controls (same form as the homepage) --}}
        <x-vendor-search-form prefix="explore" class="mt-6" />

        {{-- Filters + results --}}
        <div class="mt-8 grid gap-6 lg:grid-cols-[232px_minmax(0,1fr)] lg:gap-7">

            {{-- Filters sidebar (collapsible below lg) --}}
            <aside aria-label="Filters">
                <button type="button" data-filter-toggle aria-expanded="false" aria-controls="filter-panel"
                        class="flex h-[42px] w-full items-center justify-between rounded-lg bg-white px-4 text-[12.5px] font-semibold text-ink
                               shadow-[0_6px_18px_rgba(92,19,46,.07)] transition hover:shadow-md lg:hidden">
                    <span class="inline-flex items-center gap-2"><x-icon name="sliders" :size="15" class="text-wine" /> Filters
                        <span data-filter-badge class="hidden rounded-full bg-wine px-2 py-0.5 text-[10px] font-bold text-white"></span>
                    </span>
                    <x-icon name="chevron-down" :size="15" class="text-muted" />
                </button>

                <div id="filter-panel" data-filter-panel
                     class="mt-3 hidden rounded-xl bg-white p-4 shadow-[0_12px_32px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)] lg:mt-0 lg:block">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="inline-flex items-center gap-2 text-[13px] font-bold text-ink"><x-icon name="sliders" :size="14" class="text-wine" /> Filters</h2>
                        <button type="button" data-reset class="inline-flex items-center gap-1 text-[11px] font-semibold text-wine-dark transition hover:underline">
                            <x-icon name="rotate-ccw" :size="11" /> Reset all
                        </button>
                    </div>

                    <fieldset class="m-0 border-0 p-0">
                        <legend class="mb-2 p-0 text-[11px] font-semibold text-ink">Starting price (LKR)</legend>
                        <div class="flex flex-wrap gap-2 lg:flex-col lg:gap-1.5">
                            @foreach (['' => 'Any price', 'under-100k' => 'Under 100,000', '100k-300k' => '100,000 – 300,000', '300k-750k' => '300,000 – 750,000', 'over-750k' => 'Over 750,000'] as $value => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="price" value="{{ $value }}" class="peer sr-only" @checked($value === '')>
                                    <span class="{{ $optionLabel }}">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    <fieldset class="m-0 mt-5 border-0 p-0">
                        <legend class="mb-2 p-0 text-[11px] font-semibold text-ink">Minimum rating</legend>
                        <div class="flex flex-wrap gap-2 lg:flex-col lg:gap-1.5">
                            @foreach (['' => 'Any rating', '4.8' => '4.8 & up', '4.5' => '4.5 & up', '4' => '4.0 & up', '3.5' => '3.5 & up'] as $value => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $value }}" class="peer sr-only" @checked($value === '')>
                                    <span class="{{ $optionLabel }} inline-flex w-full items-center gap-1.5">
                                        @if ($value !== '') <x-icon name="star" :size="11" class="fill-current" /> @endif {{ $label }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </aside>

            {{-- Results column --}}
            <div class="min-w-0 scroll-mt-24" id="results" data-results>

                {{-- Keyword search + sort --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative flex-1">
                        <label for="vendor-keyword" class="sr-only">Search vendors by name or keyword</label>
                        <x-icon name="search" :size="14" class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-muted" />
                        <input id="vendor-keyword" type="search" data-keyword autocomplete="off" placeholder="Search by vendor name or keyword"
                               class="h-[42px] w-full rounded-lg border border-transparent bg-white pl-10 pr-3 text-[12.5px] text-ink outline-none
                                      shadow-[0_6px_18px_rgba(92,19,46,.07)] transition placeholder:text-[#a3979a]
                                      focus:border-wine focus:ring-[3px] focus:ring-wine/10 hover:border-wine/30">
                    </div>
                    <div class="flex items-center gap-2 sm:w-[230px]">
                        <label for="vendor-sort" class="shrink-0 text-[11px] font-semibold text-ink">Sort by</label>
                        <div class="relative flex-1">
                            <select id="vendor-sort" data-sort class="{{ $selectClass }} bg-white shadow-[0_6px_18px_rgba(92,19,46,.07)]">
                                <option value="recommended">Recommended</option>
                                <option value="rating">Highest rated</option>
                                <option value="reviews">Most reviewed</option>
                                <option value="price-asc">Price: Low to High</option>
                                <option value="price-desc">Price: High to Low</option>
                            </select>
                            <x-icon name="chevron-down" :size="14" class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-muted" />
                        </div>
                    </div>
                </div>

                {{-- Count + active filter chips --}}
                <div class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-2">
                    <p data-count role="status" aria-live="polite" class="text-[12.5px] font-semibold text-ink"></p>
                    <div data-chips class="flex flex-wrap items-center gap-2"></div>
                </div>

                {{-- Vendor grid --}}
                <div data-grid class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2"></div>

                {{-- Empty state --}}
                <div data-empty hidden class="mt-4 rounded-xl bg-white px-6 py-12 text-center shadow-[0_12px_32px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)]">
                    <span class="mx-auto inline-flex size-12 items-center justify-center rounded-full bg-chip text-wine"><x-icon name="search" :size="22" /></span>
                    <h3 class="mt-4 font-serif text-[20px] font-semibold text-ink">No vendors match your search</h3>
                    <p class="mx-auto mt-1.5 max-w-[360px] text-[12.5px] leading-[1.6] text-muted">
                        Try a different category or location, widen your budget or rating, or clear the keyword.
                    </p>
                    <button type="button" data-reset class="btn btn-primary mx-auto mt-5 w-auto px-6">
                        <x-icon name="rotate-ccw" :size="13" /> Clear all filters
                    </button>
                </div>

                {{-- Pagination --}}
                <nav data-pagination aria-label="Vendor results pages" class="mt-7 flex flex-wrap items-center justify-center gap-1.5"></nav>

                <p class="mt-6 flex items-start gap-2 text-[11px] leading-[1.6] text-muted">
                    <x-icon name="info" :size="13" class="mt-px shrink-0" />
                    <span>These are sample vendor listings for the frontend preview. Photos are placeholders, and availability for your wedding date is not checked yet.</span>
                </p>
            </div>
        </div>
    </div>

    {{-- Vendor card (cloned by explore-vendors.js for every result) --}}
    <template id="vendor-card-template">
        <article class="group flex flex-col overflow-hidden rounded-[14px] bg-white shadow-[0_12px_30px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)]
                        transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_44px_rgba(92,19,46,.16),0_1px_3px_rgba(92,19,46,.06)]">
            <div data-f="image" class="relative flex h-[148px] items-center justify-center overflow-hidden" role="img" aria-label="Photo placeholder">
                <svg data-f="icon" class="size-12 text-white/70 transition duration-500 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"></svg>
                <span data-f="category" class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-[9px] font-bold uppercase tracking-[.06em] text-wine-dark"></span>
                <span class="absolute bottom-2 right-3 text-[9px] font-medium text-white/70" aria-hidden="true">Photo placeholder</span>
            </div>

            <div class="flex flex-1 flex-col p-4">
                <h3 data-f="name" class="font-serif text-[17px] font-semibold leading-[1.25] text-ink"></h3>

                <p class="mt-1.5 flex flex-wrap items-center gap-x-1.5 text-[11.5px] text-muted">
                    <x-icon name="map-pin" :size="12" class="shrink-0" />
                    <span data-f="location"></span>
                    <span data-f="travel" hidden class="rounded-full bg-success-bg px-2 py-0.5 text-[9.5px] font-semibold text-success-ink">Travels island-wide</span>
                </p>

                <p class="mt-2 flex items-center gap-1.5 text-[12px]">
                    <x-icon name="star" :size="13" class="shrink-0 fill-current text-[#d29b1f]" />
                    <strong data-f="rating" class="font-bold text-ink"></strong>
                    <span data-f="reviews" class="text-muted"></span>
                </p>

                <p data-f="description" class="mt-2.5 line-clamp-3 text-[12px] leading-[1.6] text-muted"></p>

                <div class="mt-auto flex items-end justify-between gap-3 pt-4">
                    <div class="min-w-0">
                        <span class="block text-[10px] text-muted-2">Starting from</span>
                        <strong data-f="price" class="block text-[14px] font-bold text-wine-dark"></strong>
                        <span data-f="priceNote" class="block truncate text-[10px] text-muted-2"></span>
                    </div>
                    <button type="button" data-f="details"
                            class="btn btn-soft w-auto shrink-0 px-4 focus-visible:ring-[3px] focus-visible:ring-wine/30 focus-visible:outline-none">View Details</button>
                </div>
            </div>
        </article>
    </template>

    {{-- Vendor details popup (frontend preview only) --}}
    <dialog data-dialog aria-labelledby="vendor-dialog-title"
            class="m-auto w-[calc(100%-32px)] max-w-[480px] overflow-hidden rounded-[14px] bg-white p-0 text-ink shadow-[0_24px_64px_rgba(92,19,46,.3)] backdrop:bg-ink/50 backdrop:backdrop-blur-[2px]">
        <div data-d="image" class="relative flex h-[120px] items-center justify-center">
            <svg data-d="icon" class="size-12 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"></svg>
            <button type="button" data-dialog-close aria-label="Close"
                    class="absolute right-3 top-3 inline-flex size-8 items-center justify-center rounded-full bg-white/90 text-wine-dark transition hover:bg-white hover:scale-105">
                <x-icon name="x" :size="15" />
            </button>
        </div>
        <div class="p-5 sm:p-6">
            <span data-d="category" class="inline-block rounded-full bg-chip px-2.5 py-1 text-[9px] font-bold uppercase tracking-[.06em] text-wine-dark"></span>
            <h2 id="vendor-dialog-title" data-d="name" class="mt-2 font-serif text-[22px] font-semibold leading-[1.2]"></h2>
            <p class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-[12px] text-muted">
                <span class="inline-flex items-center gap-1.5"><x-icon name="map-pin" :size="12" /><span data-d="location"></span></span>
                <span class="inline-flex items-center gap-1.5"><x-icon name="star" :size="12" class="fill-current text-[#d29b1f]" /><strong data-d="rating" class="text-ink"></strong><span data-d="reviews"></span></span>
            </p>
            <p data-d="description" class="mt-3 text-[12.5px] leading-[1.65] text-muted"></p>
            <ul data-d="highlights" class="m-0 mt-3 flex list-none flex-wrap gap-2 p-0"></ul>
            <div class="mt-4 rounded-lg bg-bg-soft px-3.5 py-3">
                <span class="block text-[10px] text-muted-2">Starting from</span>
                <strong data-d="price" class="text-[16px] font-bold text-wine-dark"></strong>
                <span data-d="priceNote" class="ml-1 text-[11px] text-muted-2"></span>
            </div>
            <p class="mt-4 flex items-start gap-2 rounded-lg bg-chip px-3 py-2.5 text-[11px] leading-[1.55] text-[#5d4a50]">
                <x-icon name="info" :size="13" class="mt-px shrink-0" />
                Preview only: full vendor profiles, enquiries and bookings are not built yet, so this card shows sample details.
            </p>
            <button type="button" data-dialog-close class="btn btn-primary mt-4">Close</button>
        </div>
    </dialog>

    {{-- Small feedback message (e.g. "Showing 4 vendors...") --}}
    <div data-toast role="status" aria-live="polite"
         class="pointer-events-none fixed inset-x-4 bottom-6 z-50 mx-auto w-fit max-w-[calc(100%-32px)] translate-y-3 rounded-lg bg-ink px-4 py-2.5 text-center text-[12px] font-medium text-white opacity-0 shadow-lg transition duration-300 data-show:translate-y-0 data-show:opacity-100"></div>
</section>
@endsection
