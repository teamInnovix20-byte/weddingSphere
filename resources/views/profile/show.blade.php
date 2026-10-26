@extends('layouts.profile')

@section('title', 'Profile & Identity - WeddingSphere')

@php
    // ------------------------------------------------------------------
    // SAMPLE DATA (frontend only). Change the words here and the page updates.
    // When the backend is ready, these arrays will come from the controller.
    // ------------------------------------------------------------------
    $stats = [
        ['icon' => 'users',      'label' => 'Bonded Artisans',  'value' => '6 Vendors',   'sub' => '100% Contracted',        'subClass' => 'is-green'],
        ['icon' => 'wallet',     'label' => 'Protected Escrow', 'value' => 'LKR 11.45M',  'sub' => 'Dual-Signatory Gate',    'subClass' => ''],
        ['icon' => 'user-check', 'label' => 'Guest RSVPs',      'value' => '210 / 250',   'sub' => '84% Affirmative',        'subClass' => 'is-green'],
        ['icon' => 'list-checks','label' => 'Checklist Health', 'value' => '96%',         'sub' => '2 Tasks Pending',        'subClass' => '', 'bar' => 96],
    ];

    $people = [
        [
            'photo' => 'images/profile/claire.jpg', 'name' => 'Claire Senanayake', 'role' => 'Bride', 'roleTone' => 'gold',
            'preferred' => 'Preferred: Claire • Primary Account Holder',
            'email' => 'claire.s@luxuryweddings.lk', 'phone' => '+94 77 123 4567',
            'nic' => '199482103982', 'nicFrom' => 'Sri Lanka Department of RGD',
            'authority' => 'Tier 1 Lead Signatory', 'authorityNote' => 'Full Disbursement Clearance',
            'province' => 'Western Province', 'address' => '14/2 Alfred Place, Colombo 03, Western Province 00300',
            'tags' => ['Traditional Kandyan Osariya', 'Vegetarian (Lacto)', 'Asiri Atelier Couture'],
            'footIcon' => 'fingerprint', 'footText' => 'Biometric Seal: Active',
        ],
        [
            'photo' => 'images/profile/julian.jpg', 'name' => 'Julian Jayawardena', 'role' => 'Groom', 'roleTone' => 'gray',
            'preferred' => 'Preferred: Julian • Co-Signatory Partner',
            'email' => 'julian@jayawardena.org', 'phone' => '+94 71 890 2341',
            'nic' => '199217004491', 'nicFrom' => 'Sri Lanka Department of RGD',
            'authority' => 'Dual-Signatory Gate', 'authorityNote' => 'Approver for > LKR 500,000',
            'province' => 'Cinnamon Gardens', 'address' => "42 Gregory's Road, Colombo 07, Western Province 00700",
            'tags' => ['Nilame Ceremonial Regalia', 'Pescatarian', 'Kandy Heritage Guild'],
            'footIcon' => 'lock-keyhole', 'footText' => 'Dual PIN Security: Enforced',
        ],
    ];

    $ceremony = [
        ['label' => 'Ceremony Theme & Motif', 'value' => 'Royal Kandyan Heritage & Contemporary Floral Gala', 'note' => 'Palette: Champagne Ivory, Lotus Deep Burgundy, Ceylon Gold'],
        ['label' => 'Ceremonial Venue',       'value' => 'Heritance Tea Factory & Heritage Grounds',         'note' => 'Kandapola, Nuwara Eliya (Elevation 6,800 ft)'],
        ['label' => 'Language & Liturgy',     'value' => 'English (UK) + Traditional Sinhala',                'note' => 'Dual-language ceremonial invitations & Poruwa Ashtaka chants'],
        ['label' => 'Astrological Authority', 'value' => 'Venerable K. Rahula (Kelaniya Guild)',              'note' => 'Poruwa Ascent: 09:24 AM • Water Blessing: 10:02 AM'],
    ];

    $checks = [
        ['icon' => 'id-card',  'title' => 'National Identity Verification (e-NIC / Bio-Passport)', 'note' => 'Both parties matched against the national register with SHA-256 fingerprint', 'status' => 'Sealed'],
        ['icon' => 'landmark', 'title' => 'Tripartite Escrow Signatory Mandate',                   'note' => 'Dual approval mandatory for all stage payments over LKR 500,000 (Commercial Bank of Ceylon)', 'status' => 'Enforced'],
        ['icon' => 'key',      'title' => 'Digital Letterpress Passkey (Contract Signing)',        'note' => "FIDO2 WebAuthn credential enrolled on Claire's iPhone & Julian's MacBook Pro", 'status' => 'Active'],
    ];

    $services = [
        ['icon' => 'message',     'name' => 'WhatsApp VIP Bot', 'note' => '+94 77 123 4567',          'status' => 'Active', 'tone' => 'green'],
        ['icon' => 'calendar',    'name' => 'Google Calendar',  'note' => '18 Vendor Milestone Syncs', 'status' => 'Synced', 'tone' => 'green'],
        ['icon' => 'wallet',      'name' => 'Apple Wallet',     'note' => '2 VIP Passes Generated',    'status' => 'Issued', 'tone' => 'green'],
        ['icon' => 'message',     'name' => 'Dialog Axiata SMS','note' => 'High-priority OTP & Alerts','status' => 'Primary','tone' => 'gray'],
    ];
