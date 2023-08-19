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
                    <x-splade-form :default="$role" class="w-full space-y-3" action="{{ route('roles.store_give_permission', $role->id) }}">
                        <x-splade-input name="name" readonly :label="__('Role')" class="mb-3"/>  
                        <label for="permission">Role Permission</label>
                        @if ($permissions->count() > 0)
                        <x-splade-select name="permission[]" :options="$permissions" multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}" >{{ $permission->name }}</option>    
                            @endforeach
                        </x-splade-select>
                        @else
                        <p class="text-center text-xl bg-red-100 rounded p-5 text-red-600 font-semibold">Permission belum ada!</p>
                        @endif
                        <div class="py-2 space-x-2">
                            @if ($role->permissions)
                                @foreach ($role->permissions as $role_permission)
                                    <Link href="{{ route('roles.remove_permission', [$role->id, $role_permission->id]) }}"  class="px-4 py-2 bg-red-400 rounded-md" confirm method="DELETE">{{ $role_permission->name }}</Link>
                                @endforeach
                            @endif
                        </div>
                        <div class="flex justify-between items-center">
                            <Link href="{{ route('roles.index') }}" class="px-4 py-2 bg-slate-600 text-white rounded">Kembali</Link>
                            <x-splade-submit :label="__('Give')" />
                        </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>