<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Category List</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your category</p>
            </div>
            <!-- Tombol Add Category -->
            <a href="{{ route('category.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-4 uppercase font-semibold text-sm">#</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Total Product</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $category->name }}</td>
                                <!-- Menampilkan jumlah produk dari relasi -->
                                <td class="py-3 px-4">{{ $category->products_count }}</td>
                                <td class="py-3 px-4 text-center">
                                    <a href="#" class="text-blue-500 hover:text-blue-700">Edit</a> | 
                                    <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">Belum ada kategori.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>