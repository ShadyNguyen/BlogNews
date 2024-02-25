<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Post::orderBy('id', 'ASC')->get();
        $arr = [
            'status' => true,
            'message' => "Danh sách bài viết",
            'data'=>PostResource::collection($list)
            ];
        return response()->json($arr, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'title' => 'required|unique:posts|max:255',
                'slug' => 'required|unique:posts|max:255',
                'describe' => 'required||max:255',
                'author' => 'required|max:255',
                'content' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100, min_height=100,max_width=2000, max_height=2000',

            ],
            [
                'title.unique' => 'Tên bài viết đã có ,xin điền tên khác',
                'slug.unique' => 'Đường dẫn bài viết đã có ,xin điền đường dẫn khác',
                'title.required' => 'Vui lòng điền tên bài viết!',
                'slug.required' => 'Vui lòng điền đường dẫn bài viết!',
                'describe.required' => 'Vui lòng điền mô tả bài viết!',
                'image.required' => 'Vui lòng thêm ảnh bài viết!',
                'author.required' => 'Vui lòng điền tác giả bài viết!',
                'content.required' => 'Vui lòng điền nội dung bài viết!',

            ]
        );
        if ($validator->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }
        $post = Post::create($input);
        $arr = [
            'status' => true,
            'message' => "Bài viết đã lưu thành công",
            'data' => new PostResource($post)
        ];
        return response()->json($arr, 201);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'title' => 'required|unique:posts|max:255',
                'slug' => 'required|max:255',
                'describe' => 'required||max:255',
                'author' => 'required|max:255',
                'content' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100, min_height=100,max_width=2000, max_height=2000',

            ],
            [
                'title.unique' => 'Tên bài viết đã có ,xin điền tên khác',
                'title.required' => 'Vui lòng điền tên bài viết!',
                'slug.required' => 'Vui lòng điền đường dẫn bài viết!',
                'describe.required' => 'Vui lòng điền mô tả bài viết!',
                'image.required' => 'Vui lòng thêm ảnh bài viết!',
                'author.required' => 'Vui lòng điền tác giả bài viết!',
                'content.required' => 'Vui lòng điền nội dung bài viết!',

            ]
        );
        if ($validator->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }
        $post = Post::find($id);
        $post->title = $input['title'];
        $post->describe = $input['describe'];
        $post->image = $input['image'];
        $post->author = $input['author'];
        $post->content = $input['content'];
        $post->slug = $input['slug'];
        $post->save();
        $arr = [
            'status' => true,
            'message' => 'Bài viết cập nhật thành công',
            'data' => new PostResource($post)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        $arr = [
            'status' => true,
            'message' => 'Bài viết đã được xóa',
            'data' => [],
        ];
        return response()->json($arr, 200);
    }
}
