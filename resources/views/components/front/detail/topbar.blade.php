<section class="relative flex items-center justify-between gap-5 wrapper">
    <a href="{{ route('front.index') }}" class="p-2 bg-white rounded-full">
        <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
    </a>
    <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
        {{ isset($title) ? $title : 'Details' }}
    </p>
    <button type="button" class="p-2 bg-white rounded-full">
        <img src="{{ asset('assets/svgs/ic-triple-dots.svg') }}" class="size-5" alt="">
    </button>
</section>
