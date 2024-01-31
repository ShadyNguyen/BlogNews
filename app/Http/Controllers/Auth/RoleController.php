<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'min:3']
            ],
            [
                'name.required' => 'Role là bắt buộc.',
                'name.string' => 'Role phải là một chuỗi ký tự.',
                'name.min' => 'Role phải có ít nhất 3 ký tự.'
            ]
        );

        Role::create($validated);

        return view('admin.roles.index')->with('message', 'Thêm role thành công');
    }
    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string']
            ],
            [
                'name.required' => 'Role là bắt buộc.',
                'name.string' => 'Role phải là một chuỗi ký tự.',
            ]
        );

        $role->update($validated);
        return view('admin.roles.index')->with('message', 'Sửa role thành công');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('message', 'Role được xoá thành công');
    }

    public function givePermission(Request $request, Role $role)
    {
        $role->permissions()->detach();
        $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name');
        $role->givePermissionTo($permissions);
        return back()->with('message', 'Cập nhật permission cho roles thành công');
    }
}
