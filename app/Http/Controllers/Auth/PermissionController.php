<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() : View {
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    public function create() : View {
        return view('admin.permission.create');

    }
    public function store(Request $request)
    {
        $validated = $request->validate(
            ['name'=>['required', 'string', 'min:3']
            ],
            [
            'name.required' => 'Permission là bắt buộc.',
            'name.string' => 'Permission phải là một chuỗi ký tự.',
            'name.min' => 'Permission phải có ít nhất 3 ký tự.'
            ]);

        Permission::create($validated);

        return view('admin.permissions.index')->with('message', 'Thêm permission thành công');
    }

    public function edit(Permission $permission) : View {
        $roles = Role::all();
        return view('admin.permission.edit', compact('permission','roles'));
    }

    public function update(Request $request,Permission $permission)  {
        $validated = $request->validate(
            ['name'=>['required', 'string']
            ],
            [
            'name.required' => 'Permission là bắt buộc.',
            'name.string' => 'Permission phải là một chuỗi ký tự.',
            ]);

        $permission->update($validated);
        return view('admin.permissions.index')->with('message', 'Sửa permission thành công');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return back()->with('message','Permission được xoá thành công');
    }

    public function assignRole(Request $request,Permission $permission)  {
        $permission->roles()->detach();
        if ($request->has('roles')) {
            foreach ($request->input('roles', []) as $roleId) {
                $role = Role::findById($roleId);
                if ($role) {
                    $permission->assignRole($role);
                }
            }
        }
        return back()->with('message', 'Cập nhật roles cho permission thành công');
    }
}
