{{--
    Round profile picture for the header (top-right corner).
    - logged in + uploaded a photo  -> shows the photo
    - otherwise                     -> shows the default gradient circle with the user icon
    The photo URL comes from App\Models\User::profile_photo_url
--}}
@php
    $user = auth()->user();
    $photo = $user?->profile_photo_url;
    $label = $user ? 'Profile of '.$user->name : 'Profile';
@endphp

<span {{ $attributes->class(['inline-flex size-9 shrink-0 items-center justify-center overflow-hidden rounded-full border-2 border-white
        bg-gradient-to-br from-[#d9a37f] to-[#8a4a5e] text-white shadow-[0_1px_4px_rgba(92,19,46,.25)]
        transition duration-200 hover:scale-110 hover:shadow-[0_3px_10px_rgba(92,19,46,.35)]']) }}
      title="{{ $label }}">
    @if ($photo)
        <img src="{{ $photo }}" alt="{{ $label }}" class="size-full object-cover">
    @else
        <x-icon name="user" :size="18" />
    @endif
</span>
