<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Post::orderBy('id', 'DESC')->get();
        $category = Category::pluck('name','id');
        return view('admin.post.index',compact('list','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Post::all();
        $category = Category::pluck('name','id');

        return view('admin.post.form',compact('list','category'));
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
                'title' =>'required|unique:posts|max:255',
                'content' =>'required',
                'author' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

            ],
            [
                'title.unique' =>'Tên danh mục đã có ,xin điền tên khác',
                'title.required' =>'Vui lòng điền tên bài viết!',
                'content.required' =>'Vui lòng điền nội dung!',
                'author.required' =>'Vui lòng điền tên tác giả!',
                'category_id.required' =>'Vui lòng điền tên danh mục!',

            ]
        );

        $post = new Post();
        $post->title =$data['title'];
        $post->category_id =$data['category_id'];
        $post->content =$data['content'];
        $post->author =$data['author'];
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/article/', $new_image);
            $post->image = $new_image;
        }
        $post->save();
        toastr()->success('Thành công','Thêm danh mục thành công.');
        return redirect()->route('post.index');
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
        $post = Post::find($id);
        $category = Category::pluck('name','id');
        $list = Post::all();
        return view('admin.post.form',compact('list','post','category'));
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
                'title' =>'required|max:255',
                'content' =>'required',
                'author' => 'required',
                'category_id' => 'required',
            ],
            [
                'title.required' =>'Vui lòng điền tên bài viết!',
                'content.required' =>'Vui lòng điền nội dung!',
                'author.required' =>'Vui lòng điền tên tác giả!',
                'category_id.required' =>'Vui lòng điền tên danh mục!',

            ]
        );
        $post =  Post::find($id);
        $post->title =$data['title'];
        $post->category_id =$data['category_id'];
        $post->content =$data['content'];
        $post->author =$data['author'];
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/article/', $new_image);
            $post->image = $new_image;
        }
        $post->save();
        toastr()->success('Thành công','Sửa bài viết thành công.');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        toastr()->info('Thành công', 'Xoá bài vi thành công.');
        return redirect()->route('post.index');
    }
}
