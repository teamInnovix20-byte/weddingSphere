@extends('layouts.account')

{{--
    One Settings page, five sections. The URL decides which one shows:
      /settings/security | notifications | connected | billing | sessions
    ($section is sent from AccountController@settings)
--}}

@php
    $titles = [
        'security'      => ['Security & Credentials',   'Control your master password, two-step verification and passkeys.'],
        'notifications' => ['Notification Preferences', 'Choose how WeddingSphere reaches you for each type of update.'],
        'connected'     => ['Connected Accounts',       'Calendars, wallets and messaging services linked to your dossier.'],
        'billing'       => ['Escrow Billing & VAT',     'Your plan, tax details and invoice history.'],
        'sessions'      => ['Session Management',       'Devices that are signed in to your account right now.'],
    ];
    [$pageTitle, $pageText] = $titles[$section];

    // shared styles (same look as Member 1's login form)
    $card  = 'rounded-2xl bg-white p-4 shadow-[0_12px_30px_rgba(92,19,46,.06),0_1px_3px_rgba(92,19,46,.05)] sm:p-5';
    $panel = 'rounded-xl bg-bg-soft p-3 transition duration-200 hover:bg-[#f8e9e6]';
    $field = 'flex h-[42px] items-center gap-2.5 rounded-lg border border-transparent bg-field px-3 transition focus-within:border-wine focus-within:bg-white focus-within:ring-[3px] focus-within:ring-wine/10 hover:border-wine/30';
    $input = 'min-w-0 flex-1 border-0 bg-transparent text-[12.5px] text-ink outline-none placeholder:text-[#a3979a]';
    $lbl   = 'mb-1.5 block text-[11px] font-semibold text-ink';
    $softBtn = 'inline-flex h-9 items-center justify-center gap-1.5 rounded-lg bg-chip-2 px-3.5 text-[11.5px] font-semibold text-wine-dark transition duration-200 hover:bg-[#efdfdc] hover:shadow-md hover:shadow-wine/10 active:translate-y-px';
@endphp

@section('title', $pageTitle.' - WeddingSphere')

@section('account')

{{-- ============ Page heading ============ --}}
<div class="flex flex-wrap items-center gap-x-2 gap-y-1.5 text-[9.5px] font-semibold uppercase tracking-[.07em] text-muted">
    <span>Settings</span><span>/</span><span class="text-wine-dark">{{ $pageTitle }}</span>
</div>
<h1 class="mt-3 font-serif text-[27px] font-semibold leading-[1.15] text-wine-dark sm:text-[31px]">{{ $pageTitle }}</h1>
<p class="mt-1.5 max-w-[520px] text-[12px] leading-relaxed text-muted">{{ $pageText }}</p>

<div class="mt-5 flex flex-col gap-4">

{{-- ================================================================
     1. SECURITY & CREDENTIALS
     ================================================================ --}}
