<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Manajemen Role', only: ['index', 'edit', 'create', 'destroy'])
        ];
    }
    // Fungsi untuk menampilkan halaman role
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('roles.list', [
            'roles' => $roles
        ]);
    }

    // Fungsi untuk menampilkan halaman membuat role
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', [
            'permissions' => $permissions
        ]);
    }

    // Fungsi untuk menambah role baru ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('Success', 'Role berhasil ditambahkan');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }

    // Fungsi untuk menampilkan halaman edit role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('roles.edit', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    // Fungsi untuk update nama role
    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id'
        ]);

        if ($validator->passes()) {

            $role->name = $request->name;
            $role->save();

            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermission([]);
            }

            return redirect()->route('roles.index')->with('Success', 'Role berhasil diperbarui');
        } else {
            return redirect()->route('roles.edit', $id)->withInput()->withErrors($validator);
        }
    }

    // Fungsi untuk menghapus role 
    public function destroy(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);

        if ($role == null) {
            return response()->json([
                'status' => false,
                'message' => 'Role tidak ditemukan'
            ]);
        }

        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Role berhasil dihapus'
        ]);
    }
}
