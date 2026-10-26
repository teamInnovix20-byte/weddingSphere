@extends('layouts.app')

@section('title', 'Sign In - WeddingSphere')

@section('content')
<section class="pb-[58px] pt-[26px]">
    <div class="ws-container">

        <div class="flex flex-col gap-2 text-[10.5px] text-muted sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ route('portal.index') }}" class="inline-flex items-center gap-1.5 text-[#4a3a3f] transition hover:-translate-x-0.5 hover:text-wine">
                <x-icon name="arrow-left" :size="12" /> Back to Portal Selection
            </a>
            <span>Portal Gateway / <strong class="font-semibold text-ink">Unified Sign-In</strong></span>
        </div>

        <div class="mt-[22px] grid grid-cols-1 items-stretch gap-[26px] lg:grid-cols-[minmax(0,.72fr)_minmax(0,1fr)]">

            {{-- Left: hero panel (container with a background picture) --}}
            <aside class="group relative flex min-h-[360px] flex-col overflow-hidden rounded-[14px] bg-[linear-gradient(160deg,#a9808a_0%,#7d3b50_45%,#5c132e_100%)] text-white
                          shadow-[0_12px_32px_rgba(92,19,46,.12)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_44px_rgba(92,19,46,.28)] lg:min-h-[470px]">

                {{-- BACKGROUND PICTURE: put your photo at public/images/login-hero.jpg --}}
                <x-bg-image src="images/login-hero.jpg" />
                {{-- colour layer that keeps the text readable on top of the picture --}}
                <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(180deg,rgba(70,25,40,.10)_0%,rgba(92,19,46,.55)_55%,rgba(92,19,46,.85)_100%)]"></div>

                <div class="relative z-10 flex flex-1 flex-col px-[26px] pb-[22px] pt-6">
                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-white/20 px-[11px] py-1.5 text-[9.5px] font-bold uppercase tracking-[.07em] backdrop-blur-md transition duration-300 group-hover:bg-white/30">
                        <x-icon name="star" :size="11" /> Unified Portal 2.4
                    </span>
                    <h2 class="mb-3 mt-5 max-w-[290px] font-serif text-[27px] font-semibold leading-[1.15] sm:text-[31px]">Curating timeless moments with precision.</h2>
                    <p class="max-w-[300px] text-[12.5px] leading-[1.6] text-white/90">Access your curated couple itinerary, elite artisan vendor dashboard, or administrative coordination hub seamlessly.</p>

                    <div class="mt-auto rounded-xl border border-white/20 bg-white/15 p-4 backdrop-blur-md transition duration-300 hover:bg-white/25">
                        <div class="flex items-center gap-3">
                            <div class="flex">
                                <span class="inline-flex size-7 items-center justify-center rounded-full border-2 border-white/90 bg-[#fdd9a0] text-[8.5px] font-bold text-[#7a5a14]">LM</span>
                                <span class="-ml-2 inline-flex size-7 items-center justify-center rounded-full border-2 border-white/90 bg-[#f6bfd0] text-[8.5px] font-bold text-[#8a3a56]">CR</span>
                                <span class="-ml-2 inline-flex size-7 items-center justify-center rounded-full border-2 border-white/90 bg-white text-[8.5px] font-bold text-wine-dark">SK</span>
                            </div>
                            <div>
                                <strong class="block text-[11.5px] font-bold">99.8% Coordination SLA</strong>
                                <small class="block text-[10.5px] opacity-80">Over 1,200 prestige events planned</small>
                            </div>
                        </div>
                        <blockquote class="mt-3 text-[11px] italic leading-[1.55] text-white/90">"WeddingSphere united our floral styling, ballroom acoustics, and guest concierge under one flawless sanctuary."</blockquote>
                    </div>
                </div>
            </aside>

            {{-- Right: sign-in card --}}
            <div class="flex flex-col gap-3.5">
                <div class="rounded-[14px] bg-white px-5 pb-6 pt-[26px] shadow-[0_12px_32px_rgba(92,19,46,.08),0_1px_3px_rgba(92,19,46,.06)] transition duration-300 hover:shadow-[0_18px_44px_rgba(92,19,46,.16),0_1px_3px_rgba(92,19,46,.06)] sm:px-[26px]">
                    <div class="flex flex-wrap items-center justify-between gap-x-3 text-[9.5px] uppercase tracking-[.08em]">
                        <span class="inline-flex items-center gap-1.5 font-bold text-[#6b5a3c]"><i class="inline-block size-1.5 rounded-full bg-wine-dark"></i> Single Access Vault</span>
                        <span class="text-[10px] normal-case tracking-[.02em] text-muted-2">Protocol ID #WS-890</span>
                    </div>

                    <h1 class="mb-1 mt-1.5 font-serif text-[25px] font-semibold leading-[1.2] text-wine sm:text-[29px]">Welcome Back to WeddingSphere</h1>
                    <p class="text-[12.5px] text-muted">Log in to access your wedding planning workspace or vendor business suite.</p>

                    <div class="mb-[18px] mt-4 flex items-start gap-2.5 rounded-lg bg-chip px-[13px] py-[11px] transition duration-300 hover:-translate-y-0.5 hover:bg-[#efe1de] hover:shadow-md">
                        <x-icon name="shield-check" :size="16" class="mt-0.5 text-wine-dark" />
                        <div>
                            <strong class="block text-[11.5px] font-bold text-ink">Intelligent Multi-Role Routing</strong>
                            <p class="text-[10.5px] leading-normal text-[#5d4a50]">The system automatically routes you to your Bride/Groom workspace, Vendor portal, or Admin suite based on your credentials.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login.store') }}" novalidate>
                        @csrf

                        <div class="mb-3.5">
                            <div class="mb-[7px] flex items-baseline justify-between">
                                <label for="email" class="text-[11px] font-semibold text-ink">Account Email</label>
                                <span class="text-[10px] text-muted-2">Personal or Business</span>
                            </div>
                            <div class="flex h-[42px] items-center gap-2.5 rounded-lg border bg-field px-3 transition focus-within:border-wine focus-within:bg-white focus-within:ring-[3px] focus-within:ring-wine/10 hover:border-wine/30 @error('email') border-[#c43d4b] @else border-transparent @enderror">
                                <x-icon name="mail" :size="15" class="text-[#4a3a3f]" />
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                       placeholder="name@example.com or vendor@studio.lk" autocomplete="username"
                                       class="min-w-0 flex-1 border-0 bg-transparent text-[12.5px] text-ink outline-none placeholder:text-[#a3979a]">
                            </div>
                            @error('email')
                                <p class="mt-[5px] text-[10.5px] text-[#b3303f]">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3.5">
                            <div class="mb-[7px] flex items-baseline justify-between">
                                <label for="password" class="text-[11px] font-semibold text-ink">Master Password</label>
                            </div>
                            <div class="flex h-[42px] items-center gap-2.5 rounded-lg border bg-field px-3 transition focus-within:border-wine focus-within:bg-white focus-within:ring-[3px] focus-within:ring-wine/10 hover:border-wine/30 @error('password') border-[#c43d4b] @else border-transparent @enderror">
                                <x-icon name="lock" :size="15" class="text-[#4a3a3f]" />
                                <input id="password" type="password" name="password"
                                       placeholder="••••••••••••" autocomplete="current-password"
                                       class="min-w-0 flex-1 border-0 bg-transparent text-[12.5px] text-ink outline-none placeholder:text-[#a3979a]">
                                <button type="button" id="togglePassword" class="inline-flex p-0.5 text-[#4a3a3f] transition hover:text-wine" aria-label="Show or hide password">
                                    <x-icon name="eye" :size="16" />
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-[5px] text-[10.5px] text-[#b3303f]">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-1 flex flex-wrap items-center justify-between gap-2 text-[11.5px]">
                            <label class="inline-flex cursor-pointer items-center gap-2 text-[#4a3a3f]">
                                <input type="checkbox" name="remember" value="1" checked class="m-0 size-3.5 accent-wine-dark">
                                <span>Remember me for 30 days</span>
                            </label>
                            <a href="#" class="link-strong text-[11.5px]">Forgot your password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">
                            Sign In to Workspace <x-icon name="arrow-right" :size="14" />
                        </button>
                    </form>

                    <div class="mb-3 mt-4 flex items-center gap-3 text-[9px] font-semibold uppercase tracking-[.12em] text-muted-2 before:h-px before:flex-1 before:bg-line after:h-px after:flex-1 after:bg-line">
                        <span>Or continue with</span>
                    </div>

                    <div class="grid grid-cols-1 gap-2.5 min-[420px]:grid-cols-2">
                        <button type="button" class="btn-social"><x-icon name="google" :size="15" /> Google Workspace</button>
                        <button type="button" class="btn-social"><x-icon name="apple" :size="15" /> Apple ID</button>
                    </div>

                    <p class="mt-[18px] text-center text-[11.5px] text-muted">Don't have an account yet?
                        <a href="{{ route('portal.index') }}" class="link-strong">Create an Account</a>
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-3">
                    <span class="pill bg-[#f0e6e4] px-3 py-[7px] text-[10px]"><x-icon name="headset" :size="12" /><span>Concierge Hotline: <strong class="font-bold text-ink">+94 11 750 2025</strong></span></span>
                    <span class="inline-flex items-center gap-1.5 text-[9.5px] text-muted"><x-icon name="lock" :size="12" /><span>256-bit SSL Bank-Grade Encryption &bull; GDPR &amp; Privacy Compliant</span></span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    });
</script>
@endpush
