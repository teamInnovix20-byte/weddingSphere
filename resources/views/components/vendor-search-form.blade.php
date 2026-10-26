{{--
    Vendor search form (Category / Location / Wedding Date / Find Vendors).

    Used on:
      - the homepage hero              <x-vendor-search-form prefix="hero" />
      - the Explore Vendors page       <x-vendor-search-form prefix="explore" />

    It is a plain GET form, so it works even without JavaScript:
      /vendors?category=photography&location=colombo&date=2026-12-12
    On the Explore Vendors page, resources/js/explore-vendors.js intercepts the
    submit and filters the sample vendors in the browser instead of reloading.

    The option keys (slugs) below MUST match the `category` / `location` values in
    resources/js/vendor-data.js.
--}}
@props(['prefix' => 'ws', 'action' => null])

@php
    $categories = [
        'venues'      => 'Venues & Hotels',
        'photography' => 'Photography & Video',
        'catering'    => 'Catering',
        'decoration'  => 'Decoration & Florals',
        'bridal'      => 'Bridal Wear & Jewellery',
        'beauty'      => 'Makeup & Hair',
        'music'       => 'Music & Entertainment',
        'cakes'       => 'Cakes & Desserts',
        'transport'   => 'Wedding Transport',
        'invitations' => 'Invitations & Stationery',
    ];

    $locations = [
        'colombo'       => 'Colombo',
        'negombo'       => 'Negombo',
        'kalutara'      => 'Kalutara & Bentota',
        'kandy'         => 'Kandy',
        'galle'         => 'Galle',
        'matara'        => 'Matara',
        'nuwara-eliya'  => 'Nuwara Eliya',
        'kurunegala'    => 'Kurunegala',
        'anuradhapura'  => 'Anuradhapura',
        'jaffna'        => 'Jaffna',
        'trincomalee'   => 'Trincomalee',
    ];

    // Pre-select values coming from the URL (only accept known values)
    $known = fn ($value, array $list) => is_string($value) && array_key_exists($value, $list);
    $selCategory = $known(request('category'), $categories) ? request('category') : '';
    $selLocation = $known(request('location'), $locations) ? request('location') : '';
    $selDate = is_string(request('date')) && preg_match('/^\d{4}-\d{2}-\d{2}$/', request('date')) ? request('date') : '';

    $labelClass = 'mb-[7px] flex items-center gap-1.5 text-[11px] font-semibold text-ink';
    $controlClass = 'relative flex h-[42px] items-center rounded-lg border border-transparent bg-field transition
                     focus-within:border-wine focus-within:bg-white focus-within:ring-[3px] focus-within:ring-wine/10 hover:border-wine/30';
@endphp

<form method="GET"
      action="{{ $action ?? route('vendors.explore') }}"
      data-vendor-search-form
      role="search"
      aria-label="Search wedding vendors"
      {{ $attributes->class(['grid grid-cols-1 gap-3 rounded-xl bg-white p-3 shadow-[0_12px_32px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)]
                              sm:grid-cols-2 sm:p-3.5 md:grid-cols-3 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)_minmax(0,1fr)_auto] lg:items-end lg:gap-2.5']) }}>

    {{-- Category --}}
    <div class="min-w-0">
        <label for="{{ $prefix }}-category" class="{{ $labelClass }}">
            <x-icon name="store" :size="12" class="text-muted" /> Category
        </label>
        <div class="{{ $controlClass }}">
            <select id="{{ $prefix }}-category" name="category"
                    class="h-full w-full min-w-0 cursor-pointer appearance-none rounded-lg border-0 bg-transparent pl-3 pr-7 text-[12.5px] text-ink outline-none">
                <option value="">All Categories</option>
                @foreach ($categories as $value => $label)
                    <option value="{{ $value }}" @selected($selCategory === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-icon name="chevron-down" :size="14" class="pointer-events-none absolute right-2.5 text-muted" />
        </div>
    </div>

    {{-- Location --}}
    <div class="min-w-0">
        <label for="{{ $prefix }}-location" class="{{ $labelClass }}">
            <x-icon name="map-pin" :size="12" class="text-muted" /> Location
        </label>
        <div class="{{ $controlClass }}">
            <select id="{{ $prefix }}-location" name="location"
                    class="h-full w-full min-w-0 cursor-pointer appearance-none rounded-lg border-0 bg-transparent pl-3 pr-7 text-[12.5px] text-ink outline-none">
                <option value="">Island-wide</option>
                @foreach ($locations as $value => $label)
                    <option value="{{ $value }}" @selected($selLocation === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-icon name="chevron-down" :size="14" class="pointer-events-none absolute right-2.5 text-muted" />
        </div>
    </div>

    {{-- Wedding date (native browser calendar picker) --}}
    <div class="min-w-0 sm:col-span-2 md:col-span-1">
        <label for="{{ $prefix }}-date" class="{{ $labelClass }}">
            <x-icon name="calendar" :size="12" class="text-muted" /> Wedding Date
        </label>
        <div class="{{ $controlClass }}">
            <input id="{{ $prefix }}-date" type="date" name="date" value="{{ $selDate }}"
                   min="{{ now()->toDateString() }}"
                   class="h-full w-full min-w-0 cursor-pointer rounded-lg border-0 bg-transparent px-3 text-[12.5px] text-ink outline-none">
        </div>
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary w-full px-5 sm:col-span-2 md:col-span-3 lg:col-span-1 lg:w-auto">
        <x-icon name="search" :size="14" /> Find Vendors
    </button>
</form>
