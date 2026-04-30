<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Dashboard</h3>
            <div class="bg-[#1e2336] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 text-lg">
                    Role: {{ ucfirst(Auth::user()->role) }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>