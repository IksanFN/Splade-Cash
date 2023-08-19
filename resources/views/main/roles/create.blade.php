<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form class="w-full space-y-3" action="{{ route('roles.store') }}">
                        <x-splade-input id="name" type="text" name="name" :label="__('Name Role')" class="mb-3" required autofocus />
                        <div class="flex justify-end items-center">
                            <x-splade-submit :label="__('Create')" />
                        </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>