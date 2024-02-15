<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $list = Role::all();
        return view('admin.roles.index', compact('list'));
    }

    public function create()
    {
        $list = Role::all();
        return view('admin.roles.form', compact('list'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'min:3']
            ],
            [
                'name.required' => 'Role là bắt buộc.',
                'name.string' => 'Role phải là một chuỗi ký tự.',
                'name.min' => 'Role phải có ít nhất 3 ký tự.'
            ]
        );

        $role = new Role();
        $role->name = $data['name'];
        $role->save();
        toastr()->success('Thành công', 'Thêm Role thành công.');
        return redirect()->route('roles.index');
    }
    public function edit($id)
    {
        $list = Role::all();
        $role = Role::find($id);
        return view('admin.roles.form', compact('role', 'list'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'min:3']
            ],
            [
                'name.required' => 'Role là bắt buộc.',
                'name.string' => 'Role phải là một chuỗi ký tự.',
                'name.min' => 'Role phải có ít nhất 3 ký tự.'
            ]
        );

        $role = Role::find($id);
        $role->name = $data['name'];
        $role->save();
        toastr()->success('Thành công', 'Cập nhật Role thành công.');
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }

    public function givePermission(Request $request, Role $role)
    {
        $role->permissions()->detach();
        $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name');
        $role->givePermissionTo($permissions);
        return back()->with('message', 'Cập nhật permission cho roles thành công');
    }
}