@endphp

@section('account')

{{-- ============ Breadcrumb + status chips ============ --}}
<div class="pp-crumbs">
    <span>Settings</span><span>/</span><span class="pp-here">Profile &amp; Identity</span>
    <i class="pp-sep"></i>
    <span class="pp-chip pp-chip--gray">Joint Couple Dossier #EVT-4912</span>
    <span class="pp-chip pp-chip--gold"><x-pf-icon name="circle-check" :size="10" /> Tier 1 Signatory</span>
    <span class="pp-chip pp-chip--green"><x-pf-icon name="landmark" :size="10" /> CBSL Verified Escrow</span>
</div>

{{-- ============ Title + action buttons ============ --}}
<div class="pp-head">
    <div>
        <h1 class="pp-title">Profile &amp; Identity Overview</h1>
        <p class="pp-lead">Manage joint couple biographical profiles, verified national identity credentials, ceremonial milestone dossier, and communication channels.</p>
    </div>

    <div class="pp-actions">
        <a href="#" data-toast="Dossier download will be available when the backend is ready." class="pp-btn">
            <x-pf-icon name="download" :size="14" /> Download Dossier
        </a>
        <a href="#" data-toast="Public registry page is coming soon." class="pp-btn">
            <x-pf-icon name="external-link" :size="14" /> Public Registry
        </a>
        <button type="button" data-open-edit class="pp-btn pp-btn--primary">
            <x-pf-icon name="edit" :size="14" /> Edit Profile Details
        </button>
    </div>
</div>

