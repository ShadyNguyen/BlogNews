<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function upload(Request $request)
    //  {
    //      // Kiểm tra xem có tệp được gửi lên không
    //      if ($request->hasFile('upload')) {
    //        $originName = $request->file('upload')->getClientOriginalName();
    //        $fileName = pathinfo($originName, PATHINFO_FILENAME);
    //        $extension = $request->file('upload')->getClientOriginalExtension();
    //        $fileName = $fileName . '_' .time() . '.' . $extension;

    //        $request->file('upload')->move(public_path('uploads/image/'), $fileName);

    //        $url = asset('uploads/image/' . $fileName );
    //        return response()->json(['fileName'=> $fileName, 'uploaded' => 1 , 'url' => $url]);
    //      }

    //  }
    public function index()
    {
        // Kiểm tra xem dữ liệu đã được lưu trong cache chưa
        $cache = Redis::get('posts');

        if ($cache) {
            // Nếu có dữ liệu trong cache, trả về dữ liệu từ cache
            $list = json_decode($cache);
        } else {
            // Nếu không có dữ liệu trong cache, thực hiện truy vấn cơ sở dữ liệu
            $list = Post::orderBy('id', 'DESC')->get();

            // Lưu danh sách categories vào cache để sử dụng cho các lần truy cập sau
            Redis::set('posts', json_encode($list));
        }

        return view('admin.post.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Post::all();
        $category = Category::pluck('name', 'id');
        return view('admin.post.form', compact('list', 'category'));
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
                'title' => 'required|unique:posts|max:255',
                'content' => 'required',
                'author' => 'required',
                'slug' => 'required|unique:posts',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'describe' => 'required'
            ],
            [
                'title.unique' => 'Tên danh mục đã có ,xin điền tên khác',
                'title.required' => 'Vui lòng điền tên bài viết!',
                'content.required' => 'Vui lòng điền nội dung!',
                'author.required' => 'Vui lòng điền tên tác giả!',
                'category_id.required' => 'Vui lòng điền tên danh mục!',
                'slug.required' => 'Vui lòng điền đường dẫn',
                'slug.unique' => 'Đường dãn này đã có hãy điền đường dẫn khác!',
                'describe.required' => 'Vui lòng điền mô tả bài viết'
            ]
        );

        $post = new Post();
        $post->title = $data['title'];
        $post->category_id = $data['category_id'];
        $post->content = $data['content'];
        $post->author = $data['author'];
        $post->slug = $data['slug'];
        $post->describe = $data['describe'];

        // $post->create_at = Carbon::now('Asia/Ho_Chi_Minh');
        // $post->update_at = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/article/', $new_image);
            $post->image = $new_image;
        }
        $post->save();
        toastr()->success('Thành công', 'Thêm danh mục thành công.');
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
        $category = Category::pluck('name', 'id');
        $list = Post::all();
        return view('admin.post.form', compact('list', 'post', 'category'));
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
                'title' => 'required|max:255',
                'content' => 'required',
                'author' => 'required',
                'category_id' => 'required',
                'slug' => 'required',
                'describe' => 'required',
            ],
            [
                'title.required' => 'Vui lòng điền tên bài viết!',
                'content.required' => 'Vui lòng điền nội dung!',
                'author.required' => 'Vui lòng điền tên tác giả!',
                'category_id.required' => 'Vui lòng điền tên danh mục!',
                'slug.required' => 'Vui lòng điền đường dẫn',
                'describe.required' => 'Vui lòng điền mô tả bài viết'

            ]
        );
        $post =  Post::find($id);
        $post->title = $data['title'];
        $post->category_id = $data['category_id'];
        $post->content = $data['content'];
        $post->author = $data['author'];
        $post->slug = $data['slug'];
        $post->describe = $data['describe'];

        // $post->update_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/article/', $new_image);
            $post->image = $new_image;
        }
        $post->save();
        toastr()->success('Thành công', 'Sửa bài viết thành công.');
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
