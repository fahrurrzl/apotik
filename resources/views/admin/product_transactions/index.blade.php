<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Apotik Orders') : __('My Transactions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">

                    @forelse ($product_transactions as $transaction)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-neutral-300">
                                    Total Transaksi
                                </p>
                                <p class="text-neutral-100 font-bold text-xl">
                                    {{ 'Rp. ' . number_format($transaction->total_amount, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-neutral-300">
                                    Date
                                </p>
                                <p class="text-neutral-100 font-bold text-xl">
                                    {{ $transaction->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <span
                                class="py-1 px-3 rounded-full {{ $transaction->is_paid == 0 ? 'bg-orange-500' : ($transaction->is_paid == 1 ? 'bg-green-500' : ($transaction->is_paid == 2 ? 'bg-blue-500' : ($transaction->is_paid == 3 ? 'bg-gray-500' : 'bg-red-500'))) }} text-sm">
                                <p class="text-white">
                                    {{ $transaction->is_paid == 0 ? 'PENDING' : ($transaction->is_paid == 1 ? 'PROOF ORDER' : ($transaction->is_paid == 2 ? 'SEND' : ($transaction->is_paid == 3 ? 'COMPLETED' : 'CANCEL'))) }}
                                </p>
                            </span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('product-transactions.show', $transaction) }}"
                                    class="py-2 px-4 rounded-full bg-blue-500 text-white">View Details</a>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center">
                            <p class="font-bold text-xl text-center">Products is empty</p>
                        </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
