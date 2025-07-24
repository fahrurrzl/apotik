<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-3 bg-green-500 text-white rounded-md mb-3">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($products as $product)
                        <div class="mb-4">
                            <div class="flex mb-4 gap-2">
                                <div>
                                    <img src="{{ Storage::url($product->photo) }}"
                                        class="w-20 h-20 rounded-md shrink-0 object-cover">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2>{{ $product->title }}</h2>
                                    <p class="text-lg text-gray-500">
                                        {{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @if (!$product->comments->contains('user_id', auth()->user()->id))
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                    <textarea name="comment" id="comment"
                                        class="w-full h-20 rounded-md border border-gray-200 p-2 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"
                                        placeholder="Comment"></textarea>
                                    @error('comment')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @error('system_error')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="py-2 px-4 rounded-md bg-blue-500 text-white">Comment</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
