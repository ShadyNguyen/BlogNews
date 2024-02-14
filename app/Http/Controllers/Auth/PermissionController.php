<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Permission::orderBy('id', 'asc')->get();
        return view('admin.permissions.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Permission::all();
        return view('admin.permissions.form', compact('list'));
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
                'name' => 'required|unique:permissions|max:255',
            ]
            ,[
                'name.required' => 'Vui lòng điền tên Permissin',
                'name.unique' => 'Đã có tên Permission này rồi,Vui lòng điền tên khác!',
                'name.max' => 'Bạn nhập quá kí tự cho phép!'   
            ]
        );

        $permission = new Permission();
        $permission->name = $data['name'];
        $permission->save();
        toastr()->success('Thành Công','Thêm Permission thành công!');
        return redirect()->route('permissions.index');
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
        $list = Permission::all();
        $permission = Permission::find($id);
        return view('admin.permissions.form',compact('list', 'permission'));
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
                'name' => 'required|unique:permissions|max:255',
            ]
            ,[
                'name.required' => 'Vui lòng điền tên Permissin',
                'name.unique' => 'Đã có tên Permission này rồi,Vui lòng điền tên khác!',
                'name.max' => 'Bạn nhập quá kí tự cho phép!'   
            ]
        );

        $permission = new Permission();
        $permission->name = $data['name'];
        $permission->save();
        toastr()->success('Thành Công','Cập Nhật Permission thành công!');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        toastr()->success('Thành Công','Xoá Permission thành công!');
        return redirect()->route('permissions.index');
    }
}