@if ($section === 'security')

    <section class="{{ $card }}">
        <h2 class="text-[14px] font-bold">Change Master Password</h2>
        <p class="text-[10.5px] text-muted">Use at least 12 characters with a mix of letters, numbers and symbols.</p>

        <form data-demo="Password updated (demo only - backend comes later)." class="mt-4 grid grid-cols-1 gap-3.5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="pw_current" class="{{ $lbl }}">Current password</label>
                <div class="{{ $field }}">
                    <x-pf-icon name="lock" :size="15" class="text-[#4a3a3f]" />
                    <input id="pw_current" type="password" placeholder="••••••••••••" autocomplete="current-password" class="{{ $input }}">
                    <button type="button" data-toggle-pw="pw_current" class="inline-flex p-0.5 text-[#4a3a3f] transition hover:text-wine" aria-label="Show or hide password"><x-pf-icon name="eye" :size="16" /></button>
                </div>
            </div>
            <div>
                <label for="pw_new" class="{{ $lbl }}">New password</label>
                <div class="{{ $field }}">
                    <x-pf-icon name="lock" :size="15" class="text-[#4a3a3f]" />
                    <input id="pw_new" type="password" placeholder="••••••••••••" autocomplete="new-password" class="{{ $input }}">
                    <button type="button" data-toggle-pw="pw_new" class="inline-flex p-0.5 text-[#4a3a3f] transition hover:text-wine" aria-label="Show or hide password"><x-pf-icon name="eye" :size="16" /></button>
                </div>
            </div>
            <div>
                <label for="pw_confirm" class="{{ $lbl }}">Confirm new password</label>
                <div class="{{ $field }}">
                    <x-pf-icon name="lock" :size="15" class="text-[#4a3a3f]" />
                    <input id="pw_confirm" type="password" placeholder="••••••••••••" autocomplete="new-password" class="{{ $input }}">
                    <button type="button" data-toggle-pw="pw_confirm" class="inline-flex p-0.5 text-[#4a3a3f] transition hover:text-wine" aria-label="Show or hide password"><x-pf-icon name="eye" :size="16" /></button>
                </div>
            </div>
            <div class="sm:col-span-2 sm:flex sm:justify-end">
                <button type="submit" class="btn btn-primary sm:w-auto sm:px-6">Update Password</button>
            </div>
        </form>
    </section>

    <section class="{{ $card }}">
        <h2 class="text-[14px] font-bold">Two-Step Verification</h2>
        <p class="text-[10.5px] text-muted">Add a second check whenever someone signs in or approves an escrow payment.</p>

        <div class="mt-4 space-y-2.5">
            @foreach ([
                ['smartphone', 'Authenticator App', 'Time-based codes from Google Authenticator or similar apps', true],
                ['message',    'SMS One-Time Code', 'Sent to +94 77 123 4567 via Dialog Axiata',                  true],
                ['mail',       'Email Verification', 'Backup code sent to claire.s@luxuryweddings.lk',            false],
            ] as [$icon, $name, $note, $on])
                <div class="{{ $panel }} flex items-center gap-3">
                    <span class="inline-flex size-9 shrink-0 items-center justify-center rounded-lg bg-white/70 text-wine"><x-pf-icon :name="$icon" :size="16" /></span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[12.5px] font-semibold">{{ $name }}</p>
                        <p class="text-[10px] text-muted">{{ $note }}</p>
                    </div>
                    <x-pf-toggle :label="$name" :checked="$on" />
                </div>
            @endforeach
        </div>
    </section>

    <section class="{{ $card }}">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-[14px] font-bold">Passkeys &amp; Biometrics</h2>
                <p class="text-[10.5px] text-muted">Sign contracts and approve payments without typing a password.</p>
            </div>
            <button type="button" data-toast="Passkey set-up will be available when the backend is ready." class="{{ $softBtn }}"><x-pf-icon name="plus" :size="13" /> Add Passkey</button>
        </div>

        <div class="mt-4 space-y-2.5">
            <div class="{{ $panel }} flex items-center gap-3">
                <x-pf-icon name="key" :size="16" class="shrink-0 text-[#2f7a45]" />
                <div class="min-w-0 flex-1">
                    <p class="text-[12.5px] font-semibold">Digital Letterpress Passkey</p>
                    <p class="text-[10px] text-muted">Claire's iPhone &amp; Julian's MacBook Pro • added 12 Aug</p>
                </div>
                <x-pf-chip tone="green">Active</x-pf-chip>
            </div>
            <div class="{{ $panel }} flex items-center gap-3">
                <x-pf-icon name="fingerprint" :size="16" class="shrink-0 text-wine" />
                <div class="min-w-0 flex-1">
                    <p class="text-[12.5px] font-semibold">Biometric Seal</p>
                    <p class="text-[10px] text-muted">Fingerprint unlock on registered phones</p>
                </div>
                <x-pf-chip tone="green">Active</x-pf-chip>
            </div>
        </div>
    </section>

{{-- ================================================================
     2. NOTIFICATION PREFERENCES
     ================================================================ --}}
@elseif ($section === 'notifications')

    @php
        $channels = ['Email', 'SMS', 'WhatsApp', 'Push'];
        $topics = [
            ['Vendor messages & quotes',      'New replies, quotations and contract updates',   [true,  false, true,  true]],
            ['Escrow & payment alerts',       'Deposits, releases and dual-signatory approvals', [true,  true,  true,  true]],
            ['Checklist reminders',           'Tasks that are due or overdue',                   [true,  false, false, true]],
            ['Guest RSVP updates',            'When a guest accepts, declines or changes',       [true,  false, false, false]],
            ['Auspicious Nekath reminders',   'Countdown to key ceremony times',                 [false, true,  true,  true]],
        ];
    @endphp

    <form data-demo="Notification preferences saved (demo only - backend comes later)." class="{{ $card }}">
        <div class="overflow-x-auto">
            <div class="min-w-[520px]">
                <div class="grid grid-cols-[minmax(0,1fr)_repeat(4,64px)] items-center gap-2 border-b border-line pb-3 text-center text-[9.5px] font-bold uppercase tracking-[.07em] text-muted-2">
                    <span class="text-left">Type of update</span>
                    @foreach ($channels as $ch)<span>{{ $ch }}</span>@endforeach
                </div>

                @foreach ($topics as [$topic, $note, $states])
                    <div class="grid grid-cols-[minmax(0,1fr)_repeat(4,64px)] items-center gap-2 border-b border-line/70 py-3 transition duration-200 last:border-0 hover:bg-bg-soft">
                        <div class="pl-1">
                            <p class="text-[12.5px] font-semibold">{{ $topic }}</p>
                            <p class="text-[10px] text-muted">{{ $note }}</p>
                        </div>
                        @foreach ($states as $i => $on)
                            <span class="flex justify-center"><x-pf-toggle :label="$topic.' - '.$channels[$i]" :checked="$on" /></span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4 flex justify-end">
            <button type="submit" class="btn btn-primary sm:w-auto sm:px-6">Save Preferences</button>
        </div>
    </form>

    <section class="{{ $card }} flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-[14px] font-bold">Quiet Hours</h2>
            <p class="text-[10.5px] text-muted">Pause non-urgent alerts between 10:00 PM and 7:00 AM (Colombo time).</p>
        </div>
        <x-pf-toggle label="Quiet hours" :checked="true" />
    </section>

