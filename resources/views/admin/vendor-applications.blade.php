@extends('layouts.admin')

@section('title', 'Vendor Applications - WeddingSphere Admin')

@section('content')

{{-- ============================================================
     FRONTEND-ONLY PAGE: every record below is hard-coded sample
     data. No controller, model, API or database is used.
     ============================================================ --}}
@php
    // ---- colour / style maps -------------------------------------------------
    $slaStyles = [
        'ok'      => ['bg-[#e4efe6] text-[#3b7a52]', null, 'bg-[#3b7a52]'],
        'urgent'  => ['bg-[#fddcdc] text-[#b3303f]', 'alarm-clock', null],
        'breach'  => ['bg-[#c43d4b] text-white',      'history',     null],
        'paused'  => ['bg-[#efe9e4] text-muted',      null, 'bg-[#8d7f83]'],
        'elevate' => ['bg-[#fdf0d6] text-[#b0701a]',  null, 'bg-[#e0a030]'],
    ];
    $kycStyles = [
        'ready'    => ['bg-gold-bg text-gold-ink',     'clipboard-check'],
        'flag'     => ['bg-[#fddcdc] text-[#b3303f]',  'triangle-alert'],
        'heritage' => ['bg-[#745a27] text-white',      'award'],
        'signoff'  => ['bg-wine text-white',           'pen'],
    ];
    $assetText = ['ok' => 'text-[#2f7a4b]', 'bad' => 'text-[#c43d4b]', 'gold' => 'text-[#7a5a14]'];
    $flagStyles = ['red' => 'bg-[#fddcdc] text-[#b3303f]', 'gold' => 'bg-gold-bg text-gold-ink'];

    // ---- tabs ------------------------------------------------------------------
    $tabs = [
        ['pending',  'Pending Review',               14],
        ['audit',    'Under KYC Document Audit',      8],
        ['approved', 'Approved & Awaiting Activation', 26],
        ['rejected', 'Rejected / Incomplete',        12],
        ['all',      'All Applications',             60],
    ];

    // ---- filter options --------------------------------------------------------
    $categories = ['Decor & Floral', 'Photography & Cinematography', 'Poruwa & Heritage Rites', 'Venues & Ballrooms',
                   'Bridal Wear & Couture', 'Catering & Patisserie', 'Music & Entertainment', 'Transport & Logistics'];
    $districts  = ['Colombo', 'Galle', 'Kandy', 'Matara', 'Negombo', 'Nuwara Eliya', 'Jaffna', 'Kurunegala', 'Ratnapura'];

    // ---- sample applications (14 pending) ---------------------------------------
    // left = hours of SLA left, age = hours since submission (used by the sort box)
    $apps = [
        ['n' => 'Araliya Nuptial Mandaps & Floral Artistry', 'mark' => 'verified', 'flag' => null,
         'who' => 'Lead Artisan: Chaminda Wickramasinghe', 'code' => 'PV-99482', 'note' => 'Tax ID: WCK-8812',
         'img' => 'images/vendors/araliya.jpg', 'tint' => 'from-[#ecd2ad] to-[#b98a5c]',
         'cat' => 'Floral Architecture & Mandap Design', 'reg' => 'Galle & Bentota Coastal', 'tier' => 'Destination Nuptials Tier',
         'ctg' => 'Decor & Floral', 'dist' => 'Galle',
         'date' => 'Today, 08:30 AM', 'ago' => '3h ago', 'sla' => ['ok', '21h SLA Remaining'],
         'as' => ['ok', '4/4 Validated', 'High-res Mandap Portfolio attached', ['file-text', 'id-card', 'images', 'shield']],
         'kyc' => ['ready', 'Ready for Review', 'Identity & BR Passed'], 'resub' => false, 'left' => 21, 'age' => 3],

        ['n' => 'SkyView Ceylon Cinematography', 'mark' => null, 'flag' => ['Drone Flag', 'red'],
         'who' => 'Operator: Dinesh Wickramasinghe', 'code' => 'PV-103941', 'note' => 'CAA Permit: #CAA-DR-2024',
         'img' => 'images/vendors/skyview.jpg', 'tint' => 'from-[#f2d9b8] to-[#9d6b4a]',
         'cat' => 'Nuptial Cinematography & Drone', 'reg' => 'Colombo & Islandwide', 'tier' => '4K Aerial Specialized',
         'ctg' => 'Photography & Cinematography', 'dist' => 'Colombo',
         'date' => 'Yesterday, 04:15 PM', 'ago' => '19h ago', 'sla' => ['urgent', '4h 45m Remaining (URGENT)'],
         'as' => ['bad', '3/4 Docs (Missing Doc)', 'Police Clearance missing', ['file-text', 'plane', 'video', 'at-sign']],
         'kyc' => ['flag', 'Exception Flagged', 'Audit Failed: Drone Safety'], 'resub' => true, 'left' => 4.75, 'age' => 19],

        ['n' => 'Heritage Poruwa Gurunnanse Ensemble', 'mark' => null, 'flag' => ['Heritage', 'gold'],
         'who' => 'Master: K. M. Somapala Gurunnanse', 'code' => 'ASTRO-KND-004', 'note' => 'Lineage Registry: 4th Generation',
         'img' => 'images/vendors/heritage.jpg', 'tint' => 'from-[#d9b58f] to-[#7d4b3a]',
         'cat' => 'Traditional Poruwa Rites & Nekath', 'reg' => 'Kandy & Nuwara Eliya', 'tier' => 'Custom Ashtaka & Jayamangala',
         'ctg' => 'Poruwa & Heritage Rites', 'dist' => 'Kandy',
         'date' => 'Yesterday, 11:00 AM', 'ago' => '24h ago', 'sla' => ['breach', 'SLA Breached (High Season Rush)'],
         'as' => ['gold', '4/4 Verified Proofs', '42 Verified Clan Endorsements', ['sparkles', 'trophy', 'id-card', 'star']],
         'kyc' => ['heritage', 'Priority Heritage Audit', 'Elder Council Endorsed'], 'resub' => false, 'left' => 0, 'age' => 24],

        ['n' => 'The Grand Cinnamon Ballroom & Gardens', 'mark' => 'star', 'flag' => null,
         'who' => 'Concierge: Priyantha Silva', 'code' => 'SLTDA/EST/0091', 'note' => 'Capacity: 750 Guests',
         'img' => 'images/vendors/cinnamon.jpg', 'tint' => 'from-[#f1ece6] to-[#cdbfb2]',
         'cat' => 'Heritage Estates & 5-Star Venues', 'reg' => 'Colombo 03 (Oceanfront)', 'tier' => 'Ballroom + Lush Lawn',
         'ctg' => 'Venues & Ballrooms', 'dist' => 'Colombo',
         'date' => 'Oct 15, 2025', 'ago' => '2 days ago', 'sla' => ['paused', 'SLA Paused (Audit Complete)'],
         'as' => ['ok', '5/5 Complete Dossier', 'Escrow Account Wired & Linked', ['building', 'shield', 'utensils', 'sparkles', 'shield-check']],
         'kyc' => ['signoff', 'SuperAdmin Sign-Off', 'Legal Review Completed'], 'resub' => false, 'left' => 999, 'age' => 48],

        ['n' => 'Lashmi Kandyan Osariya & Bridal Haute Couture', 'mark' => null, 'flag' => null,
         'who' => 'Designer: Sandamali Perera', 'code' => 'PV-44910', 'note' => 'VAT Registered',
         'img' => 'images/vendors/lashmi.jpg', 'tint' => 'from-[#e8b9a0] to-[#a3503f]',
         'cat' => 'Kandyan & Western Bridalwear', 'reg' => 'Kandy City Center', 'tier' => 'Custom Filigree & Zardozi',
         'ctg' => 'Bridal Wear & Couture', 'dist' => 'Kandy',
         'date' => 'Oct 14, 2025', 'ago' => '3 days ago', 'sla' => ['elevate', 'Queue Priority Elevating'],
         'as' => ['ok', '4/4 Docs Validated', 'Boutique Physical Verification Done', ['file-text', 'book-open', 'store', 'id-card']],
         'kyc' => ['ready', 'Ready for Review', 'Dossier Complete'], 'resub' => false, 'left' => 36, 'age' => 72],

        ['n' => 'Seranadi Bridal Makeup Studio', 'mark' => null, 'flag' => null,
         'who' => 'Lead Artist: Nadeesha Fernando', 'code' => 'PV-98211', 'note' => 'VAT Registered',
         'img' => 'images/vendors/seranadi.jpg', 'tint' => 'from-[#f0cfc6] to-[#b0706a]',
         'cat' => 'Bridal Makeup & Hair Styling', 'reg' => 'Colombo 07', 'tier' => 'Signature Bridal Tier',
         'ctg' => 'Bridal Wear & Couture', 'dist' => 'Colombo',
         'date' => 'Today, 07:10 AM', 'ago' => '4h ago', 'sla' => ['ok', '19h SLA Remaining'],
         'as' => ['ok', '4/4 Validated', 'Portfolio & product licences attached', ['file-text', 'id-card', 'images', 'shield']],
         'kyc' => ['ready', 'Ready for Review', 'Identity & BR Passed'], 'resub' => false, 'left' => 19, 'age' => 4],

        ['n' => 'Ruhunu Royal Catering Co.', 'mark' => null, 'flag' => null,
         'who' => 'Executive Chef: Asanka Ranatunga', 'code' => 'PV-97740', 'note' => 'Food Safety: FS-2291',
         'img' => 'images/vendors/ruhunu.jpg', 'tint' => 'from-[#e9d3a8] to-[#9a7a3c]',
         'cat' => 'Banquet Catering & Live Stations', 'reg' => 'Matara & Weligama', 'tier' => 'Southern Coast Tier',
         'ctg' => 'Catering & Patisserie', 'dist' => 'Matara',
         'date' => 'Yesterday, 02:40 PM', 'ago' => '21h ago', 'sla' => ['urgent', '7h 20m Remaining (URGENT)'],
         'as' => ['bad', '3/4 Docs (Missing Doc)', 'Public health licence expired', ['file-text', 'shield', 'utensils', 'at-sign']],
         'kyc' => ['flag', 'Exception Flagged', 'Audit Failed: Food Safety'], 'resub' => true, 'left' => 7.3, 'age' => 21],

        ['n' => 'Nilwala Wedding Cakes & Patisserie', 'mark' => null, 'flag' => null,
         'who' => 'Pastry Chef: Ishani Gunasekara', 'code' => 'PV-97102', 'note' => 'Tax ID: NWC-4410',
         'img' => 'images/vendors/nilwala.jpg', 'tint' => 'from-[#f6e3d0] to-[#c99a78]',
         'cat' => 'Tiered Cakes & Patisserie', 'reg' => 'Matara City', 'tier' => 'Boutique Tier',
         'ctg' => 'Catering & Patisserie', 'dist' => 'Matara',
         'date' => 'Oct 16, 2025', 'ago' => '1 day ago', 'sla' => ['elevate', 'Queue Priority Elevating'],
         'as' => ['ok', '4/4 Docs Validated', 'Tasting menu & hygiene audit done', ['file-text', 'cake', 'shield', 'images']],
         'kyc' => ['ready', 'Ready for Review', 'Dossier Complete'], 'resub' => false, 'left' => 30, 'age' => 30],

        ['n' => 'Kandyan Dance Troupe Heritage Arts', 'mark' => null, 'flag' => ['Heritage', 'gold'],
         'who' => 'Master: Ranjith Bandara', 'code' => 'ASTRO-KND-011', 'note' => 'Lineage Registry: 6th Generation',
         'img' => 'images/vendors/troupe.jpg', 'tint' => 'from-[#d8b98c] to-[#6f4a2f]',
         'cat' => 'Traditional Dance & Ceremonial Drummers', 'reg' => 'Kandy & Matale', 'tier' => 'Poruwa Rites Tier',
         'ctg' => 'Music & Entertainment', 'dist' => 'Kandy',
         'date' => 'Yesterday, 09:15 AM', 'ago' => '26h ago', 'sla' => ['breach', 'SLA Breached (High Season Rush)'],
         'as' => ['gold', '4/4 Verified Proofs', '38 Verified Clan Endorsements', ['sparkles', 'trophy', 'id-card', 'star']],
         'kyc' => ['heritage', 'Priority Heritage Audit', 'Elder Council Endorsed'], 'resub' => false, 'left' => 0, 'age' => 26],

        ['n' => 'Negombo Lagoon Pavilion & Gardens', 'mark' => 'star', 'flag' => null,
         'who' => 'Concierge: Dilshan Perera', 'code' => 'SLTDA/EST/0112', 'note' => 'Capacity: 400 Guests',
         'img' => 'images/vendors/lagoon.jpg', 'tint' => 'from-[#d3e4de] to-[#7fa59a]',
         'cat' => 'Lagoon Venues & Beach Pavilions', 'reg' => 'Negombo (Lagoon Front)', 'tier' => 'Pavilion + Garden Lawn',
         'ctg' => 'Venues & Ballrooms', 'dist' => 'Negombo',
         'date' => 'Oct 15, 2025', 'ago' => '2 days ago', 'sla' => ['paused', 'SLA Paused (Audit Complete)'],
         'as' => ['ok', '5/5 Complete Dossier', 'Escrow Account Wired & Linked', ['building', 'shield', 'utensils', 'sparkles', 'shield-check']],
         'kyc' => ['signoff', 'SuperAdmin Sign-Off', 'Legal Review Completed'], 'resub' => false, 'left' => 999, 'age' => 49],

        ['n' => 'Hill Country Lens & Film Studio', 'mark' => null, 'flag' => ['Drone Flag', 'red'],
         'who' => 'Operator: Tharindu Jayasuriya', 'code' => 'PV-96655', 'note' => 'CAA Permit: #CAA-DR-2031',
         'img' => 'images/vendors/hillcountry.jpg', 'tint' => 'from-[#cfdccf] to-[#6f8a73]',
         'cat' => 'Wedding Photography & Drone Cinematography', 'reg' => 'Nuwara Eliya & Hatton', 'tier' => 'Highland Tier',
         'ctg' => 'Photography & Cinematography', 'dist' => 'Nuwara Eliya',
         'date' => 'Oct 15, 2025', 'ago' => '2 days ago', 'sla' => ['elevate', 'Queue Priority Elevating'],
         'as' => ['ok', '4/4 Docs Validated', 'Pilot licence & indemnity attached', ['file-text', 'plane', 'video', 'shield']],
         'kyc' => ['ready', 'Ready for Review', 'Pilot Licence Verified'], 'resub' => false, 'left' => 40, 'age' => 50],

        ['n' => 'Jaffna Palmyra Artisan Decor', 'mark' => null, 'flag' => null,
         'who' => 'Lead Artisan: Kavitha Sivarajah', 'code' => 'PV-95870', 'note' => 'Tax ID: JPA-3302',
         'img' => 'images/vendors/palmyra.jpg', 'tint' => 'from-[#ead7b5] to-[#a5845a]',
         'cat' => 'Kolam Art, Palmyra Crafts & Stage Decor', 'reg' => 'Jaffna Peninsula', 'tier' => 'Northern Heritage Tier',
         'ctg' => 'Decor & Floral', 'dist' => 'Jaffna',
         'date' => 'Oct 14, 2025', 'ago' => '3 days ago', 'sla' => ['elevate', 'Queue Priority Elevating'],
         'as' => ['ok', '3/3 Docs Validated', 'Craft authenticity certificate', ['file-text', 'flower', 'images']],
         'kyc' => ['ready', 'Ready for Review', 'Identity & BR Passed'], 'resub' => false, 'left' => 44, 'age' => 74],

        ['n' => 'Silverline Bridal Cars & Chauffeur', 'mark' => null, 'flag' => null,
         'who' => 'Fleet Manager: Ruwan Abeysekara', 'code' => 'PV-95411', 'note' => 'Fleet Permit: FL-8821',
         'img' => 'images/vendors/silverline.jpg', 'tint' => 'from-[#dfe2e6] to-[#8c939c]',
         'cat' => 'Vintage Bridal Cars & Chauffeur', 'reg' => 'Colombo & Kurunegala', 'tier' => 'Island-wide Transfers',
         'ctg' => 'Transport & Logistics', 'dist' => 'Kurunegala',
         'date' => 'Oct 14, 2025', 'ago' => '3 days ago', 'sla' => ['paused', 'SLA Paused (Awaiting Vendor)'],
         'as' => ['bad', '2/3 Docs (Missing Doc)', 'Insurance certificate missing', ['file-text', 'car', 'shield']],
         'kyc' => ['flag', 'Exception Flagged', 'Audit Failed: Insurance'], 'resub' => true, 'left' => 999, 'age' => 75],

        ['n' => 'Ratnapura Gem & Jewellery Atelier', 'mark' => null, 'flag' => null,
         'who' => 'Designer: Menaka Silva', 'code' => 'PV-94980', 'note' => 'VAT Registered',
         'img' => 'images/vendors/gem.jpg', 'tint' => 'from-[#d9d3ec] to-[#7a6aa8]',
         'cat' => 'Bridal Jewellery & Gemstone Design', 'reg' => 'Ratnapura', 'tier' => 'Gem Craft Tier',
         'ctg' => 'Bridal Wear & Couture', 'dist' => 'Ratnapura',
         'date' => 'Oct 13, 2025', 'ago' => '4 days ago', 'sla' => ['elevate', 'Queue Priority Elevating'],
         'as' => ['ok', '4/4 Docs Validated', 'Gem lab certificates attached', ['file-text', 'id-card', 'sparkles', 'shield']],
         'kyc' => ['ready', 'Ready for Review', 'Dossier Complete'], 'resub' => false, 'left' => 48, 'age' => 96],

        ['n' => 'Galle Fort Poruwa & Heritage Rites', 'mark' => null, 'flag' => ['Heritage', 'gold'],
         'who' => 'Master: Wimal Jayawardena', 'code' => 'ASTRO-GAL-007', 'note' => 'Lineage Registry: 3rd Generation',
         'img' => 'images/vendors/gallefort.jpg', 'tint' => 'from-[#e6cfa9] to-[#8d6a3e]',
         'cat' => 'Poruwa Ceremony Direction & Nekath', 'reg' => 'Galle Fort & Unawatuna', 'tier' => 'Custom Jayamangala',
         'ctg' => 'Poruwa & Heritage Rites', 'dist' => 'Galle',
         'date' => 'Oct 13, 2025', 'ago' => '4 days ago', 'sla' => ['ok', '22h SLA Remaining'],
         'as' => ['gold', '4/4 Verified Proofs', '27 Verified Clan Endorsements', ['sparkles', 'trophy', 'id-card', 'star']],
         'kyc' => ['heritage', 'Priority Heritage Audit', 'Elder Council Endorsed'], 'resub' => false, 'left' => 22, 'age' => 97],
    ];
    $total = count($apps);
