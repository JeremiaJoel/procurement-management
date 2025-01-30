<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:Manajemen Menu', only: ['index', 'edit', 'create', 'destroy'])
        ];
    }

    //Untuk menampilkan page Permissions
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('permissions.list', [
            'permissions' => $permissions
        ]);
    }

    //Untuk menampilkan page create permission
    public function create()
    {
        return view('permissions.create');
    }

    //Untuk insert Permission ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);
        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('Success', 'Hak akses baru berhasil dibuat');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }


    //Untuk menampilkan page edit permission
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    //Untuk update permission ke database
    public function update($id, Request $request)
    {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id'
        ]);

        if ($validator->passes()) {

            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('Success', 'Hak akses telah diperbarui');
        } else {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }
    }


    //Untuk menghapus permission dari database
    public function destroy(Request $request)
    {
        $id = $request->id;

        $permission = Permission::find($id);

        if ($permission == null) {
            return response()->json([
                'status' => false,
                'message' => 'Hak akses tidak ditemukan'
            ]);
        }

        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hak akses berhasil dihapus'
        ]);
    }
}
