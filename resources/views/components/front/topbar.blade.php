    <section class="flex items-center justify-between gap-5 wrapper">
        <div class="flex items-center gap-3">
            @if (Auth::user())
                <div class="bg-white rounded-full p-[5px] flex justify-center items-center">
                    <img src="{{ asset('assets/svgs/avatar.svg') }}" class="size-[50px] rounded-full" alt="">
                </div>
            @endif
            <div class="">
                <p class="text-base font-semibold capitalize text-primary">
                    {{ Auth::user() ? auth()->user()->name : '' }}
                </p>
                <p class="text-sm">
                    {{ Auth::user() ? auth()->user()->roles->first()->name : '' }}
                </p>
            </div>
        </div>
        <div class="flex items-center gap-[10px]">
            <button type="button" class="p-2 bg-white rounded-full">
                <span class="relative">
                    <!-- notification -->
                    <img src="{{ asset('assets/svgs/ic-notification.svg') }}" class="size-5" alt="">
                    <!-- notification dot -->
                    <span class="block rounded-full size-1.5 bg-primary absolute top-0 right-0 -translate-x-1/2"></span>
                </span>
            </button>
            <a href="{{ route('cart.index') }}" type="button" class="p-2 bg-white rounded-full">
                <span class="relative">
                    <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-5" alt="">
                    @if (Auth::user() && auth()->user()->carts->count() > 0)
                        <span
                            class="flex items-center justify-center text-white text-xs rounded-full size-5 bg-primary absolute top-0 right-0 translate-x-1/2">{{ Auth::user() ? auth()->user()->carts->count() : '' }}</span>
                    @endif
                </span>
            </a>
        </div>
    </section>
