<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <div class="space-y-4">
                    <div>
                        <strong class="block text-gray-500 dark:text-gray-400">Product Name</strong>
                        <p class="text-lg">{{ $product->name }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-500 dark:text-gray-400">Quantity</strong>
                        <p class="text-lg">{{ $product->qty }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-500 dark:text-gray-400">Price</strong>
                        <p class="text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-500 dark:text-gray-400">Owner</strong>
                        <p class="text-lg">{{ $product->user->name ?? 'Unknown' }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('product.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>