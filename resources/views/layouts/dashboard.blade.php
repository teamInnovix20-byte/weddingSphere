<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Guest List & RSVP Command Center — WeddingSphere')</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">

    {{-- Tailwind CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Collapsible Sidebar Styles & Transitions */
        #dashboard-sidebar {
            width: 16rem; /* 256px */
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #main-content-wrapper {
            padding-left: 0;
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @media (min-width: 1024px) {
            #main-content-wrapper {
                padding-left: 16rem;
            }
            body.sidebar-collapsed #dashboard-sidebar {
                width: 5rem; /* 80px */
            }
            body.sidebar-collapsed #main-content-wrapper {
                padding-left: 5rem; /* 80px */
            }
            body.sidebar-collapsed .sidebar-expanded-only {
                display: none !important;
            }
            body.sidebar-collapsed .sidebar-collapsed-only {
                display: flex !important;
            }
            body.sidebar-collapsed .sidebar-expanded-text {
                display: none !important;
            }
            body.sidebar-collapsed .sidebar-nav-link {
                justify-content: center !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                position: relative;
            }
            body.sidebar-collapsed .sidebar-nav-link:hover .sidebar-tooltip,
            body.sidebar-collapsed .sidebar-collapsed-only:hover .sidebar-tooltip {
                display: flex !important;
                opacity: 1 !important;
                transform: translateY(-50%) translateX(0) !important;
            }
        }

        /* Tooltip styling */
        .sidebar-tooltip {
            display: none;
            position: absolute;
            left: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%) translateX(-6px);
            background: #2a1a1f;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 500;
            white-space: nowrap;
            z-index: 70;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
            opacity: 0;
            transition: opacity 0.15s ease, transform 0.15s ease;
            pointer-events: none;
        }
        .sidebar-tooltip::before {
            content: '';
            position: absolute;
            left: -4px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 4px 4px 4px 0;
            border-style: solid;
            border-color: transparent #2a1a1f transparent transparent;
        }

        /* Smooth scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e6d3cf;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #d4bcba;
        }

        /* Toast animation */
        @keyframes toastIn {
            from { transform: translateY(100%) scale(0.9); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }
        .animate-toast {
            animation: toastIn 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
    @stack('styles')
</head>

<body class="min-h-screen bg-[#fff9f8] text-ink font-sans antialiased">
    {{-- Sidebar --}}
    @include('partials.userdashboardnav')

    {{-- Main Wrapper with dynamic offset for the sidebar on desktop --}}
    <div id="main-content-wrapper" class="flex flex-col min-h-screen">

        {{-- Top Navigation Bar --}}
        <header class="sticky top-0 z-30 flex h-14 items-center justify-between border-b border-line/60 bg-[#fff9f8]/90 px-4 md:px-8 backdrop-blur-md">
            {{-- Left: Mobile Hamburger & Desktop Toggle & Event Destination Tag --}}
            <div class="flex items-center gap-3">
                {{-- Mobile Hamburger --}}
                <button type="button" data-sidebar-open class="rounded-lg p-1.5 text-muted hover:bg-chip lg:hidden cursor-pointer" aria-label="Open sidebar">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Desktop Sidebar Toggle Button in Header --}}
                <button type="button"
                        id="topbar-sidebar-toggle"
                        class="hidden lg:flex items-center justify-center size-8 rounded-lg text-muted hover:text-wine hover:bg-chip transition cursor-pointer"
                        title="Toggle Sidebar (Ctrl+B)">
                    <svg class="size-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16" />
                    </svg>
                </button>

                {{-- Event Pill from Figma --}}
                <div class="hidden sm:flex items-center gap-2.5 rounded-full border border-line bg-white/70 px-3 py-1 shadow-2xs hover:border-wine/30 transition">
                    <span class="flex size-5 items-center justify-center rounded-full bg-[#fae8e6] text-wine">
                        <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </span>
                    <div class="text-[11px] leading-tight">
                        <span class="font-semibold text-ink">Dec 18, 2025</span>
                        <span class="text-muted">• Nuwara Eliya</span>
                        <span class="hidden md:inline text-muted-2 text-[10px]"> — The Grand Heritage Pavilion</span>
                    </div>
                </div>
            </div>

            {{-- Right: Notifications & Quick Help --}}
            <div class="flex items-center gap-3 md:gap-4">
                {{-- Quick Link / Help Button --}}
                <a href="#" class="hidden md:inline-flex items-center gap-1.5 text-[11.5px] font-medium text-muted hover:text-wine px-2 py-1 rounded-md hover:bg-chip transition">
                    <svg class="size-3.5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke-width="2" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3m.08 4h.01" />
                    </svg>
                    Help & Guides
                </a>

                {{-- Notification Bell with Badge --}}
                <button type="button" class="relative rounded-full p-2 text-muted hover:bg-chip hover:text-wine transition cursor-pointer" aria-label="Notifications" title="2 New RSVP Notifications">
                    <svg class="size-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 size-2 rounded-full bg-[#c43d4b] ring-2 ring-white animate-pulse"></span>
                </button>
            </div>
        </header>

        {{-- Main View Body --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    {{-- Interactive Floating Toast Container --}}
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2.5 pointer-events-none"></div>

    {{-- Global Script for Collapsible Sidebar and Toasts --}}
    <script>
        // Check and restore persisted sidebar state
        const savedSidebarState = localStorage.getItem('weddingsphere_sidebar_collapsed');
        if (savedSidebarState === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }

        // Toggle function
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-collapsed');
            const isCollapsed = document.body.classList.contains('sidebar-collapsed');
            localStorage.setItem('weddingsphere_sidebar_collapsed', isCollapsed ? 'true' : 'false');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const topbarSidebarToggle = document.getElementById('topbar-sidebar-toggle');

            if (topbarSidebarToggle) {
                topbarSidebarToggle.addEventListener('click', toggleSidebar);
            }

            // Keyboard shortcut: Ctrl+B or Cmd+B to toggle sidebar
            document.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'b') {
                    e.preventDefault();
                    toggleSidebar();
                }
            });

            // Mobile sidebar drawer
            const sidebar = document.getElementById('dashboard-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const openBtns = document.querySelectorAll('[data-sidebar-open]');
            const closeBtns = document.querySelectorAll('[data-sidebar-close]');

            const openMobile = () => {
                sidebar?.classList.remove('-translate-x-full');
                backdrop?.classList.remove('hidden');
            };
            const closeMobile = () => {
                sidebar?.classList.add('-translate-x-full');
                backdrop?.classList.add('hidden');
            };

            openBtns.forEach(b => b.addEventListener('click', openMobile));
            closeBtns.forEach(b => b.addEventListener('click', closeMobile));
            backdrop?.addEventListener('click', closeMobile);
        });

        // Global Toast Notification Helper
        window.showToast = function(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `animate-toast pointer-events-auto flex items-center gap-2.5 rounded-lg border px-4 py-2.5 text-[12px] font-medium shadow-lg transition-all ${
                type === 'success' 
                    ? 'border-[#c7e2cc] bg-[#f2f9f3] text-[#236336]' 
                    : type === 'warning'
                    ? 'border-[#fcd9bd] bg-[#fdf5ed] text-[#8c4b12]'
                    : 'border-line bg-white text-ink'
            }`;

            const iconSvg = type === 'success'
                ? `<svg class="size-4 shrink-0 text-[#2f7544]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`
                : `<svg class="size-4 shrink-0 text-wine" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`;

            toast.innerHTML = `${iconSvg}<span>${message}</span>`;
            container.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(10px) scale(0.95)';
                setTimeout(() => toast.remove(), 250);
            }, 3200);
        };
    </script>

    @stack('scripts')
</body>
</html>
