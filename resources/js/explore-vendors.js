// ---------------------------------------------------------
// Explore Vendors (frontend only)
// Filters, sorts and paginates the sample vendors from ./vendor-data.js in the browser.
// The state lives in the URL (?category=...&location=...&date=...&q=...&price=...&rating=...&sort=...&page=...)
// so the homepage form can pass values over and a result page can be shared / refreshed.
// ---------------------------------------------------------
import { vendors } from './vendor-data.js';

const PAGE_SIZE = 6;

const PRICE_RANGES = {
    'under-100k': [0, 99999],
    '100k-300k': [100000, 300000],
    '300k-750k': [300001, 750000],
    'over-750k': [750001, Infinity],
};

// placeholder picture colours + icon per category (no vendor photos exist yet)
const CATEGORY_STYLE = {
    venues: { bg: 'linear-gradient(160deg,#a9808a 0%,#7d3b50 50%,#5c132e 100%)', icon: '<path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/>' },
    photography: { bg: 'linear-gradient(160deg,#c9a89a 0%,#8a4a5e 100%)', icon: '<path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3z"/><circle cx="12" cy="13" r="3"/>' },
    catering: { bg: 'linear-gradient(160deg,#d9a37f 0%,#8a4a5e 100%)', icon: '<path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>' },
    decoration: { bg: 'linear-gradient(160deg,#e8b4c2 0%,#a35a74 100%)', icon: '<circle cx="12" cy="12" r="3"/><path d="M12 16.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 1 1 4.5 4.5 4.5 4.5 0 1 1-4.5 4.5"/><path d="M12 7.5V9"/><path d="M7.5 12H9"/><path d="M16.5 12H15"/><path d="M12 16.5V15"/><path d="m8 8 1.88 1.88"/><path d="M14.12 9.88 16 8"/><path d="m8 16 1.88-1.88"/><path d="M14.12 14.12 16 16"/>' },
    bridal: { bg: 'linear-gradient(160deg,#c4a1b3 0%,#732f46 100%)', icon: '<path d="M6 3h12l4 6-10 13L2 9Z"/><path d="M11 3 8 9l4 13 4-13-3-6"/><path d="M2 9h20"/>' },
    beauty: { bg: 'linear-gradient(160deg,#e3b99a 0%,#b0647c 100%)', icon: '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>' },
    music: { bg: 'linear-gradient(160deg,#9c7d8a 0%,#4f1f33 100%)', icon: '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>' },
    cakes: { bg: 'linear-gradient(160deg,#f0c9a8 0%,#c57a8c 100%)', icon: '<path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"/><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"/><path d="M2 21h20"/><path d="M7 8v3"/><path d="M12 8v3"/><path d="M17 8v3"/><path d="M7 4h.01"/><path d="M12 4h.01"/><path d="M17 4h.01"/>' },
    transport: { bg: 'linear-gradient(160deg,#b59a98 0%,#5c3b46 100%)', icon: '<path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/>' },
    invitations: { bg: 'linear-gradient(160deg,#d6c0a0 0%,#8a6a4e 100%)', icon: '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>' },
};
const FALLBACK_STYLE = CATEGORY_STYLE.venues;

const root = document.querySelector('[data-explore-vendors]');
if (root) init(root);

