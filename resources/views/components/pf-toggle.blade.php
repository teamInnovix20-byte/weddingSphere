{{--
    On / off switch (pure Tailwind, no JavaScript needed).
    Usage:  <x-pf-toggle name="two_factor" label="Authenticator app" :checked="true" />
--}}
@props(['name' => null, 'label' => 'Toggle', 'checked' => false])
<label class="relative inline-flex shrink-0 cursor-pointer items-center">
    <input type="checkbox" @if ($name) name="{{ $name }}" @endif @checked($checked) class="peer sr-only" aria-label="{{ $label }}">
    <span class="h-[22px] w-10 rounded-full bg-[#dccfcc] transition duration-200 hover:brightness-95
                 peer-checked:bg-wine peer-focus-visible:ring-[3px] peer-focus-visible:ring-wine/25
                 after:absolute after:left-[3px] after:top-[3px] after:size-4 after:rounded-full after:bg-white
                 after:shadow after:transition after:duration-200 peer-checked:after:translate-x-[18px]"></span>
</label>
