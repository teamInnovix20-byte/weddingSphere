{{--
    Background picture holder.

    Put it as the FIRST child of a container that has `relative overflow-hidden group`.
    Drop your picture into public/images/ and pass the path:

        <div class="relative overflow-hidden group">
            <x-bg-image src="images/login-hero.jpg" overlay="bg-white/70" />
            <div class="relative z-10"> ...your content... </div>
        </div>

    - If the picture file does not exist the whole holder removes itself,
      so the container keeps its normal colours until you add the picture.
    - The picture zooms in slowly when the parent (class "group") is hovered.
    - `overlay` = optional Tailwind classes for a colour layer on top of the picture
      (keeps the text readable), e.g. "bg-wine-dark/60".
--}}
@props(['src', 'overlay' => null])

<div {{ $attributes->class(['pointer-events-none absolute inset-0 overflow-hidden']) }} aria-hidden="true">
    <img src="{{ asset($src) }}" alt="" loading="lazy"
         class="size-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
         onerror="this.parentElement.remove()">
    @if ($overlay)
        <div class="absolute inset-0 {{ $overlay }}"></div>
    @endif
</div>
