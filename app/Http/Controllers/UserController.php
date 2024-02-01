<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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

    public function profileUser()
    {
        return view('admin.users.profile');
    }

    public function pwdUser()
    {
        return view('admin.users.pwd');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $data = $request->all();
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        $get_image = $request->file('avatar');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/avt/', $new_image);
            $user->avatar = $new_image;
        }
        $user->save();
        toastr()->success('Cập nhật thông tin thành công!');

        return view('admin.users.profile');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_pwd' => 'required',
            'new_pwd' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();
        $user = User::find($id);

        if (!Hash::check($data['old_pwd'], $user->password)) {
            return back()->withErrors(['old_pwd' => 'Mật khẩu hiện tại không đúng']);
        }

        // Sử dụng $request->new_pwd thay vì $request->new_password
        $user->password = Hash::make($request->new_pwd);
        $user->save();

        toastr()->success('Đổi mật khẩu thành công!');
        return back();
    }
}