{{-- ================================================================
     3. CONNECTED ACCOUNTS
     ================================================================ --}}
@elseif ($section === 'connected')

    <section class="{{ $card }}">
        <h2 class="text-[14px] font-bold">Linked Services</h2>
        <p class="text-[10.5px] text-muted">These services can send alerts and sync milestones for you.</p>

        <div class="mt-4 space-y-2.5">
            @foreach ([
                ['message',  'WhatsApp VIP Bot',  '+94 77 123 4567',          'Active', 'green'],
                ['calendar', 'Google Calendar',   '18 vendor milestone syncs', 'Synced', 'green'],
                ['wallet',   'Apple Wallet',      '2 VIP passes generated',    'Issued', 'green'],
                ['message',  'Dialog Axiata SMS', 'High-priority OTP & alerts','Primary','gray'],
            ] as [$icon, $name, $note, $status, $tone])
                <div class="{{ $panel }} flex flex-wrap items-center gap-3">
                    <span class="inline-flex size-9 shrink-0 items-center justify-center rounded-lg bg-white/70 text-wine"><x-pf-icon :name="$icon" :size="16" /></span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[12.5px] font-semibold">{{ $name }}</p>
                        <p class="text-[10px] text-muted">{{ $note }}</p>
                    </div>
                    <x-pf-chip :tone="$tone">{{ $status }}</x-pf-chip>
                    <button type="button" data-toast="{{ $name }} would be disconnected (demo only)." class="rounded-lg px-3 py-1.5 text-[10.5px] font-bold text-[#b3303f] transition hover:bg-[#fbe4e6]">Disconnect</button>
                </div>
            @endforeach
        </div>
    </section>

    <section class="{{ $card }}">
        <h2 class="text-[14px] font-bold">Available to Connect</h2>
        <p class="text-[10.5px] text-muted">More ways to keep your wedding team in sync.</p>

        <div class="mt-4 grid grid-cols-1 gap-2.5 sm:grid-cols-2">
            @foreach ([
                ['calendar', 'Outlook Calendar', 'Sync ceremony milestones'],
                ['mail',     'Gmail',            'Forward vendor quotations'],
                ['phone',    'Zoom',             'Join tasting calls in one tap'],
                ['credit-card', 'Google Pay',    'Pay vendor deposits faster'],
            ] as [$icon, $name, $note])
                <div class="{{ $panel }} flex items-center gap-3">
                    <span class="inline-flex size-9 shrink-0 items-center justify-center rounded-lg bg-white/70 text-wine"><x-pf-icon :name="$icon" :size="16" /></span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[12.5px] font-semibold">{{ $name }}</p>
                        <p class="truncate text-[10px] text-muted">{{ $note }}</p>
                    </div>
                    <button type="button" data-toast="{{ $name }} connection is coming soon." class="{{ $softBtn }} h-8">Connect</button>
                </div>
            @endforeach
        </div>
    </section>

{{-- ================================================================
     4. ESCROW BILLING & VAT
     ================================================================ --}}
