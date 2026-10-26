{{--
    Shared frame for the Profile & Settings pages:
    [ left sidebar ] + [ page content ]
    The header + footer + page glow come from layouts/app.blade.php (Member 1).

    A page that uses this frame looks like:
        @extends('layouts.account')
        @section('title', 'My page - WeddingSphere')
        @section('account')   ...page content...   @endsection
--}}
@extends('layouts.app')

@section('content')
<div class="ws-container pb-12 pt-5 lg:pt-7">
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[210px_minmax(0,1fr)] lg:items-start lg:gap-6">
        @include('partials.account-sidebar')

        <div class="min-w-0">
            @yield('account')
        </div>
    </div>

    {{-- small message that pops up at the bottom (used by the "demo only" buttons) --}}
    <div id="ws-toast" role="status" aria-live="polite"
         class="pointer-events-none fixed bottom-6 left-1/2 z-50 max-w-[calc(100%-32px)] -translate-x-1/2 translate-y-3 rounded-full bg-wine-dark px-5 py-2.5 text-[12px] font-medium text-white opacity-0 shadow-lg shadow-wine/30 transition duration-300"></div>
</div>
@endsection

@push('scripts')
<script>
    // Toast + "demo" forms (no backend yet: the form just shows a message instead of saving)
    (function () {
        var toast = document.getElementById('ws-toast');
        var timer;

        window.wsToast = function (message) {
            toast.textContent = message;
            toast.classList.remove('opacity-0', 'translate-y-3');
            clearTimeout(timer);
            timer = setTimeout(function () {
                toast.classList.add('opacity-0', 'translate-y-3');
            }, 2800);
        };

        document.querySelectorAll('form[data-demo]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                window.wsToast(form.dataset.demo);
            });
        });

        document.querySelectorAll('[data-toast]').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                window.wsToast(el.dataset.toast);
            });
        });
    })();
</script>
@endpush