@endphp

<div class="mx-auto max-w-[1180px]">

    {{-- ============ Breadcrumb + title ============ --}}
    <nav aria-label="Breadcrumb" class="flex flex-wrap items-center gap-1.5 text-[10.5px] text-muted">
        <a href="#" class="transition hover:text-wine">Admin Console</a>
        <x-admin.icon name="chevron-right" :size="10" class="text-muted-2" />
        <a href="#" class="transition hover:text-wine">Directory &amp; Governance</a>
        <x-admin.icon name="chevron-right" :size="10" class="text-muted-2" />
        <strong class="font-semibold text-gold-ink">Vendor Applications</strong>
    </nav>

    <div class="mt-2 flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="max-w-[600px]">
            <h1 class="font-serif text-[25px] font-semibold leading-[1.2] text-wine-dark sm:text-[28px] lg:text-[29px]">Vendor Applications &amp; Artisan Vetting Queue</h1>
            <p class="mt-2 text-[12px] leading-relaxed text-muted">Review business registrations, police clearances, CAA drone licenses, portfolio proofs, and Poruwa cultural compliance before granting marketplace luxury badges.</p>
        </div>

        <div class="flex flex-wrap gap-2 lg:shrink-0 lg:pt-1">
            <button type="button" data-toast="Vetting Guidelines (SOP) - demo only, no document attached."
                    class="inline-flex h-9 items-center gap-2 rounded-lg bg-white px-3.5 text-[11.5px] font-semibold text-ink shadow-[0_1px_3px_rgba(92,19,46,.08)] transition hover:-translate-y-0.5 hover:shadow-md">
                <x-admin.icon name="book-open" :size="14" /> Vetting Guidelines (SOP)
            </button>
            <button type="button" data-toast="Batch Export (CSV) - demo only, nothing was exported."
                    class="inline-flex h-9 items-center gap-2 rounded-lg bg-white px-3.5 text-[11.5px] font-semibold text-ink shadow-[0_1px_3px_rgba(92,19,46,.08)] transition hover:-translate-y-0.5 hover:shadow-md">
                <x-admin.icon name="download" :size="14" /> Batch Export (CSV)
            </button>
            <button type="button" data-toast="Configure KYC Rules - demo only, no rules were changed."
                    class="inline-flex h-9 items-center gap-2 rounded-lg bg-wine-dark px-3.5 text-[11.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-wine hover:shadow-lg hover:shadow-wine/25">
                <x-admin.icon name="sliders" :size="14" /> Configure KYC Rules
            </button>
        </div>
    </div>

    {{-- ============ Stat cards ============ --}}
    <section class="mt-5 grid gap-3.5 sm:grid-cols-2 xl:grid-cols-4" aria-label="Queue statistics">

        {{-- Applications in queue --}}
        <article class="relative min-h-[112px] overflow-hidden rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <span class="pointer-events-none absolute -bottom-10 right-1 size-[110px] rounded-full bg-gold-bg/70"></span>
            <p class="text-[9.5px] font-semibold uppercase tracking-[.08em] text-muted">Applications in Queue</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="font-serif text-[40px] font-semibold leading-none text-wine-dark">14</span>
                <span class="text-[9.5px] font-semibold text-[#c98a1b]">+3 since dawn</span>
            </div>
            <p class="mt-2 text-[10px] text-muted">Awaiting artisan inspection</p>
            <span class="absolute right-4 top-1/2 inline-flex size-9 -translate-y-1/2 items-center justify-center rounded-full bg-gold-bg text-gold-ink"><x-admin.icon name="clipboard-clock" :size="17" /></span>
        </article>

        {{-- Avg SLA turnaround --}}
        <article class="relative min-h-[112px] overflow-hidden rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <span class="pointer-events-none absolute -bottom-3 right-0 h-11 w-28 rounded-tl-[70px] bg-[#e4ece6]"></span>
            <p class="text-[9.5px] font-semibold uppercase tracking-[.08em] text-muted">Avg SLA Turnaround</p>
            <div class="mt-3 flex items-baseline gap-1">
                <span class="font-serif text-[40px] font-semibold leading-none text-ink">18.4</span>
                <span class="text-[12px] font-semibold text-ink">h</span>
                <span class="ml-1 text-[9.5px] font-semibold text-[#3b7a52]">&searr; -2.1h</span>
            </div>
            <p class="mt-2 text-[10px] font-medium text-[#3b7a52]">Within target (&lt; 24h ceiling)</p>
            <span class="absolute right-4 top-1/2 inline-flex size-9 -translate-y-1/2 items-center justify-center rounded-full bg-chip text-[#5b4a4f]"><x-admin.icon name="timer" :size="17" /></span>
        </article>

        {{-- High-season urgent queue --}}
        <article class="relative min-h-[112px] overflow-hidden rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <span class="pointer-events-none absolute -bottom-10 right-1 size-[110px] rounded-full bg-[#fde3e3]/80"></span>
            <p class="flex items-center gap-1.5 text-[9.5px] font-semibold uppercase tracking-[.08em] text-[#c43d4b]"><i class="inline-block size-1.5 rounded-full bg-[#c43d4b]"></i> High-Season Urgent Queue</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="font-serif text-[40px] font-semibold leading-none text-[#b3303f]">6</span>
                <span class="text-[9.5px] font-semibold text-[#b3303f]">&lt; 8h SLA remain</span>
            </div>
            <p class="mt-2 text-[10px] text-muted">Poruwa &amp; Drone priority</p>
            <span class="absolute right-4 top-1/2 inline-flex size-9 -translate-y-1/2 items-center justify-center rounded-full bg-[#fddcdc] text-[#c43d4b]"><x-admin.icon name="triangle-alert" :size="17" /></span>
        </article>

        {{-- Approval rate --}}
        <article class="relative min-h-[112px] overflow-hidden rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <p class="text-[9.5px] font-semibold uppercase tracking-[.08em] text-muted">Approval Rate (90d)</p>
            <div class="mt-3 flex items-baseline gap-1.5">
                <span class="font-serif text-[40px] font-semibold leading-none text-[#735a22]">68.5%</span>
                <span class="text-[9.5px] font-semibold text-[#735a22]">Strict Luxury</span>
            </div>
            <p class="mt-2 text-[10px] text-muted">Top 30% artisan curation</p>
            <span class="absolute right-4 top-1/2 inline-flex size-10 -translate-y-1/2 items-center justify-center" role="img" aria-label="68 percent">
                <svg viewBox="0 0 36 36" class="absolute inset-0 size-full -rotate-90">
                    <circle cx="18" cy="18" r="15.5" fill="none" stroke="#f1e7d6" stroke-width="3.2"/>
                    <circle cx="18" cy="18" r="15.5" fill="none" stroke="#735a22" stroke-width="3.2" stroke-linecap="round" stroke-dasharray="66.2 97.4"/>
                </svg>
                <span class="relative text-[9px] font-bold text-[#735a22]">68%</span>
            </span>
        </article>
    </section>

    {{-- ============ Tabs ============ --}}
    <div class="mt-5 flex gap-1 overflow-x-auto rounded-xl bg-white p-2 shadow-[0_1px_3px_rgba(92,19,46,.06)] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden" role="tablist" aria-label="Application status">
        @foreach ($tabs as [$key, $label, $count])
            <button type="button" role="tab" data-tab="{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                    class="group inline-flex shrink-0 items-center gap-2 whitespace-nowrap rounded-lg px-3.5 py-2 text-[12px] font-medium text-[#4a3a3f] transition
                           hover:bg-chip aria-selected:bg-wine-dark aria-selected:font-semibold aria-selected:text-white aria-selected:shadow-md aria-selected:shadow-wine/20 aria-selected:hover:bg-wine-dark">
                {{ $label }}
                <span class="rounded-full bg-chip px-1.5 py-px text-[9.5px] font-bold text-muted group-aria-selected:bg-gold-bg group-aria-selected:text-gold-ink">{{ $count }}</span>
            </button>
        @endforeach
    </div>

    {{-- ============ Search + filters ============ --}}
    <div class="mt-4 flex flex-col gap-2.5 rounded-xl bg-white p-3 shadow-[0_1px_3px_rgba(92,19,46,.06)] lg:flex-row lg:items-center">
        <label class="flex h-10 min-w-0 flex-1 items-center gap-2.5 rounded-lg bg-[#f6f3ec] px-3 transition focus-within:bg-white focus-within:ring-[3px] focus-within:ring-wine/10">
            <x-admin.icon name="search" :size="15" class="text-muted" />
            <input id="appSearch" type="search" placeholder="Search by business name, BR number, owner name, district..."
                   class="min-w-0 flex-1 border-0 bg-transparent text-[12px] text-ink outline-none placeholder:text-muted-2">
        </label>

        <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-[1fr_1fr_auto] lg:flex lg:items-center">
            <div class="relative col-span-2 sm:col-span-1 lg:w-[172px]">
                <select id="appCategory" class="h-10 w-full appearance-none rounded-lg bg-[#f6f3ec] pl-3 pr-8 text-[11.5px] font-medium text-ink outline-none transition hover:bg-[#f1ece3] focus:ring-[3px] focus:ring-wine/15">
                    <option value="">All 22 Nuptial Categories</option>
                    @foreach ($categories as $c) <option value="{{ $c }}">{{ $c }}</option> @endforeach
                </select>
                <x-admin.icon name="chevron-down" :size="13" class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-muted" />
            </div>
            <div class="relative col-span-2 sm:col-span-1 lg:w-[128px]">
                <select id="appDistrict" class="h-10 w-full appearance-none rounded-lg bg-[#f6f3ec] pl-3 pr-8 text-[11.5px] font-medium text-ink outline-none transition hover:bg-[#f1ece3] focus:ring-[3px] focus:ring-wine/15">
                    <option value="">All Districts</option>
                    @foreach ($districts as $d) <option value="{{ $d }}">{{ $d }}</option> @endforeach
                </select>
                <x-admin.icon name="chevron-down" :size="13" class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-muted" />
            </div>
            <div class="relative lg:w-[178px]">
                <select id="appSort" class="h-10 w-full appearance-none rounded-lg bg-[#f6f3ec] pl-3 pr-9 text-[11.5px] font-medium text-ink outline-none transition hover:bg-[#f1ece3] focus:ring-[3px] focus:ring-wine/15">
                    <option value="urgent">Urgent SLA (&lt; 12h) first</option>
                    <option value="newest">Newest submitted first</option>
                    <option value="oldest">Oldest submitted first</option>
                </select>
                <x-admin.icon name="list-filter" :size="14" class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-muted" />
            </div>
            <button type="button" id="appReset" aria-label="Reset filters"
                    class="inline-flex size-10 items-center justify-center justify-self-start rounded-lg bg-[#f6f3ec] text-[#4a3a3f] transition hover:bg-[#f1ece3] hover:text-wine active:rotate-180 sm:justify-self-auto">
                <x-admin.icon name="rotate" :size="15" />
            </button>
        </div>
    </div>

    {{-- ============ Applications table ============ --}}
    <section class="mt-4 overflow-hidden rounded-2xl bg-bg-soft shadow-[0_1px_3px_rgba(92,19,46,.05)]" aria-label="Vendor applications">

        {{-- batch bar --}}
        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3.5">
            <label class="inline-flex cursor-pointer items-center gap-2.5 text-[11px]">
                <input id="selectAll" type="checkbox" class="size-[15px] cursor-pointer rounded-[4px] border border-[#cfc4c1] accent-wine-dark">
                <strong class="font-bold text-ink">Select All (<span id="queuedCount">{{ $total }}</span> Queued)</strong>
                <span class="hidden items-center gap-1.5 text-[10px] font-medium text-gold-ink sm:inline-flex"><i class="inline-block size-[3px] rounded-full bg-gold-ink"></i> Batch Operations Available</span>
            </label>

            <div class="flex flex-wrap gap-2">
                <button type="button" data-batch="resubmission"
                        class="inline-flex h-8 items-center gap-2 rounded-md bg-white px-3 text-[10.5px] font-semibold text-ink shadow-[0_1px_2px_rgba(92,19,46,.08)] transition hover:-translate-y-0.5 hover:shadow-md">
                    <x-admin.icon name="mail-plus" :size="13" class="text-[#b0701a]" /> Batch Request Resubmission
                </button>
                <button type="button" data-batch="fasttrack"
                        class="inline-flex h-8 items-center gap-2 rounded-md bg-wine-dark px-3 text-[10.5px] font-semibold text-white transition hover:-translate-y-0.5 hover:bg-wine hover:shadow-lg hover:shadow-wine/25">
                    <x-admin.icon name="circle-check" :size="13" /> Fast-Track Selected
                </button>
            </div>
        </div>

        {{-- column headings (desktop only) --}}
        <div class="hidden px-4 pb-2.5 pt-1 text-[9.5px] font-bold uppercase tracking-[.1em] text-[#6c5f63] xl:grid xl:grid-cols-[24px_minmax(0,2.5fr)_minmax(0,1fr)_minmax(0,1fr)_minmax(0,1.15fr)_minmax(0,1.05fr)_196px] xl:gap-x-4">
            <span></span>
            <span>Applicant / Business</span>
            <span>Category &amp; Region</span>
            <span>Submitted &amp; SLA</span>
            <span>Verification Assets</span>
            <span>KYC Audit Status</span>
            <span class="text-right">Actions</span>
        </div>

        {{-- rows --}}
        <div id="appRows" class="divide-y divide-line/70 bg-white">
            @foreach ($apps as $i => $a)
                @php
                    [$slaTone, $slaText] = $a['sla'];
                    [$slaCls, $slaIcon, $slaDot] = $slaStyles[$slaTone];
                    [$asTone, $asLabel, $asSub, $asIcons] = $a['as'];
                    [$kycTone, $kycLabel, $kycSub] = $a['kyc'];
                    [$kycCls, $kycIcon] = $kycStyles[$kycTone];
                    $haystack = strtolower($a['n'].' '.$a['who'].' '.$a['code'].' '.$a['note'].' '.$a['dist'].' '.$a['reg'].' '.$a['cat']);
                @endphp
                <article data-row data-i="{{ $i }}" data-left="{{ $a['left'] }}" data-age="{{ $a['age'] }}"
                         data-cat="{{ $a['ctg'] }}" data-dist="{{ $a['dist'] }}" data-name="{{ $a['n'] }}" data-search="{{ $haystack }}"
                         class="grid grid-cols-[24px_minmax(0,1fr)] gap-x-3 gap-y-3.5 px-4 py-3.5 transition-colors hover:bg-[#fffaf8]
                                xl:grid-cols-[24px_minmax(0,2.5fr)_minmax(0,1fr)_minmax(0,1fr)_minmax(0,1.15fr)_minmax(0,1.05fr)_196px] xl:items-center xl:gap-x-4 xl:gap-y-0">

                    {{-- checkbox --}}
                    <input type="checkbox" data-pick aria-label="Select {{ $a['n'] }}" class="mt-3 size-[15px] cursor-pointer rounded-[4px] border border-[#cfc4c1] accent-wine-dark xl:mt-0">

                    {{-- applicant --}}
                    <div class="flex min-w-0 items-start gap-3">
                        <span class="relative inline-block size-9 shrink-0 overflow-hidden rounded-lg bg-gradient-to-br {{ $a['tint'] }}">
                            {{-- optional photo: drop it in public/images/vendors/ (if missing the gradient stays) --}}
                            <img src="{{ asset($a['img']) }}" alt="" loading="lazy" class="absolute inset-0 size-full object-cover" onerror="this.remove()">
                        </span>
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-x-1.5 gap-y-1">
                                <h3 class="text-[11.5px] font-semibold leading-tight text-ink">{{ $a['n'] }}</h3>
                                @if ($a['mark'] === 'verified') <x-admin.icon name="badge-check" :size="13" class="text-[#8a7a4a]" />
                                @elseif ($a['mark'] === 'star') <x-admin.icon name="star" :size="12" class="text-[#8a7a4a]" /> @endif
                                @if ($a['flag'])
                                    <span class="rounded px-1.5 py-px text-[8.5px] font-bold {{ $flagStyles[$a['flag'][1]] }}">{{ $a['flag'][0] }}</span>
                                @endif
                            </div>
                            <p class="mt-0.5 text-[9.5px] text-muted-2">{{ $a['who'] }}</p>
                            <p class="mt-1 flex flex-wrap items-center gap-x-1.5 gap-y-1 text-[9.5px] text-muted">
                                <span class="rounded bg-gold-bg px-1.5 py-px font-mono text-[8.5px] font-bold tracking-tight text-gold-ink">{{ $a['code'] }}</span>
                                {{ $a['note'] }}
                            </p>
                        </div>
                    </div>

                    {{-- the four middle cells: 2-col grid on phones/tablets, flattened into the main grid on desktop --}}
                    <div class="col-span-2 grid gap-x-4 gap-y-3.5 border-t border-line/60 pt-3.5 sm:grid-cols-2 xl:contents">

                        {{-- category & region --}}
                        <div class="min-w-0">
                            <p class="mb-1 text-[9px] font-bold uppercase tracking-[.1em] text-muted-2 xl:hidden">Category &amp; Region</p>
                            <p class="text-[10px] font-semibold leading-snug text-ink">{{ $a['cat'] }}</p>
                            <p class="mt-1 flex items-start gap-1 text-[9px] leading-snug text-muted"><x-admin.icon name="map-pin" :size="9" class="mt-0.5 text-gold-ink" /> {{ $a['reg'] }}</p>
                            <p class="mt-1 text-[9px] font-semibold leading-snug text-gold-ink">{{ $a['tier'] }}</p>
                        </div>

                        {{-- submitted & SLA --}}
                        <div class="min-w-0">
                            <p class="mb-1 text-[9px] font-bold uppercase tracking-[.1em] text-muted-2 xl:hidden">Submitted &amp; SLA</p>
                            <p class="text-[10.5px] font-medium leading-snug text-ink">{{ $a['date'] }} <span class="text-muted-2">({{ $a['ago'] }})</span></p>
                            <span class="mt-1.5 inline-flex max-w-full items-start gap-1.5 rounded-2xl px-2.5 py-0.5 text-[9px] font-bold leading-tight {{ $slaCls }}">
                                @if ($slaIcon) <x-admin.icon :name="$slaIcon" :size="11" class="mt-px" />
                                @else <i class="mt-[3px] inline-block size-1.5 shrink-0 rounded-full {{ $slaDot }}"></i> @endif
                                {{ $slaText }}
                            </span>
                        </div>

                        {{-- verification assets --}}
                        <div class="min-w-0">
                            <p class="mb-1 text-[9px] font-bold uppercase tracking-[.1em] text-muted-2 xl:hidden">Verification Assets</p>
                            <div class="flex items-start gap-x-2 {{ $assetText[$asTone] }}">
                                <span class="min-w-0 text-[9.5px] font-bold leading-tight">{{ $asLabel }}</span>
                                <span class="inline-flex shrink-0 items-center gap-1.5 pt-px">
                                    @foreach ($asIcons as $ic) <x-admin.icon :name="$ic" :size="12" /> @endforeach
                                </span>
                            </div>
                            <p class="mt-1 text-[9px] leading-snug {{ $asTone === 'bad' ? 'text-[#c43d4b]' : 'text-muted' }}">{{ $asSub }}</p>
                        </div>

                        {{-- KYC audit status --}}
                        <div class="min-w-0">
                            <p class="mb-1 text-[9px] font-bold uppercase tracking-[.1em] text-muted-2 xl:hidden">KYC Audit Status</p>
                            <span class="inline-flex max-w-full items-center gap-1.5 rounded-2xl px-2.5 py-1.5 text-[9px] font-bold leading-tight {{ $kycCls }}">
                                <x-admin.icon :name="$kycIcon" :size="12" /> {{ $kycLabel }}
                            </span>
                            <p class="mt-1 text-[9px] leading-snug text-muted">{{ $kycSub }}</p>
                        </div>
                    </div>

                    {{-- actions --}}
                    <div class="col-span-2 flex flex-wrap items-center gap-2 xl:col-span-1 xl:flex-nowrap xl:justify-end">
                        <button type="button" data-toast="Review Dossier - demo only: {{ $a['n'] }}"
                                class="inline-flex h-7 items-center gap-1.5 rounded-md bg-white px-2.5 text-[9.5px] font-bold text-wine-dark shadow-[0_1px_3px_rgba(92,19,46,.12)] ring-1 ring-line/60 transition hover:-translate-y-0.5 hover:shadow-md
                                       {{ $a['resub'] ? 'xl:h-auto xl:min-h-7 xl:max-w-[68px] xl:whitespace-normal xl:py-1 xl:text-left xl:leading-tight' : '' }}">
                            Review Dossier <x-admin.icon name="eye" :size="12" />
                        </button>

                        @if ($a['resub'])
                            <button type="button" data-action="resubmit" data-name="{{ $a['n'] }}"
                                    class="inline-flex min-h-8 items-center justify-center rounded-md bg-[#fedb9b] px-3 py-1.5 text-center text-[9.5px] font-bold leading-tight text-[#8a5a10] transition hover:-translate-y-0.5 hover:bg-[#fdd07f] hover:shadow-md xl:w-[84px] xl:px-2">
                                Request Resubmission
                            </button>
                        @else
                            <button type="button" data-action="approve" data-name="{{ $a['n'] }}" aria-label="Approve {{ $a['n'] }}"
                                    class="inline-flex size-7 items-center justify-center rounded-md bg-wine-dark text-white transition hover:-translate-y-0.5 hover:bg-wine hover:shadow-lg hover:shadow-wine/30">
                                <x-admin.icon name="check" :size="14" :stroke="2.5" />
                            </button>
                            <button type="button" data-action="reject" data-name="{{ $a['n'] }}" aria-label="Reject {{ $a['n'] }}"
                                    class="inline-flex size-7 items-center justify-center rounded-md bg-chip text-muted transition hover:-translate-y-0.5 hover:bg-[#fddcdc] hover:text-[#b3303f]">
                                <x-admin.icon name="x" :size="14" />
                            </button>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        {{-- empty state (shown by JS when nothing matches) --}}
        <div id="emptyState" hidden class="bg-white px-4 py-14 text-center">
            <span class="mx-auto inline-flex size-11 items-center justify-center rounded-full bg-chip text-wine"><x-admin.icon name="search" :size="18" /></span>
            <h3 id="emptyTitle" class="mt-3 font-serif text-[18px] font-semibold text-wine-dark">No applications found</h3>
            <p id="emptyText" class="mt-1 text-[12px] text-muted">Try a different search or reset the filters.</p>
        </div>

        {{-- footer: note + pagination --}}
        <div class="flex flex-col gap-3 px-4 py-4 text-[10.5px] text-muted lg:flex-row lg:items-center lg:justify-between">
            <p class="flex items-start gap-2">
                <x-admin.icon name="shield" :size="13" class="mt-px text-gold-ink" />
                <span>Applications approved here move to <strong class="font-bold text-ink">"Awaiting Activation"</strong> until the vendor executes their SafeHaven Escrow Merchant Agreement and completes bank wire verification.</span>
            </p>
            <div class="flex flex-wrap items-center gap-3 sm:justify-between lg:justify-end lg:gap-4">
                <span id="showingText" class="font-semibold">Showing 1&ndash;5 of {{ $total }} pending applications</span>
                <nav id="pager" class="flex items-center gap-1.5" aria-label="Pagination"></nav>
            </div>
        </div>
    </section>

    {{-- ============ Compliance info cards ============ --}}
    <section class="mt-5 grid gap-3.5 lg:grid-cols-3" aria-label="Compliance reference">
        <article class="flex items-start gap-3 rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <span class="inline-flex size-10 shrink-0 items-center justify-center rounded-lg bg-gold-bg text-gold-ink"><x-admin.icon name="shield-check" :size="18" /></span>
            <div>
                <h4 class="font-serif text-[14.5px] font-semibold leading-tight text-ink">Tier-1 Identity Verification</h4>
                <p class="mt-1 text-[10.5px] leading-relaxed text-muted">Sri Lankan Department of Registrar of Companies (DRC) API cross-reference is active with 99.8% match confidence.</p>
            </div>
        </article>
        <article class="flex items-start gap-3 rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <span class="inline-flex size-10 shrink-0 items-center justify-center rounded-lg bg-chip text-wine"><x-admin.icon name="scale" :size="18" /></span>
            <div>
                <h4 class="font-serif text-[14.5px] font-semibold leading-tight text-ink">Cultural Poruwa Mandate</h4>
                <p class="mt-1 text-[10.5px] leading-relaxed text-muted">All traditional officiants and ceremonial drummers require lineage verification or Astrological Council credentials.</p>
            </div>
        </article>
        <article class="flex items-start gap-3 rounded-xl bg-white p-4 shadow-[0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_10px_24px_rgba(92,19,46,.10)]">
            <span class="inline-flex size-10 shrink-0 items-center justify-center rounded-lg bg-[#fddcdc] text-[#c43d4b]"><x-admin.icon name="plane-landing" :size="18" /></span>
            <div>
                <h4 class="font-serif text-[14.5px] font-semibold leading-tight text-ink">Civil Aviation (CAA) Drone Law</h4>
                <p class="mt-1 text-[10.5px] leading-relaxed text-muted">Commercial nuptial drone flights over heritage venues require active Category-C pilot licensing and 3rd-party indemnity.</p>
            </div>
        </article>
    </section>
</div>

{{-- ============ Frontend-only confirmation dialog + toast ============ --}}
<dialog id="confirmDialog" class="m-auto w-[min(92vw,400px)] rounded-2xl bg-white p-0 text-ink shadow-[0_24px_60px_rgba(92,19,46,.30)] backdrop:bg-ink/40 backdrop:backdrop-blur-[2px]">
    <div class="p-5 sm:p-6">
        <span id="dlgIcon" class="inline-flex size-10 items-center justify-center rounded-full bg-gold-bg text-gold-ink"><x-admin.icon name="circle-check" :size="18" /></span>
        <h2 id="dlgTitle" class="mt-3 font-serif text-[20px] font-semibold text-wine-dark">Confirm action</h2>
        <p id="dlgText" class="mt-1.5 text-[12px] leading-relaxed text-muted"></p>
        <p class="mt-3 rounded-lg bg-chip px-3 py-2 text-[10.5px] text-[#5d4a50]">Demo preview &mdash; no data is saved or sent anywhere.</p>
        <div class="mt-5 grid grid-cols-2 gap-2.5">
            <button type="button" id="dlgCancel" class="btn btn-soft">Cancel</button>
            <button type="button" id="dlgConfirm" class="btn btn-primary">Confirm</button>
        </div>
    </div>
</dialog>

<div id="toast" role="status" aria-live="polite"
     class="pointer-events-none fixed bottom-4 left-1/2 z-[60] max-w-[92vw] -translate-x-1/2 translate-y-3 rounded-lg bg-wine-dark px-4 py-2.5 text-[12px] font-medium text-white opacity-0 shadow-xl shadow-wine/30 transition duration-300"></div>
@endsection

@push('scripts')
<script>
(function () {
    var PAGE_SIZE = 5;
    var list = document.getElementById('appRows');
    var rows = Array.prototype.slice.call(list.querySelectorAll('[data-row]'));
    var els = {
        search: document.getElementById('appSearch'), cat: document.getElementById('appCategory'),
        dist: document.getElementById('appDistrict'), sort: document.getElementById('appSort'),
        reset: document.getElementById('appReset'), selectAll: document.getElementById('selectAll'),
        queued: document.getElementById('queuedCount'), showing: document.getElementById('showingText'),
        pager: document.getElementById('pager'), empty: document.getElementById('emptyState'),
        emptyTitle: document.getElementById('emptyTitle'), emptyText: document.getElementById('emptyText'),
        toast: document.getElementById('toast'), dialog: document.getElementById('confirmDialog')
    };
    var state = { tab: 'pending', page: 1 };

    // ---------- helpers ----------
    var toastTimer;
    function toast(msg) {
        els.toast.textContent = msg;
        els.toast.classList.remove('opacity-0', 'translate-y-3');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { els.toast.classList.add('opacity-0', 'translate-y-3'); }, 2800);
    }
    function visibleRows() { return rows.filter(function (r) { return !r.hidden; }); }

    // ---------- filter + sort ----------
    function getFiltered() {
        if (state.tab !== 'pending') return [];
        var q = els.search.value.trim().toLowerCase();
        var out = rows.filter(function (r) {
            return (!q || r.dataset.search.indexOf(q) > -1) &&
                   (!els.cat.value || r.dataset.cat === els.cat.value) &&
                   (!els.dist.value || r.dataset.dist === els.dist.value);
        });
        var mode = els.sort.value;
        out.sort(function (a, b) {
            if (mode === 'newest') return a.dataset.age - b.dataset.age;
            if (mode === 'oldest') return b.dataset.age - a.dataset.age;
            return a.dataset.i - b.dataset.i;               // default order (as in the design)
        });
        return out;
    }

    // ---------- pagination ----------
    var base = 'inline-flex size-8 items-center justify-center rounded-md text-[11.5px] font-semibold transition ';
    function pagerBtn(label, page, opts) {
        opts = opts || {};
        var cls = base + (opts.active ? 'bg-wine-dark text-white shadow-md shadow-wine/25'
                 : opts.disabled ? 'cursor-not-allowed text-muted-2/50'
                 : 'bg-white text-ink shadow-sm hover:bg-chip');
        return '<button type="button" ' + (opts.disabled ? 'disabled ' : '') + 'data-page="' + page + '" class="' + cls + '"' +
               (opts.aria ? ' aria-label="' + opts.aria + '"' : '') + (opts.active ? ' aria-current="page"' : '') + '>' + label + '</button>';
    }
    var chevL = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>';
    var chevR = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>';

    function render() {
        var f = getFiltered();
        var pages = Math.max(1, Math.ceil(f.length / PAGE_SIZE));
        if (state.page > pages) state.page = pages;
        var start = (state.page - 1) * PAGE_SIZE;

        rows.forEach(function (r) { r.hidden = true; });
        f.forEach(function (r) { list.appendChild(r); });                 // apply sort order
        f.slice(start, start + PAGE_SIZE).forEach(function (r) { r.hidden = false; });

        els.queued.textContent = f.length;
        els.selectAll.checked = false;

        var none = f.length === 0;
        els.empty.hidden = !none;
        if (none) {
            var other = state.tab !== 'pending';
            els.emptyTitle.textContent = other ? 'No sample records in this tab' : 'No applications found';
            els.emptyText.textContent = other ? 'This is a frontend demo - only the Pending Review tab has sample data.' : 'Try a different search or reset the filters.';
            els.showing.textContent = 'Showing 0 of 0 pending applications';
        } else {
            els.showing.textContent = 'Showing ' + (start + 1) + '\u2013' + Math.min(start + PAGE_SIZE, f.length) + ' of ' + f.length + ' pending applications';
        }

        var html = pagerBtn(chevL, state.page - 1, { disabled: state.page === 1 || none, aria: 'Previous page' });
        for (var p = 1; p <= pages && !none; p++) html += pagerBtn(p, p, { active: p === state.page });
        html += pagerBtn(chevR, state.page + 1, { disabled: state.page === pages || none, aria: 'Next page' });
        els.pager.innerHTML = html;
    }

    els.pager.addEventListener('click', function (e) {
        var b = e.target.closest('[data-page]');
        if (!b || b.disabled) return;
        state.page = parseInt(b.dataset.page, 10);
        render();
    });

    // ---------- controls ----------
    ['input', 'change'].forEach(function (ev) {
        [els.search, els.cat, els.dist, els.sort].forEach(function (el) {
            el.addEventListener(ev, function () { state.page = 1; render(); });
        });
    });
    els.reset.addEventListener('click', function () {
        els.search.value = ''; els.cat.value = ''; els.dist.value = ''; els.sort.value = 'urgent';
        state.tab = 'pending'; state.page = 1;
        document.querySelectorAll('[data-tab]').forEach(function (t) { t.setAttribute('aria-selected', String(t.dataset.tab === 'pending')); });
        render();
    });
    document.querySelectorAll('[data-tab]').forEach(function (t) {
        t.addEventListener('click', function () {
            state.tab = t.dataset.tab; state.page = 1;
            document.querySelectorAll('[data-tab]').forEach(function (x) { x.setAttribute('aria-selected', String(x === t)); });
            render();
        });
    });
    els.selectAll.addEventListener('change', function () {
        visibleRows().forEach(function (r) { r.querySelector('[data-pick]').checked = els.selectAll.checked; });
    });

    // ---------- batch buttons (demo only) ----------
    document.querySelectorAll('[data-batch]').forEach(function (b) {
        b.addEventListener('click', function () {
            var n = rows.filter(function (r) { return r.querySelector('[data-pick]').checked; }).length;
            if (!n) { toast('Select at least one application first.'); return; }
            toast((b.dataset.batch === 'fasttrack' ? 'Fast-Track' : 'Batch resubmission request') + ' - demo only (' + n + ' selected, nothing saved).');
        });
    });
    document.querySelectorAll('[data-toast]').forEach(function (b) {
        b.addEventListener('click', function () { toast(b.dataset.toast); });
    });

    // ---------- approve / reject / resubmit confirmation (demo only) ----------
    var pending = null;
    var copy = {
        approve:  ['Approve application?',          'would move to "Awaiting Activation".'],
        reject:   ['Reject application?',           'would be marked as Rejected / Incomplete.'],
        resubmit: ['Request document resubmission?', 'would be asked to resubmit the missing documents.']
    };
    list.addEventListener('click', function (e) {
        var b = e.target.closest('[data-action]');
        if (!b) return;
        pending = b.dataset.action;
        document.getElementById('dlgTitle').textContent = copy[pending][0];
        document.getElementById('dlgText').textContent = b.dataset.name + ' ' + copy[pending][1];
        els.dialog.showModal();
    });
    document.getElementById('dlgCancel').addEventListener('click', function () { els.dialog.close(); });
    document.getElementById('dlgConfirm').addEventListener('click', function () {
        els.dialog.close();
        toast('Demo only - the "' + pending + '" action was not saved.');
    });
    els.dialog.addEventListener('click', function (e) { if (e.target === els.dialog) els.dialog.close(); });

    render();
})();
</script>
@endpush