@elseif ($section === 'billing')

    <section class="{{ $card }} flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <span class="inline-flex size-10 shrink-0 items-center justify-center rounded-[10px] bg-wine text-white"><x-pf-icon name="landmark" :size="18" /></span>
            <div>
                <p class="text-[9px] font-semibold uppercase tracking-[.07em] text-muted-2">Current plan</p>
                <h2 class="font-serif text-[18px] font-semibold leading-tight">Premier Couple Suite</h2>
                <p class="text-[10.5px] text-muted">LKR 45,000 per event • renews on Dec 18</p>
            </div>
        </div>
        <button type="button" data-toast="Plan changes are coming soon." class="{{ $softBtn }}">Change Plan</button>
    </section>

    <section class="{{ $card }}">
        <h2 class="text-[14px] font-bold">VAT &amp; Billing Details</h2>
        <p class="text-[10.5px] text-muted">These details appear on every escrow invoice.</p>

        <form data-demo="Billing details saved (demo only - backend comes later)." class="mt-4 grid grid-cols-1 gap-3.5 sm:grid-cols-2">
            <div>
                <label for="b_name" class="{{ $lbl }}">Billing name</label>
                <div class="{{ $field }}"><x-pf-icon name="user" :size="15" class="text-[#4a3a3f]" /><input id="b_name" type="text" value="Claire Senanayake" class="{{ $input }}"></div>
            </div>
            <div>
                <label for="b_vat" class="{{ $lbl }}">VAT registration no.</label>
                <div class="{{ $field }}"><x-pf-icon name="id-card" :size="15" class="text-[#4a3a3f]" /><input id="b_vat" type="text" placeholder="e.g. 134567890-7000" class="{{ $input }}"></div>
            </div>
            <div class="sm:col-span-2">
                <label for="b_addr" class="{{ $lbl }}">Billing address</label>
                <div class="{{ $field }}"><x-pf-icon name="map-pin" :size="15" class="text-[#4a3a3f]" /><input id="b_addr" type="text" value="14/2 Alfred Place, Colombo 03, Western Province 00300" class="{{ $input }}"></div>
            </div>
            <div class="sm:col-span-2 sm:flex sm:justify-end">
                <button type="submit" class="btn btn-primary sm:w-auto sm:px-6">Save Billing Details</button>
            </div>
        </form>
    </section>

    <section class="{{ $card }}">
        <h2 class="text-[14px] font-bold">Invoice History</h2>
        <div class="mt-3 overflow-x-auto">
            <table class="w-full min-w-[460px] text-left text-[11.5px]">
                <thead>
                    <tr class="border-b border-line text-[9.5px] font-bold uppercase tracking-[.07em] text-muted-2">
                        <th class="py-2 font-bold">Invoice</th><th class="py-2 font-bold">Date</th><th class="py-2 font-bold">Amount (incl. VAT)</th><th class="py-2 font-bold">Status</th><th class="py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['INV-2025-0412', '12 Oct 2025', 'LKR 45,000', 'Paid'],
                        ['INV-2025-0377', '18 Sep 2025', 'LKR 12,500', 'Paid'],
                        ['INV-2025-0301', '02 Aug 2025', 'LKR 8,750',  'Paid'],
                    ] as [$no, $date, $amount, $status])
                        <tr class="border-b border-line/70 transition duration-200 last:border-0 hover:bg-bg-soft">
                            <td class="py-3 font-semibold">{{ $no }}</td>
                            <td class="py-3 text-muted">{{ $date }}</td>
                            <td class="py-3">{{ $amount }}</td>
                            <td class="py-3"><x-pf-chip tone="green">{{ $status }}</x-pf-chip></td>
                            <td class="py-3 text-right"><button type="button" data-toast="Invoice download is coming soon." class="inline-flex p-1 text-wine transition hover:scale-110" aria-label="Download {{ $no }}"><x-pf-icon name="download" :size="15" /></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

{{-- ================================================================
     5. SESSION MANAGEMENT
     ================================================================ --}}
@elseif ($section === 'sessions')

    <section class="{{ $card }}">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-[14px] font-bold">Signed-in Devices</h2>
                <p class="text-[10.5px] text-muted">If you do not recognise a device, sign it out and change your password.</p>
            </div>
            <button type="button" data-toast="All other devices would be signed out (demo only)." class="{{ $softBtn }}"><x-pf-icon name="log-out" :size="13" /> Sign Out All Others</button>
        </div>

        <div class="mt-4 space-y-2.5">
            @foreach ([
                ['laptop',     "Julian's MacBook Pro • Safari",  'Colombo, Sri Lanka • Active now',     true],
                ['smartphone', "Claire's iPhone 15 • WeddingSphere app", 'Colombo, Sri Lanka • 2 hours ago', false],
                ['laptop',     'Windows PC • Chrome',            'Kandy, Sri Lanka • 3 days ago',       false],
            ] as [$icon, $device, $where, $current])
                <div class="{{ $panel }} flex flex-wrap items-center gap-3">
                    <span class="inline-flex size-9 shrink-0 items-center justify-center rounded-lg bg-white/70 text-wine"><x-pf-icon :name="$icon" :size="16" /></span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[12.5px] font-semibold">{{ $device }}</p>
                        <p class="text-[10px] text-muted">{{ $where }}</p>
                    </div>
                    @if ($current)
                        <x-pf-chip tone="green">This device</x-pf-chip>
                    @else
                        <button type="button" data-toast="{{ $device }} would be signed out (demo only)." class="rounded-lg px-3 py-1.5 text-[10.5px] font-bold text-[#b3303f] transition hover:bg-[#fbe4e6]">Sign out</button>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

@endif

</div>
@endsection

@push('scripts')
<script>
    // eye button: show / hide the password in the same row
    document.querySelectorAll('[data-toggle-pw]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.dataset.togglePw);
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });
</script>
@endpush