{{-- ============ Hero banner + stats strip ============ --}}
<div class="pp-hero-wrap">
    <section class="pp-hero">
        {{-- background photo: public/images/profile/hero-couple.jpg (removes itself if the file is missing) --}}
        <img class="pp-hero-img" src="{{ asset('images/profile/hero-couple.jpg') }}" alt="" onerror="this.remove()">

        <span class="pp-hero-live"><i class="pp-dot"></i> Joint Legal Profile Live</span>

        <div class="pp-hero-bottom">
            <div class="pp-hero-people">
                <div class="pp-faces">
                    <img src="{{ asset('images/profile/claire.jpg') }}" alt="Claire">
                    <img src="{{ asset('images/profile/julian.jpg') }}" alt="Julian">
                </div>
                <div>
                    <h2 class="pp-hero-name">
                        Claire Senanayake &amp; Julian Jayawardena
                        <x-pf-icon name="badge-check" :size="16" />
                    </h2>
                    <p class="pp-hero-sub">
                        <span>Nuwara Eliya Poruwa &amp; Grand Ballroom Gala</span>
                        <i class="pp-bullet"></i>
                        <b>Dec 18, 2025</b>
                    </p>
                    <span class="pp-chip pp-chip--wine">58 Days Remaining</span>
                </div>
            </div>

            <div class="pp-nekath">
                <span class="pp-nekath-ico"><x-pf-icon name="sparkles" :size="16" /></span>
                <div>
                    <small>Auspicious Nekath</small>
                    <b>09:24 AM <span>(Kelaniya Almanac)</span></b>
                </div>
            </div>
        </div>
    </section>

    <div class="pp-stats">
        @foreach ($stats as $stat)
            <div class="pp-stat">
                <span class="pp-stat-ico"><x-pf-icon :name="$stat['icon']" :size="18" /></span>
                <div>
                    <small>{{ $stat['label'] }}</small>
                    <p class="pp-stat-val">
                        {{ $stat['value'] }}
                        @isset($stat['bar'])
                            <span class="pp-bar"><i style="width: {{ $stat['bar'] }}%"></i></span>
                        @endisset
                    </p>
                    <p class="pp-stat-sub {{ $stat['subClass'] }}">{{ $stat['sub'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- ============ Bride + Groom identity cards ============ --}}
<div class="pp-people">
    @foreach ($people as $p)
        <article class="pp-card pp-person">
            <header class="pp-person-head">
                <div class="pp-person-id">
                    <img src="{{ asset($p['photo']) }}" alt="{{ $p['name'] }}">
                    <div>
                        <h3 class="pp-person-name">
                            {{ $p['name'] }} <span class="pp-chip pp-chip--{{ $p['roleTone'] }}">{{ $p['role'] }}</span>
                        </h3>
                        <p class="pp-person-pref">{{ $p['preferred'] }}</p>
                    </div>
                </div>
                <span class="pp-chip pp-chip--green"><x-pf-icon name="shield-check" :size="10" /> Gov e-ID</span>
            </header>

            <div class="pp-stack">
                {{-- contact --}}
                <div class="pp-panel">
                    <div class="pp-row-between">
                        <p class="pp-label">Contact Coordinates</p>
                        <a href="#" data-toast="WhatsApp VIP link is coming soon." class="pp-wa"><x-pf-icon name="message" :size="11" /> WhatsApp VIP</a>
                    </div>
                    <div class="pp-contact">
                        <span><x-pf-icon name="mail" :size="13" />{{ $p['email'] }}</span>
                        <span class="pp-ph"><x-pf-icon name="phone" :size="13" />{{ $p['phone'] }}</span>
                    </div>
                </div>

                {{-- NIC + authority --}}
                <div class="pp-two">
                    <div class="pp-panel">
                        <p class="pp-label">National Identity (NIC)</p>
                        <p class="pp-big">{{ $p['nic'] }} <x-pf-icon name="circle-check" :size="14" /></p>
                        <p class="pp-note">{{ $p['nicFrom'] }}</p>
                    </div>
                    <div class="pp-panel">
                        <p class="pp-label">Escrow Authority</p>
                        <p class="pp-big is-wine">{{ $p['authority'] }}</p>
                        <p class="pp-note">{{ $p['authorityNote'] }}</p>
                    </div>
                </div>

                {{-- domicile --}}
                <div class="pp-panel">
                    <div class="pp-row-between">
                        <p class="pp-label">Registered Domicile</p>
                        <span class="pp-prov">{{ $p['province'] }}</span>
                    </div>
                    <p class="pp-addr">{{ $p['address'] }}</p>
                </div>

                {{-- wardrobe & dietary --}}
                <div class="pp-panel">
                    <p class="pp-label">Ceremonial Wardrobe &amp; Dietary</p>
                    <div class="pp-tags">
                        @foreach ($p['tags'] as $tag)
                            <span>{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <footer class="pp-person-foot">
                <span class="pp-fmuted"><x-pf-icon :name="$p['footIcon']" :size="13" /> {{ $p['footText'] }}</span>
                <a href="#" data-toast="Identity file review is coming soon." class="pp-review">Review Identity File <x-pf-icon name="chevron-right" :size="12" /></a>
            </footer>
        </article>
    @endforeach
</div>

{{-- ============ Lower area: left column (event + verification), right column (presence + QR) ============ --}}
<div class="pp-lower">

    <div class="pp-col">
        {{-- Ceremonial Event & Dossier Parameters --}}
        <section class="pp-card">
            <header class="pp-sec-head">
                <div class="pp-sec-title">
                    <span class="pp-sec-ico pp-sec-ico--wine"><x-pf-icon name="party" :size="17" /></span>
                    <div>
                        <h3>Ceremonial Event &amp; Dossier Parameters</h3>
                        <p>Core architectural constraints bound to all vendor escrow contracts</p>
                    </div>
                </div>
                <button type="button" data-toast="Milestone editor is coming soon." class="pp-small-btn">Modify Milestones</button>
            </header>

            <div class="pp-grid2">
                @foreach ($ceremony as $row)
                    <div class="pp-panel">
                        <p class="pp-label">{{ $row['label'] }}</p>
                        <p class="pp-val">{{ $row['value'] }}</p>
                        <p class="pp-note">{{ $row['note'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="pp-panel pp-venue">
                <x-pf-icon name="map-pin" :size="16" />
                <div class="pp-grow">
                    <b>Heritance Tea Factory, Nuwara Eliya</b>
                    <p class="pp-note">GPS: 6.9934° N, 80.8228° E • Central Highlands Security Escort Registered</p>
                </div>
                <span class="pp-chip pp-chip--gray">Venue Verified</span>
            </div>
        </section>

        {{-- Verification, Security & Compliance --}}
        <section class="pp-card">
            <header class="pp-sec-head">
                <div class="pp-sec-title">
                    <span class="pp-sec-ico pp-sec-ico--green"><x-pf-icon name="gavel" :size="17" /></span>
                    <div>
                        <h3>Verification, Security &amp; Compliance Status</h3>
                        <p>Central Bank of Sri Lanka &amp; SafeHaven Trust Governance</p>
                    </div>
                </div>
                <span class="pp-chip pp-chip--green"><x-pf-icon name="check" :size="10" /> Fully Compliant</span>
            </header>

            <div class="pp-checks">
                @foreach ($checks as $c)
                    <div class="pp-panel pp-check">
                        <x-pf-icon :name="$c['icon']" :size="16" />
                        <div class="pp-grow">
                            <b>{{ $c['title'] }}</b>
                            <p class="pp-note">{{ $c['note'] }}</p>
                        </div>
                        <span class="pp-status"><i class="pp-dot"></i> {{ $c['status'] }}</span>
                    </div>
                @endforeach

                {{-- nuptial day director --}}
                <div class="pp-director">
                    <span class="pp-director-ico"><x-pf-icon name="headset" :size="18" /></span>
                    <div class="pp-grow">
                        <small>Assigned Nuptial Day Director</small>
                        <b>Dilshan Perera (Lead Nuptial Concierge)</b>
                        <p class="pp-note">+94 11 750 9900 • 24/7 Priority Emergency Channel</p>
                    </div>
                    <a href="tel:+94117509900" class="pp-call"><x-pf-icon name="phone" :size="13" /> Direct Call</a>
                </div>
            </div>
        </section>
    </div>

    <div class="pp-col">
        {{-- Connected Presence --}}
        <section class="pp-card">
            <div class="pp-sec-plain">
                <h3>Connected Presence</h3>
                <p>Real-time alerts, vendor sync &amp; digital passes</p>
            </div>

            <div class="pp-services">
                @foreach ($services as $s)
                    <div class="pp-panel pp-service">
                        <span class="pp-service-ico"><x-pf-icon :name="$s['icon']" :size="16" /></span>
                        <div class="pp-grow">
                            <b>{{ $s['name'] }}</b>
                            <p class="pp-note">{{ $s['note'] }}</p>
                        </div>
                        <span class="pp-chip pp-chip--{{ $s['tone'] }}">{{ $s['status'] }}</span>
                    </div>
                @endforeach

                <a href="#" data-toast="Connected Accounts page is coming soon." class="pp-connect">
                    <x-pf-icon name="link" :size="14" /> Connect Another Service
                </a>
            </div>
        </section>

        {{-- Couple Smart Pass & QR --}}
        <section class="pp-card">
            <header class="pp-sec-head" style="align-items:flex-start">
                <div class="pp-sec-plain">
                    <h3>Couple Smart Pass &amp; QR</h3>
                    <p>For on-site vendor check-ins &amp; tasting sessions</p>
                </div>
                <span style="color: var(--pp-gold-ink)"><x-pf-icon name="qr-code" :size="18" /></span>
            </header>

            <div class="pp-qr-wrap">
                {{-- simple drawn QR-style picture (no image file needed) --}}
                <svg viewBox="0 0 120 120" class="pp-qr" width="104" height="104" fill="currentColor" role="img" aria-label="Couple smart pass QR code">
                    <g fill="none" stroke="currentColor" stroke-width="7">
                        <rect x="7" y="7" width="32" height="32" rx="6"/>
                        <rect x="81" y="7" width="32" height="32" rx="6"/>
                        <rect x="7" y="81" width="32" height="32" rx="6"/>
                    </g>
                    <rect x="18" y="18" width="10" height="10" rx="2"/>
                    <rect x="92" y="18" width="10" height="10" rx="2"/>
                    <rect x="18" y="92" width="10" height="10" rx="2"/>
                    <rect x="52" y="8" width="10" height="10" rx="2"/>
                    <rect x="52" y="30" width="10" height="10" rx="2"/>
                    <rect x="8" y="52" width="10" height="10" rx="2"/>
                    <rect x="30" y="52" width="10" height="10" rx="2"/>
                    <rect x="82" y="52" width="10" height="10" rx="2"/>
                    <rect x="102" y="52" width="10" height="10" rx="2"/>
                    <rect x="52" y="82" width="10" height="10" rx="2"/>
                    <rect x="82" y="82" width="10" height="10" rx="2"/>
                    <rect x="102" y="102" width="10" height="10" rx="2"/>
                    <circle cx="60" cy="60" r="8"/>
                </svg>
                <p class="pp-qr-code">WS-LK-4912-CJ</p>
                <p class="pp-note">Expires in 60 days • Tap to present</p>
            </div>

            <footer class="pp-qr-foot">
                <span>Registry Privacy: Protected</span>
                <a href="#" data-toast="Invite link copied (demo only).">Share Invite Link</a>
            </footer>
        </section>
    </div>
</div>

{{-- ============ Bottom info line ============ --}}
<div class="pp-bottom">
    <span><x-pf-icon name="circle-check" :size="13" /> WeddingSphere Cryptographic Dossier ID: <strong>9d8f3-4912-colombo-2025</strong></span>
    <span>
        <em style="font-style:normal">Last synchronized: Today at 10:14 AM IST</em>
        <a href="#" data-toast="Audit log is coming soon.">View Audit Log</a>
    </span>
</div>

{{-- ============ "Edit Profile Details" pop-up window ============ --}}
<dialog id="editProfileDialog" class="pp-dialog">
    <form method="dialog" id="editProfileForm">
        <div class="pp-dialog-head">
            <div>
                <h2>Edit Profile Details</h2>
                <p>Update your photo and contact details. Saving is a demo until the backend is connected.</p>
            </div>
            <button type="button" data-close-edit class="pp-x" aria-label="Close"><x-pf-icon name="x" :size="16" /></button>
        </div>

        {{-- profile photo upload with live preview --}}
        <div class="pp-photo-row">
            <span class="pp-photo-circle">
                <img id="photoPreview" src="" alt="" class="pp-hidden">
                <span id="photoPlaceholder"><x-pf-icon name="user" :size="26" /></span>
            </span>
            <div>
                <b>Profile photo</b>
                <p>JPG or PNG, shown in the top-right corner of the page.</p>
                <label class="pp-file">
                    <x-pf-icon name="camera" :size="13" /> Choose photo
                    <input id="photoInput" type="file" accept="image/png,image/jpeg">
                </label>
            </div>
        </div>

        <div class="pp-form-grid">
            <div>
                <label for="e_name1">Bride name</label>
                <div class="pp-field"><x-pf-icon name="user" :size="15" /><input id="e_name1" type="text" value="Claire Senanayake"></div>
            </div>
            <div>
                <label for="e_name2">Groom name</label>
                <div class="pp-field"><x-pf-icon name="user" :size="15" /><input id="e_name2" type="text" value="Julian Jayawardena"></div>
            </div>
            <div>
                <label for="e_email">Primary email</label>
                <div class="pp-field"><x-pf-icon name="mail" :size="15" /><input id="e_email" type="email" value="claire.s@luxuryweddings.lk"></div>
            </div>
            <div>
                <label for="e_phone">Mobile number</label>
                <div class="pp-field"><x-pf-icon name="phone" :size="15" /><input id="e_phone" type="tel" value="+94 77 123 4567"></div>
            </div>
            <div class="pp-full">
                <label for="e_venue">Ceremony venue</label>
                <div class="pp-field"><x-pf-icon name="map-pin" :size="15" /><input id="e_venue" type="text" value="Heritance Tea Factory, Nuwara Eliya"></div>
            </div>
        </div>

        <div class="pp-dialog-actions">
            <button type="button" data-close-edit class="pp-btn">Cancel</button>
            <button type="submit" class="pp-btn pp-btn--primary">Save Changes</button>
        </div>
    </form>
</dialog>
@endsection

@push('scripts')
<script>
    (function () {
        var dialog = document.getElementById('editProfileDialog');
        var form = document.getElementById('editProfileForm');
        var input = document.getElementById('photoInput');
        var preview = document.getElementById('photoPreview');
        var placeholder = document.getElementById('photoPlaceholder');

        // open / close the pop-up
        document.querySelectorAll('[data-open-edit]').forEach(function (btn) {
            btn.addEventListener('click', function () { dialog.showModal(); });
        });
        dialog.querySelectorAll('[data-close-edit]').forEach(function (btn) {
            btn.addEventListener('click', function () { dialog.close(); });
        });
        // click on the dark area outside the window closes it too
        dialog.addEventListener('click', function (e) { if (e.target === dialog) dialog.close(); });

        // show the chosen picture right away (nothing is uploaded yet)
        input.addEventListener('change', function () {
            var file = input.files && input.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function (ev) {
                preview.src = ev.target.result;
                preview.classList.remove('pp-hidden');
                placeholder.classList.add('pp-hidden');
            };
            reader.readAsDataURL(file);
        });

        // "Save Changes": no backend yet, so just close and tell the user
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            dialog.close();
            window.wsToast('Profile saved (demo only - backend comes later).');
        });
    })();
</script>
@endpush
