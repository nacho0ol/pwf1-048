<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product List') }}
            </h2>
            <a href="{{ route('product.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                + Add Product
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 uppercase font-semibold text-sm">#</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Quantity</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Price</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $product->name }}</td>
                                <td class="py-3 px-4">{{ $product->qty }}</td>
                                <td class="py-3 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center flex justify-center space-x-2">
                                    <a href="{{ route('product.show', $product->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                    <a href="{{ route('product.edit', $product->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">No products found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>