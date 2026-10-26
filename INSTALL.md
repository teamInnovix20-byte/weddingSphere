# Explore Vendors module - install guide

Frontend only. No controllers, models, migrations, API calls or database access.
Built against the repo as uploaded (Laravel 13, Blade, Tailwind v4 via Vite, no icon package).

## A. NEW files (just copy them in; they do not exist in the repo)

| Path | Purpose |
|---|---|
| resources/views/components/vendor-search-form.blade.php | Category / Location / Wedding Date / Find Vendors form (`<x-vendor-search-form>`), used on both pages |
| resources/views/home.blade.php | Homepage hero + search (the repo had no WeddingSphere homepage, see note 1) |
| resources/views/vendors/explore.blade.php | Explore Vendors results page |
| resources/js/explore-vendors.js | Search, filter, sort, pagination, popup logic |
| resources/js/vendor-data.js | 26 fictional sample vendors |

## B. MODIFIED files (shared files - if a teammate changed them, apply only the snippets below instead of overwriting)

1. routes/web.php - append at the end:

    Route::view('/home', 'home')->name('home');
    Route::view('/vendors', 'vendors.explore')->name('vendors.explore');

2. resources/views/partials/header.blade.php - only the two "Explore Vendors" links change:
   - desktop nav: `href="#"` becomes `href="{{ route('vendors.explore') }}"` (plus an active-page style, see the file)
   - mobile menu: `href="#"` becomes `href="{{ route('vendors.explore') }}"`

3. resources/js/app.js - append at the end:

    if (document.querySelector('[data-explore-vendors]')) {
        import('./explore-vendors.js');
    }

4. resources/views/components/icon.blade.php - paste the block of extra `@case(...)` icons
   (search, map-pin, calendar, store, compass, chevron-down/left/right, sliders, x, rotate-ccw, info)
   immediately before the final `@endswitch`.

## C. NOT touched
login.blade.php, portal.blade.php, controllers, config/, database/, .env, vite.config.js, package.json,
resources/css/app.css, layouts/app.blade.php, footer, weddingsphere.css.

## D. Run

    npm install          # only if node_modules is missing
    npm run dev          # or: npm run build
    php artisan serve    # in a second terminal

Open:
- http://localhost:8000/home      homepage with the search form
- http://localhost:8000/vendors   Explore Vendors

If you use Docker, run the same commands the way you already do for this project.
No `php artisan migrate` is needed.

## E. Quick test
1. /home: pick Photography + Galle + any date, click Find Vendors. The URL becomes
   /vendors?category=photography&location=galle&date=YYYY-MM-DD and 3 vendors show.
2. Remove a chip (x), type a keyword, change Sort by, use Price / Rating filters, click "Reset all".
3. Type "zzzz" in the keyword box to see the empty state.
4. Go to page 5, click View Details on a card, close with Esc.
5. Resize to ~820px and ~390px: the form re-flows, Filters collapses into a button, cards stack.

## Notes
1. The archive's `/` route redirects to /login and welcome.blade.php is Laravel's stock page, so there was
   no homepage to edit. home.blade.php recreates the hero from your screenshot. When your team builds
   the real homepage, keep `<x-vendor-search-form prefix="hero" />` and the two links to route('vendors.explore').
   The header "Home" link still points to url('/') (login redirect) - left alone on purpose.
2. Hero photo is a gradient placeholder. Add public/images/hero-couple.jpg and it appears automatically.
   The "Live Availability Synchronized" badge and RSVP tracker from the screenshot are not reproduced
   (availability is not live here, and RSVP is another module).
3. Vendor photos are placeholders; no "View Profile" page exists, so View Details opens a clearly labelled preview popup.
4. Wedding date is carried in the URL and shown as a chip, but availability is NOT checked.
5. Footer "Vendor Directory" link still points to "#"; point it to route('vendors.explore') if you want.
6. Fonts: layout loads Inter + Playfair Display from Google Fonts, unchanged.
