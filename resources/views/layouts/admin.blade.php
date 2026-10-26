<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Console - WeddingSphere')</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    {{-- same fonts as layouts/app.blade.php (Inter + Playfair Display) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-[#f8f6f2] font-sans text-[13px] text-ink antialiased">

    {{-- dark overlay behind the sidebar on tablet / phone --}}
    <div id="adminOverlay" class="fixed inset-0 z-40 hidden bg-ink/40 backdrop-blur-[2px] lg:hidden"></div>

    @include('partials.admin-sidebar')

    <div class="min-h-screen lg:pl-[232px]">
        @include('partials.admin-topbar')

        <main class="px-4 pb-10 pt-5 sm:px-6">
            @yield('content')
        </main>
    </div>

    <script>
        // Sidebar drawer (below lg) + Ctrl/Cmd+K focuses the top search box
        (function () {
            var sidebar = document.getElementById('adminSidebar');
            var overlay = document.getElementById('adminOverlay');
            var openBtn = document.querySelector('[data-admin-menu-open]');
            var closeBtn = document.querySelector('[data-admin-menu-close]');
            if (!sidebar) return;

            function setOpen(open) {
                sidebar.classList.toggle('-translate-x-full', !open);
                overlay.classList.toggle('hidden', !open);
                if (openBtn) openBtn.setAttribute('aria-expanded', String(open));
                document.body.classList.toggle('overflow-hidden', open);
            }
            if (openBtn) openBtn.addEventListener('click', function () { setOpen(true); });
            if (closeBtn) closeBtn.addEventListener('click', function () { setOpen(false); });
            overlay.addEventListener('click', function () { setOpen(false); });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') setOpen(false);
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    var s = document.getElementById('globalSearch');
                    if (s && s.offsetParent !== null) { e.preventDefault(); s.focus(); }
                }
            });
            window.matchMedia('(min-width: 1024px)').addEventListener('change', function (e) { if (e.matches) setOpen(false); });
        })();
    </script>
    @stack('scripts')
</body>
</html>
