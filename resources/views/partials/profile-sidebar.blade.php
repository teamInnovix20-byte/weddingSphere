{{-- Left menu of the Profile screen (logo + 6 links + escrow vault + back link). --}}
@php
    $section = request()->route('section');

    $items = [
        ['label' => 'Profile & Identity',       'icon' => 'id-card',      'url' => route('profile.show'),                   'active' => request()->routeIs('profile.show')],
        // these pages are not part of this task: the link stays visible but only shows a small message
        ['label' => 'Security & Credentials',   'icon' => 'shield-check', 'url' => '#', 'active' => false, 'toast' => 'Security & Credentials page is coming soon.'],
        ['label' => 'Notification Preferences', 'icon' => 'sliders',      'url' => '#', 'active' => false, 'toast' => 'Notification Preferences page is coming soon.'],
        ['label' => 'Connected Accounts', 'icon' => 'share', 'url' => '#', 'active' => false, 'toast' => 'Connected Accounts page is coming soon.'],
        ['label' => 'Escrow Billing & VAT', 'icon' => 'landmark', 'url' => '#', 'active' => false, 'toast' => 'Escrow Billing & VAT page is coming soon.'],
        ['label' => 'Session Management', 'icon' => 'monitor', 'url' => '#', 'active' => false, 'toast' => 'Session Management page is coming soon.'],
    ];
@endphp

<aside class="pp-side">
    <a href="{{ url('/') }}" class="pp-logo" aria-label="WeddingSphere home">
        <img src="{{ asset('images/logo.png') }}" alt="WeddingSphere">
    </a>

    <p class="pp-side-label">Account &amp; Governance</p>

    <nav class="pp-nav" aria-label="Profile and settings menu">
        @foreach ($items as $item)
            <a href="{{ $item['url'] }}" @if ($item['active']) class="is-active" aria-current="page" @endif @isset($item['toast']) data-toast="{{ $item['toast'] }}" @endisset>
                <x-pf-icon :name="$item['icon']" :size="16" />
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="pp-side-bottom">
        <div class="pp-vault">
            <div class="pp-vault-top">
                <span>Escrow Vault</span>
                <span class="pp-active"><i class="pp-dot"></i> Active</span>
            </div>
            Sampath Trust #902-88-COL
        </div>

        <a href="{{ route('portal.index') }}" class="pp-back">
            <x-pf-icon name="store" :size="14" /> Back to Public Portal
        </a>
    </div>
</aside>
