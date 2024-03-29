<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Predis\Client;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index() {
        // Kiểm tra xem dữ liệu đã được lưu trong cache chưa
        $cache = Redis::get('categories');
    
        if ($cache) {
            // Nếu có dữ liệu trong cache, trả về dữ liệu từ cache
            $list = json_decode($cache);
        } else {
            // Nếu không có dữ liệu trong cache, thực hiện truy vấn cơ sở dữ liệu
            $list = Category::orderBy('id', 'DESC')->get();
    
            // Lưu danh sách categories vào cache để sử dụng cho các lần truy cập sau
            Redis::set('categories', json_encode($list));
        }
    
        return view('admin.category.index', compact('list'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Category::all();
        return view('admin.category.form', compact('list'));
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
                'name' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories'
            ],
            [
                'name.unique' => 'Tên danh mục đã có ,xin điền tên khác',
                'name.required' => 'Vui lòng điền tên danh mục!',
                'slug.required' => 'Vui lòng điền đường dẫn!',
                'slug.unique' => 'Vui lòng điền đường dẫn khác',
            ]
        );

        $category = new Category();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->save();
        toastr()->success('Thành công', 'Thêm danh mục thành công.');
        return redirect()->route('category.index');
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
        $category = Category::find($id);
        $list = Category::all();
        return view('admin.category.form', compact('list', 'category'));
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
                'name' => 'required|max:255',
                'slug' => 'required',

            ],
            [
                'name.required' => 'Vui lòng điền tên danh mục!',
                'slug.required' => 'Vui lòng điền đường dẫn!',
            ]
        );
        $category =  Category::find($id);
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->save();
        toastr()->success('Thành công', 'Sửa danh mục thành công.');
        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        Category::find($id)->delete();
        toastr()->info('Thành công', 'Xoá danh mục thành công.');
        return redirect()->route('category.index');
    }
}
