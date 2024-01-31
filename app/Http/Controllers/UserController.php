<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.show', compact('user', 'roles', 'permissions'));
    }

    public function givePermission(Request $request, User $user)
    {
        $user->permissions()->detach();
        $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name');
        $user->givePermissionTo($permissions);
        return back()->with('message', 'Cập nhật permission cho user thành công');
    }

    public function assignRole(Request $request, User $user)
    {
        $user->roles()->detach();
        if ($request->has('roles')) {
            foreach ($request->input('roles', []) as $roleId) {
                $role = Role::findById($roleId);
                if ($role) {
                    $user->assignRole($role);
                }
            }
        }
        return back()->with('message', 'Cập nhật roles cho user thành công');
    }

    public function profileUser(){
        return view('admin.users.profile');
    }

    public function pwdUser(){
        return view('admin.users.pwd');
    }
}
