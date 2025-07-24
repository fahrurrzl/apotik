<x-front.layout>
    <!-- Topbar -->
    <x-front.detail.topbar title="{{ $category->name . ' Products' }}" />

    <!-- Search Results -->
    <section class="wrapper flex flex-col gap-2.5">
        <p class="text-base font-bold">
            Results
        </p>
        <div class="flex flex-col gap-4">
            @forelse ($products as $product)
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative">
                    <img src="{{ Storage::url($product->photo) }}" class="w-full max-w-[70px] max-h-[70px] object-contain"
                        alt="">
                    <div class="flex flex-wrap items-center justify-between w-full gap-1">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('front.product.details', $product) }}"
                                class="text-base font-semibold stretched-link whitespace-nowrap w-[150px] truncate">
                                {{ $product->title }}
                            </a>
                            <p class="text-sm text-grey">
                                {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="flex">
                            <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                            <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                            <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                            <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                            <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-grey">No result</p>
            @endforelse
        </div>
    </section>
</x-front.layout>
