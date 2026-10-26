{{--
    Page frame for the Profile & Identity screen (matches the prototype):
    [ left sidebar with logo ] + [ top bar + page content ]

    It uses its OWN plain stylesheet (public/css/profile-page.css), so it works
    without Tailwind and without running "npm run build".
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'WeddingSphere')</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/profile-page.css') }}">
</head>
<body class="pp-body">
<div class="pp-shell">

    @include('partials.profile-sidebar')

    <div class="pp-main">
        {{-- ============ top bar ============ --}}
        @php
            $user = auth()->user();
            $photo = $user?->profile_photo_url;
        @endphp
        <div class="pp-top">
            <label class="pp-search">
                <x-pf-icon name="search" :size="14" />
                <input type="search" placeholder="Search settings, contracts, escrow IDs..." aria-label="Search">
            </label>

            <div class="pp-top-right">
                <span class="pp-solvency"><x-pf-icon name="shield-check" :size="13" /> Escrow Solvency 100%</span>
                <span class="pp-tz"><x-pf-icon name="clock" :size="14" /> Colombo UTC+05:30</span>
                <button type="button" class="pp-bell" aria-label="Notifications">
                    <x-pf-icon name="bell" :size="17" /><i></i>
                </button>
                <div class="pp-who">
                    <div class="pp-who-text">Tash &amp; Shenal<br>Verified Couple</div>
                    <span class="pp-who-avatar">
                        @if ($photo)
                            <img src="{{ $photo }}" alt="Profile photo">
                        @else
                            <x-pf-icon name="user" :size="16" />
                        @endif
                    </span>
                </div>
            </div>
        </div>

        @yield('account')
    </div>
</div>

{{-- small message that pops up at the bottom (used by the "demo only" buttons) --}}
<div id="ws-toast" role="status" aria-live="polite"></div>

<script>
    // Toast message for buttons that do not have a backend yet
    (function () {
        var toast = document.getElementById('ws-toast');
        var timer;

        window.wsToast = function (message) {
            toast.textContent = message;
            toast.classList.add('is-on');
            clearTimeout(timer);
            timer = setTimeout(function () { toast.classList.remove('is-on'); }, 2800);
        };

        document.querySelectorAll('[data-toast]').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                window.wsToast(el.dataset.toast);
            });
        });
    })();
</script>
@stack('scripts')
</body>
</html>
