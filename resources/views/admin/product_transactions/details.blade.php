<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Apotik Orders') : __('My Transactions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-neutral-300">
                                Total Transaksi
                            </p>
                            <p class="text-neutral-100 font-bold text-xl">
                                {{ 'Rp. ' . number_format($product_transaction->total_amount, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-300">
                                Date
                            </p>
                            <p class="text-neutral-100 font-bold text-xl">
                                {{ $product_transaction->created_at->format('d F Y') }}
                            </p>
                        </div>
                        <span
                            class="py-1 px-3 rounded-full {{ $product_transaction->is_paid === 0 ? 'bg-orange-500' : 'bg-green-500' }} text-sm">
                            <p class="text-white">
                                {{ $product_transaction->is_paid === 0 ? 'PENDING' : 'SUCCESS' }}
                            </p>
                        </span>
                    </div>
                    <hr class="my-4">

                    <div class="grid grid-cols-5 gap-10">
                        <div class="flex flex-col gap-3 col-span-3">
                            @forelse ($product_transaction->transaction_details as $detail)
                                <div class="flex items-center justify-between">
                                    <div class="flex gap-4">
                                        <img src="{{ Storage::url($detail->product->photo) }}"
                                            alt="{{ $detail->product->title }}" class="w-[50px] h-[50px]" />
                                        <div>
                                            <h2 class="font-bold dark:text-neutral-200">{{ $detail->product->title }}
                                            </h2>
                                            <p class="text-gray-500 text-lg font-bold">
                                                {{ 'Rp. ' . number_format($detail->product->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <p>{{ $detail->product->category->name }}</p>
                                </div>
                            @empty
                                <p class="font-bold text-lg text-center">Product is empty.</p>
                            @endforelse

                            <div class="space-y-4">
                                <h3 class="font-bold text-xl mb-3">Details of Delevery</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-neutral-400">
                                        Address
                                    </p>
                                    <p class="text-neutral-100 font-bold">
                                        {{ $product_transaction->address }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-neutral-400">
                                        City
                                    </p>
                                    <p class="text-neutral-100 font-bold">
                                        {{ $product_transaction->city }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-neutral-400">
                                        Post Code
                                    </p>
                                    <p class="text-neutral-100 font-bold">
                                        {{ $product_transaction->post_code }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-neutral-400">
                                        Phone Number
                                    </p>
                                    <p class="text-neutral-100 font-bold">
                                        {{ $product_transaction->phone_number }}
                                    </p>
                                </div>
                                <div class="flex items-start flex-col">
                                    <p class="text-neutral-400">
                                        Notes
                                    </p>
                                    <p class="text-neutral-100 font-bold">
                                        {{ $product_transaction->notes }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-span-2">
                            <h3 class="font-bold text-xl mb-3 text-end">Proof of Payment: </h3>
                            <img src="{{ Storage::url($product_transaction->prof) }}"
                                alt="{{ $product_transaction->prof }}" class="w-80 h-80" />
                        </div>
                    </div>
                    <hr class="my-3">
                    <div>
                        @if (Auth::user()->hasRole('owner'))
                            @if ($product_transaction->is_paid === 0)
                                <form method="POST"
                                    action="{{ route('product-transactions.update', $product_transaction) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="py-2 px-4 rounded-full bg-blue-500 text-white">Proof Order</button>
                                </form>
                            @else
                                <button class="py-2 px-4 rounded-full bg-green-500 text-white">WhatsApp
                                    Customer</button>
                            @endif
                        @else
                            <button class="py-2 px-4 rounded-full bg-blue-500 text-white">Contact Admin</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
