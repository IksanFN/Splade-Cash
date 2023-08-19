<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use App\Models\Role;
use App\Tables\Roles;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('main.roles.index', [
            'roles' => Roles::class,
        ]);
    }

    public function givePermission(Role $role)
    {
        // Get data permission
        $permissions = Permission::all();
        return view('main.roles.give-permission', compact('role', 'permissions'));
    }

    // Function untuk memberikan permission kepada role
    public function storeGivePermission(Request $request, Role $role)
    {
        // Cek permission yang ada di role
       if ($request->has('permission')) {
            foreach ($request->permission as $value) {
                if ($role->hasPermissionTo($value)) {
                    // Jika permission sudah ada pada suatu role
                    Toast::warning('Gagal! Permission sudah ada')->autoDismiss(1)->center()->backdrop();
                    return back();
                }
                
                // Jika permission belum ada pada role
                $role->givePermissionTo($request->permission);
                Toast::title('Permission berhasil di berikan')->backdrop()->center()->autoDismiss(1);
                return back();
            }
       }
    }

    public function removePermission(Role $role, Permission $permission)
    {
        // Cek permission pada role
        if ($role->hasPermissionTo($permission)) {
            // Jika permission ada pada role
            $role->revokePermissionTo($permission);
            Toast::title('Permission berhasil dihapus')->center()->backdrop()->autoDismiss(1);
            return back();
        }

        // Jika permission tidak ada pada role
        Toast::warning('Permission tidak ada')->center()->backdrop()->autoDismiss(3);
        return back();
    }

    public function create()
    {
        return view('main.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|min:4']);
        Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        Toast::title('Role created successfull')->backdrop()->center()->autoDismiss(1);
        return to_route('roles.index');
    }

    public function edit(Role $role)
    {
        return view('main.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, ['name' => 'required|string|min:3']);
        $role->update(['name' => $request->name]);
-
        Toast::title('Role berhasil di update!')->center()->backdrop()->autoDismiss(1);
        return to_route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Toast::title('Role berhasil dihapus!')->center()->backdrop()->autoDismiss(1);
        return back();
    }
}
