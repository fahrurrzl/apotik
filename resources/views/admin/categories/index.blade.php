<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Categoreis') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="py-2 px-4 rounded-full bg-blue-500 text-white">
                Create New Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    @forelse ($categories as $category)
                        <div class="flex items-center justify-between">
                            <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}"
                                class="w-[50px] h-[50px]" />
                            <h2 class="font-bold text-xl dark:text-neutral-200">{{ $category->name }}</h2>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="py-2 px-4 rounded-full bg-blue-500 text-white">Edit</a>
                                <form method="post" action="{{ route('admin.categories.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="py-2 px-4 rounded-full bg-red-500 text-white">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center">
                            <p class="font-bold text-xl text-center">Categories is empty</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
