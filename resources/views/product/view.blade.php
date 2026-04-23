<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('product.index') }}" class="text-gray-500 hover:text-gray-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">
                        Product Detail
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Viewing product #{{ $product->id }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                @can('update', $product)
                    <x-edit-button :url="route('product.edit', $product->id)" />
                @endcan

                @can('delete', $product)
                    <x-delete-button :url="route('product.delete', $product->id)" />
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#1e2336] rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="divide-y divide-gray-200 dark:divide-gray-700/50">
                    
                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-500 dark:text-gray-400">Product Name</div>
                        <div class="w-2/3 font-semibold text-gray-900 dark:text-gray-100 text-lg">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-500 dark:text-gray-400">Quantity</div>
                        <div class="w-2/3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100/10 text-green-500 border border-green-500/20">
                                {{ $product->qty }} In Stock
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-500 dark:text-gray-400">Price</div>
                        <div class="w-2/3 font-bold text-gray-900 dark:text-gray-100 text-lg">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-500 dark:text-gray-400">Owner</div>
                        <div class="w-2/3 flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold uppercase">
                                {{ substr($product->user->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="text-gray-900 dark:text-gray-100 font-medium">
                                {{ $product->user->name ?? 'Unknown' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-500 dark:text-gray-400">Created At</div>
                        <div class="w-2/3 text-gray-900 dark:text-gray-300">
                            {{ $product->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-500 dark:text-gray-400">Updated At</div>
                        <div class="w-2/3 text-gray-900 dark:text-gray-300">
                            {{ $product->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>