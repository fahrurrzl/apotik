<x-front.layout>
    <!-- Topbar -->
    <x-front.cart.topbar />

    <!-- Items -->
    <section class="wrapper flex flex-col gap-2.5">
        @if ($errors->any())
            <div class="p-3 my-2 bg-white rounded-xl">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>
                            <p class="text-red-500 font-semibold">{{ $message }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Items
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="itemsList">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}"
                    class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <div class="flex flex-col gap-4" id="itemsList">
            @forelse ($carts as $cart)
                <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative">
                    <img src="{{ Storage::url($cart->product->photo) }}"
                        class="w-full max-w-[70px] max-h-[70px] object-contain" alt="">
                    <div class="flex flex-wrap items-center justify-between w-full gap-1">
                        <div class="flex flex-col gap-1">
                            <h3 href="details.html"
                                class="text-base font-semibold whitespace-nowrap w-[150px] truncate">
                                {{ $cart->product->title }}
                            </h3>
                            <p class="text-sm text-grey product-price" data-price="{{ $cart->product->price }}">
                                Rp. {{ number_format($cart->product->price) }}
                            </p>
                        </div>
                        <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ asset('assets/svgs/ic-trash-can-filled.svg') }}" class="size-[30px]"
                                    alt="">
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="font-bold text-xl text-center">Cart is empty</p>
            @endforelse

        </div>
    </section>

    <!-- Details Payment -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Details Payment
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="__detailsPayment">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 size-5"
                    alt="">
            </button>
        </div>
        <div class="p-6 bg-white rounded-3xl" id="__detailsPayment" style="display: none;">
            <ul class="flex flex-col gap-5">
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Sub Total
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="subTotal">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        PPN 11%
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="ppn">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Insurance 23%
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="insurance">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-semibold first:font-normal">
                        Delivery (Promo)
                    </p>
                    <p class="text-base font-semibold first:font-normal" id="delivery">

                    </p>
                </li>
                <li class="flex items-center justify-between">
                    <p class="text-base font-bold first:font-normal">
                        Grand Total
                    </p>
                    <p class="text-base font-bold first:font-normal text-primary" id="grandTotal">

                    </p>
                </li>
            </ul>
        </div>
    </section>

    <!-- Payment Method -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Payment Method
            </p>
        </div>
        <div class="grid items-center grid-cols-2 gap-4">
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <input type="radio" name="payment_method" id="manualMethod" class="absolute opacity-0">
                <img src="{{ asset('assets/svgs/ic-receipt-text-filled.svg') }}" alt="">
                <p class="text-base font-semibold">
                    Manual
                </p>
            </label>
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <input type="radio" name="payment_method" id="creditMethod" class="absolute opacity-0">
                <img src="{{ asset('assets/svgs/ic-card-filled.svg') }}" alt="">
                <p class="text-base font-semibold">
                    Credits
                </p>
                </lab>
        </div>
        <div class="p-4 mt-0.5 bg-white rounded-3xl hidden" id="manualPaymentDetail">
            <div class="flex flex-col gap-5">
                <p class="text-base font-bold">
                    Send Payment to
                </p>
                <div class="inline-flex items-center gap-2.5">
                    <img src="{{ asset('assets/svgs/ic-bank.svg') }}" class="size-5" alt="">
                    <p class="text-base font-semibold">
                        Bank Parma Fahrur
                    </p>
                </div>
                <div class="inline-flex items-center gap-2.5">
                    <img src="{{ asset('assets/svgs/ic-security-card.svg') }}" class="size-5" alt="">
                    <p class="text-base font-semibold">
                        22222222
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery to -->
    <section class="wrapper flex flex-col gap-2.5 pb-40">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Delivery to
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="deliveryForm">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}"
                    class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <form enctype="multipart/form-data" action="{{ route('product-transactions.store') }}" method="POST"
            class="p-6 bg-white rounded-3xl" id="deliveryForm">
            @csrf
            <div class="flex flex-col gap-5">
                <!-- Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="address" class="text-base font-semibold">Address</label>
                    <input style="background-image: url({{ asset('assets/svgs/ic-location.svg') }})" type="text"
                        name="address" id="address__" class="form-input">
                </div>
                <!-- City -->
                <div class="flex flex-col gap-2.5">
                    <label for="city" class="text-base font-semibold">City</label>
                    <input style="background-image: url({{ asset('assets/svgs/ic-map.svg') }})" type="text"
                        name="city" id="city__" class="form-input">
                </div>
                <!-- Post Code -->
                <div class="flex flex-col gap-2.5">
                    <label for="postcode" class="text-base font-semibold">Post Code</label>
                    <input style="background-image: url({{ asset('assets/svgs/ic-house.svg') }})" type="number"
                        name="post_code" id="postcode__" class="form-input">
                </div>
                <!-- Phone Number -->
                <div class="flex flex-col gap-2.5">
                    <label for="phonenumber" class="text-base font-semibold">Phone Number</label>
                    <input style="background-image: url({{ asset('assets/svgs/ic-phone.svg') }})" type="number"
                        name="phone_number" id="phonenumber__" class="form-input">
                </div>
                <!-- Add. Notes -->
                <div class="flex flex-col gap-2.5">
                    <label for="notes" class="text-base font-semibold">Add. Notes</label>
                    <span class="relative">
                        <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4"
                            alt="">
                        <textarea name="notes" id="notes__" class="form-input !rounded-2xl w-full min-h-[150px]"></textarea>
                    </span>
                </div>
                <!-- Proof of Payment -->
                <div class="flex flex-col gap-2.5">
                    <label for="proof_of_payment" class="text-base font-semibold">Proof of Payment</label>
                    <input style="background-image: url({{ asset('assets/svgs/ic-folder-add.svg') }})" type="file"
                        name="prof" id="proof_of_payment__" class="form-input">
                </div>
            </div>
            </div>

    </section>

    <!-- Floating grand total -->
    <div
        class="fixed z-50 bottom-[30px] bg-black rounded-3xl p-5 left-1/2 -translate-x-1/2 w-[calc(100dvw-32px)] max-w-[425px]">
        <section class="flex items-center justify-between gap-5">
            <div>
                <p class="text-sm text-grey mb-0.5">
                    Grand Total
                </p>
                <p class="text-lg min-[350px]:text-2xl font-bold text-white" id="floating-grand-total">

                </p>
            </div>
            <button type="submit"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full w-max bg-primary whitespace-nowrap"
                onclick="window.location.href='/public/pages/success-checkout.html'">
                Confirm
            </button>
        </section>
    </div>
    </form>

    <script>
        function toRupiah(number) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(
                number)
        }

        function calculatePrice() {

            let subTotal = 0;
            let delivery = 10000;

            document.querySelectorAll('.product-price').forEach(item => {
                subTotal += parseInt(item.getAttribute('data-price'));
            })
            document.querySelector('#subTotal').textContent = toRupiah(subTotal)
            document.querySelector('#delivery').textContent = toRupiah(delivery)

            const tax = 11 * subTotal / 100;
            document.querySelector("#ppn").textContent = toRupiah(tax)

            const insurance = 23 * subTotal / 100;
            document.querySelector('#insurance').textContent = toRupiah(insurance)

            const grandTotal = subTotal + tax + insurance + delivery;
            document.querySelector('#grandTotal').textContent = toRupiah(grandTotal)
            document.querySelector('#floating-grand-total').textContent = toRupiah(grandTotal)
        }

        calculatePrice();
    </script>
</x-front.layout>