function init(root) {
    const $ = (sel) => root.querySelector(sel);
    const $$ = (sel) => [...root.querySelectorAll(sel)];

    const form = $('[data-vendor-search-form]');
    const keywordInput = $('[data-keyword]');
    const sortSelect = $('[data-sort]');
    const grid = $('[data-grid]');
    const emptyBox = $('[data-empty]');
    const countEl = $('[data-count]');
    const chipsEl = $('[data-chips]');
    const pagerEl = $('[data-pagination]');
    const cardTpl = $('#vendor-card-template');
    const dialog = $('[data-dialog]');
    const toast = $('[data-toast]');
    const resultsEl = $('[data-results]');
    const filterToggle = $('[data-filter-toggle]');
    const filterPanel = $('[data-filter-panel]');
    const filterBadge = $('[data-filter-badge]');

    // labels come from the dropdowns, so Blade stays the single place that defines them
    const optionLabels = (select) =>
        Object.fromEntries([...select.options].filter((o) => o.value).map((o) => [o.value, o.textContent.trim()]));
    const categoryLabels = optionLabels(form.elements.category);
    const locationLabels = optionLabels(form.elements.location);

    const SORTS = ['recommended', 'rating', 'reviews', 'price-asc', 'price-desc'];
    const RATINGS = ['3.5', '4', '4.5', '4.8'];

    // ---------- state (read from the URL) ----------
    const state = readStateFromUrl();
    syncControlsFromState();
    render();

    // ---------- events ----------
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        state.category = form.elements.category.value;
        state.location = form.elements.location.value;
        state.date = form.elements.date.value;
        state.page = 1;
        const total = render();
        showToast(total === 0 ? 'No vendors found. Try changing your search.' : `Showing ${total} vendor${total === 1 ? '' : 's'}${describeSearch()}.`);
        resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    let keywordTimer;
    keywordInput.addEventListener('input', () => {
        clearTimeout(keywordTimer);
        keywordTimer = setTimeout(() => {
            state.q = keywordInput.value.trim();
            state.page = 1;
            render();
        }, 150);
    });

    sortSelect.addEventListener('change', () => {
        state.sort = SORTS.includes(sortSelect.value) ? sortSelect.value : 'recommended';
        state.page = 1;
        render();
    });

    $$('input[name="price"]').forEach((r) => r.addEventListener('change', () => { state.price = r.value; state.page = 1; render(); }));
    $$('input[name="rating"]').forEach((r) => r.addEventListener('change', () => { state.rating = r.value; state.page = 1; render(); }));

    $$('[data-reset]').forEach((btn) => btn.addEventListener('click', () => {
        resetState();
        syncControlsFromState();
        render();
        showToast('Filters cleared. Showing all vendors.');
    }));

    filterToggle.addEventListener('click', () => {
        const open = filterPanel.classList.toggle('hidden') === false;
        filterToggle.setAttribute('aria-expanded', String(open));
    });

    // details popup
    grid.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-f="details"]');
        if (btn) openDialog(Number(btn.closest('[data-vendor-id]').dataset.vendorId));
    });
    $$('[data-dialog-close]').forEach((b) => b.addEventListener('click', () => dialog.close()));
    dialog.addEventListener('click', (e) => { if (e.target === dialog) dialog.close(); });

    // ---------- state helpers ----------
    function readStateFromUrl() {
        const p = new URLSearchParams(window.location.search);
        const pick = (key, allowed) => (allowed.includes(p.get(key)) ? p.get(key) : '');
        const date = /^\d{4}-\d{2}-\d{2}$/.test(p.get('date') || '') ? p.get('date') : '';
        const page = parseInt(p.get('page'), 10);
        return {
            category: pick('category', Object.keys(categoryLabels)),
            location: pick('location', Object.keys(locationLabels)),
            date,
            q: (p.get('q') || '').trim().slice(0, 80),
            price: pick('price', Object.keys(PRICE_RANGES)),
            rating: pick('rating', RATINGS),
            sort: pick('sort', SORTS) || 'recommended',
            page: page > 0 ? page : 1,
        };
    }

    function resetState() {
        Object.assign(state, { category: '', location: '', date: '', q: '', price: '', rating: '', sort: 'recommended', page: 1 });
    }

    function syncControlsFromState() {
        form.elements.category.value = state.category;
        form.elements.location.value = state.location;
        form.elements.date.value = state.date;
        keywordInput.value = state.q;
        sortSelect.value = state.sort;
        $$('input[name="price"]').forEach((r) => (r.checked = r.value === state.price));
        $$('input[name="rating"]').forEach((r) => (r.checked = r.value === state.rating));
    }

    function writeUrl() {
        const p = new URLSearchParams();
        ['category', 'location', 'date', 'q', 'price', 'rating'].forEach((k) => state[k] && p.set(k, state[k]));
        if (state.sort !== 'recommended') p.set('sort', state.sort);
        if (state.page > 1) p.set('page', String(state.page));
        const qs = p.toString();
        history.replaceState(null, '', window.location.pathname + (qs ? `?${qs}` : ''));
    }

    // ---------- filtering + sorting ----------
    function matches(v) {
        if (state.category && v.category !== state.category) return false;
        if (state.location && v.location !== state.location && !v.islandWide) return false;
        if (state.rating && v.rating < parseFloat(state.rating)) return false;
        if (state.price) {
            const [min, max] = PRICE_RANGES[state.price];
            if (v.price < min || v.price > max) return false;
        }
        if (state.q) {
            const haystack = [v.name, v.description, categoryLabels[v.category], locationLabels[v.location], ...v.highlights].join(' ').toLowerCase();
            if (!state.q.toLowerCase().split(/\s+/).every((word) => haystack.includes(word))) return false;
        }
        return true;
    }

    function sorted(list) {
        const copy = [...list];
        const by = {
            recommended: () => 0,
            rating: (a, b) => b.rating - a.rating || b.reviews - a.reviews,
            reviews: (a, b) => b.reviews - a.reviews,
            'price-asc': (a, b) => a.price - b.price,
            'price-desc': (a, b) => b.price - a.price,
        }[state.sort];
        // Array.prototype.sort is stable, so equal items keep the "recommended" order
        return copy.sort(by);
    }

    // ---------- rendering ----------
    function render() {
        const results = sorted(vendors.filter(matches));
        const total = results.length;
        const pages = Math.max(1, Math.ceil(total / PAGE_SIZE));
        state.page = Math.min(Math.max(1, state.page), pages);
        const start = (state.page - 1) * PAGE_SIZE;
        const pageItems = results.slice(start, start + PAGE_SIZE);

        grid.replaceChildren(...pageItems.map(buildCard));
        grid.hidden = total === 0;
        emptyBox.hidden = total !== 0;

        countEl.textContent = total === 0
            ? '0 vendors found'
            : `Showing ${start + 1}\u2013${start + pageItems.length} of ${total} vendor${total === 1 ? '' : 's'}`;

        renderChips();
        renderPagination(pages);

        const sidebarFilters = [state.price, state.rating].filter(Boolean).length;
        filterBadge.textContent = String(sidebarFilters);
        filterBadge.classList.toggle('hidden', sidebarFilters === 0);

        writeUrl();
        return total;
    }

    function buildCard(v) {
        const node = cardTpl.content.firstElementChild.cloneNode(true);
        const set = (name, text) => (node.querySelector(`[data-f="${name}"]`).textContent = text);
        const style = CATEGORY_STYLE[v.category] || FALLBACK_STYLE;

        node.dataset.vendorId = v.id;
        const img = node.querySelector('[data-f="image"]');
        img.style.background = style.bg;
        img.setAttribute('aria-label', `Photo placeholder for ${v.name}`);
        node.querySelector('[data-f="icon"]').innerHTML = style.icon;
        set('category', categoryLabels[v.category] || v.category);
        set('name', v.name);
        set('location', locationLabels[v.location] || v.location);
        node.querySelector('[data-f="travel"]').hidden = !v.islandWide;
        set('rating', v.rating.toFixed(1));
        set('reviews', `(${v.reviews} reviews)`);
        set('description', v.description);
        set('price', formatPrice(v.price));
        set('priceNote', v.priceNote);
        node.querySelector('[data-f="details"]').setAttribute('aria-label', `View details for ${v.name}`);
        return node;
    }

    function renderChips() {
        const chips = [];
        if (state.category) chips.push(['category', categoryLabels[state.category]]);
        if (state.location) chips.push(['location', locationLabels[state.location]]);
        if (state.date) chips.push(['date', `Wedding date: ${formatDate(state.date)}`]);
        if (state.q) chips.push(['q', `\u201C${state.q}\u201D`]);
        if (state.price) chips.push(['price', priceLabel(state.price)]);
        if (state.rating) chips.push(['rating', `${state.rating}+ rating`]);

        chipsEl.replaceChildren(...chips.map(([key, label]) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'inline-flex items-center gap-1.5 rounded-full bg-chip px-2.5 py-1 text-[11px] font-medium text-wine-dark transition hover:bg-[#efe1de] focus-visible:ring-[3px] focus-visible:ring-wine/30 focus-visible:outline-none';
            b.setAttribute('aria-label', `Remove filter: ${label}`);
            b.innerHTML = `<span></span><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>`;
            b.firstElementChild.textContent = label;
            b.addEventListener('click', () => {
                state[key] = '';
                state.page = 1;
                syncControlsFromState();
                render();
            });
            return b;
        }));
    }

    function renderPagination(pages) {
        pagerEl.replaceChildren();
        pagerEl.hidden = pages <= 1;
        if (pages <= 1) return;

        const base = 'inline-flex size-9 items-center justify-center rounded-lg text-[12px] font-semibold transition focus-visible:ring-[3px] focus-visible:ring-wine/30 focus-visible:outline-none';
        const idle = 'bg-white text-[#4a3a3f] shadow-[0_4px_12px_rgba(92,19,46,.07)] hover:bg-chip hover:text-wine';
        const active = 'bg-wine text-white shadow-md shadow-wine/25';
        const arrow = (d) => `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="${d}"/></svg>`;

        const add = (html, label, page, { current = false, disabled = false } = {}) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.innerHTML = html;
            b.setAttribute('aria-label', label);
            b.className = `${base} ${current ? active : idle} ${disabled ? 'pointer-events-none opacity-40' : ''}`;
            if (current) b.setAttribute('aria-current', 'page');
            if (disabled) b.disabled = true;
            b.addEventListener('click', () => goToPage(page));
            pagerEl.append(b);
        };

        add(arrow('m15 18-6-6 6-6'), 'Previous page', state.page - 1, { disabled: state.page === 1 });

        // show every page when there are few; otherwise first, last and the pages around the current one
        const shown = pages <= 7
            ? new Set(Array.from({ length: pages }, (_, i) => i + 1))
            : new Set([1, pages, state.page - 1, state.page, state.page + 1]);
        let last = 0;
        for (let n = 1; n <= pages; n++) {
            if (!shown.has(n)) continue;
            if (n - last > 1) {
                const gap = document.createElement('span');
                gap.textContent = '\u2026';
                gap.className = 'px-1 text-muted';
                pagerEl.append(gap);
            }
            add(String(n), `Page ${n}`, n, { current: n === state.page });
            last = n;
        }

        add(arrow('m9 18 6-6-6-6'), 'Next page', state.page + 1, { disabled: state.page === pages });
    }

    function goToPage(page) {
        state.page = page;
        render();
        resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ---------- details popup ----------
    function openDialog(id) {
        const v = vendors.find((x) => x.id === id);
        if (!v) return;
        const style = CATEGORY_STYLE[v.category] || FALLBACK_STYLE;
        const set = (name, text) => (dialog.querySelector(`[data-d="${name}"]`).textContent = text);

        dialog.querySelector('[data-d="image"]').style.background = style.bg;
        dialog.querySelector('[data-d="icon"]').innerHTML = style.icon;
        set('category', categoryLabels[v.category] || v.category);
        set('name', v.name);
        set('location', (locationLabels[v.location] || v.location) + (v.islandWide ? ' \u00B7 travels island-wide' : ''));
        set('rating', v.rating.toFixed(1));
        set('reviews', `(${v.reviews} reviews)`);
        set('description', v.description);
        set('price', formatPrice(v.price));
        set('priceNote', v.priceNote);
        dialog.querySelector('[data-d="highlights"]').replaceChildren(...v.highlights.map((h) => {
            const li = document.createElement('li');
            li.className = 'rounded-full bg-success-bg px-2.5 py-1 text-[10.5px] font-semibold text-success-ink';
            li.textContent = h;
            return li;
        }));
        dialog.showModal();
    }

    // ---------- small utilities ----------
    function describeSearch() {
        const parts = [];
        if (state.category) parts.push(`for ${categoryLabels[state.category]}`);
        if (state.location) parts.push(`in ${locationLabels[state.location]}`);
        return parts.length ? ` ${parts.join(' ')}` : '';
    }

    let toastTimer;
    function showToast(message) {
        toast.textContent = message;
        toast.setAttribute('data-show', '');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toast.removeAttribute('data-show'), 3200);
    }

    function formatPrice(n) {
        return `LKR ${n.toLocaleString('en-US')}`;
    }

    function priceLabel(key) {
        return { 'under-100k': 'Under LKR 100,000', '100k-300k': 'LKR 100,000\u2013300,000', '300k-750k': 'LKR 300,000\u2013750,000', 'over-750k': 'Over LKR 750,000' }[key];
    }

    function formatDate(iso) {
        const [y, m, d] = iso.split('-').map(Number);
        return new Date(y, m - 1, d).toLocaleDateString('en-GB', { weekday: 'short', day: 'numeric', month: 'long', year: 'numeric' });
    }
}
