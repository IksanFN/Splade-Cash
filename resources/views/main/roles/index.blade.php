<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white mb-3 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end px-7 py-6 bg-white border-b border-gray-200">
                    
                    <Link modals href="{{ route('roles.create') }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">New Role</Link>
                </div>
            </div>
        </div>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-6">
            <x-splade-table :for="$roles">
                <x-splade-cell actions as="$role">
                    <Link href="{{ route('roles.give_permission', $role->id) }}" class="px-4 py-2 bg-green-400 hover:bg-green-600 text-white rounded-md shadow-md shadow-indigo-200 mr-3">Give Permission</Link>
                    <Link href="{{ route('roles.edit', $role->id) }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md shadow-md shadow-indigo-200 mr-3">Edit</Link>
                    <Link href="{{ route('roles.destroy', $role->id) }}" method="DELETE" confirm="Hapus Role" confirm-text="Apakah kamu yakin akan menghapusnya?" confirm-button="Ya, Hapus" cancel-button="Batal" class="px-4 py-2 bg-red-400 hover:bg-red-600 text-white rounded-md shadow-md shadow-indigo-200 mr-3">Delete</Link>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>