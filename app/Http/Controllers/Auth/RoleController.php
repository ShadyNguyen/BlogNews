<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Role::orderBy('id','DESC')->get();
        return view('admin.roles.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Role::all();
        return view('admin.roles.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:roles|max:255',
                
            ],
            [
                'name.unique' => 'Role đã có ,xin điền tên khác',
                'name.required' => 'Vui lòng điền tên !',
                
            ]
        );

        $role = new Role();
        $role->name = $data['name'];
        $role->save();
        toastr()->success('Thành công', 'Thêm Role thành công.');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $list = Role::all();
        return view('admin.roles.form',compact('role','list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:roles|max:255',
                
            ],
            [
                'name.unique' => 'Role đã có ,xin điền tên khác',
                'name.required' => 'Vui lòng điền tên !',
                
            ]
        );

        $role = Role::find($id);
        $role->name = $data['name'];
        $role->save();
        toastr()->success('Thành công', 'Thêm Role thành công.');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        toastr()->info('Thành công', 'Xoá Role thành công.');
        return redirect()->route('roles.index');
    }
}
