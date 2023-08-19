<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$years">
                <x-splade-cell actions as="$year">
                    <Link class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md shadow-md shadow-indigo-200 mr-3">Edit</Link>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>