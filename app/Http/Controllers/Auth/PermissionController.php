<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class PermissionController extends Controller
{
    public function show($id){
        $roles = Role::all();
        $permission = Permission::find($id);
        // $user = User::all();
        $all_roles = Role::all();
        return view('admin.permissions.show',compact('permission', 'roles','all_roles'));
    }
    public function index()
    {
        $list = Permission::all();
        return view('admin.permissions.index', compact('list'));
    }


    public function create()
    {
        $list = Permission::all();
        return view('admin.permissions.form', compact('list'));
    }
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'min:3']
            ],
            [
                'name.required' => 'permission là bắt buộc.',
                'name.string' => 'permission phải là một chuỗi ký tự.',
                'name.min' => 'permission phải có ít nhất 3 ký tự.'
            ]
        );

        $permission = new Permission();
        $permission->name = $data['name'];
        $permission->save();
        toastr()->success('Thành công', 'Thêm permission thành công.');
        return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        $list = Permission::all();
        $permission = Permission::find($id);
        return view('admin.permissions.form', compact('permission', 'list'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'min:3']
            ],
            [
                'name.required' => 'Permission là bắt buộc.',
                'name.string' => 'permission phải là một chuỗi ký tự.',
                'name.min' => 'permission phải có ít nhất 3 ký tự.'
            ]
        );

        $permission = Permission::find($id);
        $permission->name = $data['name'];
        $permission->save();
        toastr()->success('Thành công', 'Cập nhật permission thành công.');
        return redirect()->route('permissions.index');
    }


    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        toastr()->success('Thành công', 'Xoá permission thành công.');
        return redirect()->route('permissions.index');
    }

    public function assignRole(Request $request, $id)
    {
        $data = $request->all();
        $role = Role::all();
        $permission = Permission::find($id);
        $role->givePermissionTo($data['role']);
        toastr()->success('Phân Quyền', 'Phân perrmissions vào roles thành công.');
        return redirect()->route('users.index');
    }
}
