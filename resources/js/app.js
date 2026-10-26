// ---------------------------------------------------------
// Responsive header: hamburger button opens / closes the mobile menu
// ---------------------------------------------------------
const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-mobile-menu]');

if (toggle && menu) {
    const setOpen = (open) => {
        menu.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.querySelector('[data-icon-open]')?.classList.toggle('hidden', open);
        toggle.querySelector('[data-icon-close]')?.classList.toggle('hidden', !open);
    };

    toggle.addEventListener('click', () => setOpen(menu.classList.contains('hidden')));

    // close with Esc, after tapping a link, or when the screen grows to desktop size
    document.addEventListener('keydown', (e) => e.key === 'Escape' && setOpen(false));
    menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => setOpen(false)));
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => e.matches && setOpen(false));
}
