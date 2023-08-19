<?php

namespace App\Http\Controllers\Main;

use App\Tables\Permissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('main.permissions.index', ['permissions' => Permissions::class]);    
    }

    public function create()
    {
        return view('main.permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string']);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        Toast::title('Permission created successfully')->center()->backdrop()->autoDismiss(1);
        return to_route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('main.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, ['name' => 'required|string|min:3']);
        $permission->update(['name' => $request->name]);

        Toast::title('Permission berhasil di update!')->backdrop()->center()->autoDismiss(1);
        return to_route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Toast::title('Permission berhasil dihapus!')->backdrop()->center()->autoDismiss(1);
        return back();
    }
}
