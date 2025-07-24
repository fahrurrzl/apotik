<x-front.layout>
    <x-front.detail.topbar />

    <img src="{{ Storage::url($product->photo) }}" class="h-[220px] w-auto mx-auto relative z-10" alt="">
    <section class="bg-white rounded-t-[60px] pt-[60px] px-6 pb-5 -mt-9 flex flex-col gap-5 max-w-[425px] mx-auto">
        <div>
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <p class="font-bold text-[22px]">
                        {{ $product->title }}
                    </p>
                    <div class="flex items-center gap-1.5">
                        <img src="{{ Storage::url($product->category->icon) }}" class="size-[30px]" alt="">
                        <p class="font-semibold text-balance">
                            {{ $product->category->name }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('assets/svgs/star.svg') }}" class="size-6" alt="">
                    <p class="font-semibold text-balance">
                        4.5/5
                    </p>
                </div>
            </div>
            <p class="mt-3.5 text-base leading-7">
                {{ $product->description }}
            </p>
        </div>

        <div id="featureSlider" class="-mx-6">
            <!-- Popular -->
            <div
                class="w-[98px] border border-[#f1f1fa] rounded-2xl p-3.5 flex flex-col gap-2.5 items-center justify-center mr-4">
                <img src="{{ asset('assets/svgs/ic-cup-filled.svg') }}" class="size-10" alt="">
                <p class="text-sm font-semibold">
                    Popular
                </p>
            </div>
            <!-- Grade A -->
            <div
                class="w-[98px] border border-[#f1f1fa] rounded-2xl p-3.5 flex flex-col gap-2.5 items-center justify-center mr-4">
                <img src="{{ asset('assets/svgs/ic-thumb-shape-filled.svg') }}" class="size-10" alt="">
                <p class="text-sm font-semibold">
                    Grade A
                </p>
            </div>
            <!-- Healthy -->
            <div
                class="w-[98px] border border-[#f1f1fa] rounded-2xl p-3.5 flex flex-col gap-2.5 items-center justify-center mr-4">
                <img src="{{ asset('assets/svgs/ic-clipboard-tick-filled.svg') }}" class="size-10" alt="">
                <p class="text-sm font-semibold">
                    Healthy
                </p>
            </div>
            <!-- Official -->
            <div
                class="w-[98px] border border-[#f1f1fa] rounded-2xl p-3.5 flex flex-col gap-2.5 items-center justify-center mr-4">
                <img src="{{ asset('assets/svgs/ic-shiled') }}-tick-filled.svg" class="size-10" alt="">
                <p class="text-sm font-semibold">
                    Official
                </p>
            </div>
        </div>

        <!-- user Reviews -->
        @foreach ($product->comments as $comment)
            <div class="flex flex-col gap-2">
                <p class="text-base leading-7">
                    {{ $comment->comment }}
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <img src="{{ $comment->user->photo ?? asset('assets/svgs/avatar.svg') }}" class="size-9"
                            alt="{{ $comment->user->name }}">
                        <p class="text-base font-semibold">
                            {{ $comment->user->name }}
                        </p>
                    </div>
                    {{-- <div class="flex">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                    </div> --}}
                </div>
            </div>
        @endforeach

        <!-- Price and Add to cart -->
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-0.5">
                <p class="text-lg min-[350px]:text-2xl font-bold">
                    {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                </p>
                <p class="text-sm text-grey">
                    /quantity
                </p>
            </div>
            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                @csrf
                <button type='submit'
                    class="inline-flex w-max text-white font-bold text-base bg-primary rounded-full px-[30px] py-3 justify-center items-center whitespace-nowrap">
                    Add to Cart
                </button>

            </form>
        </div>
    </section>
</x-front.layout>
