<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home()
    {
        $category = Category::all();
        $post = Post::all();
        $post_cate = [];
        foreach ($category as $cate) {
            $posts = Post::where('category_id', $cate->id)->get();
            $post_cate[$cate->id] = $posts;
        }
        return view('pages.home', compact('post', 'category', 'post_cate'));
    }

    public function category($slug)
    {
        $category = Category::all();
        $cate_slug = Category::where('slug', $slug)->firstOrFail();
        $post = Post::where('category_id', $cate_slug->id)->orderBy('id', 'desc')->get();
        return view('pages.category', compact('category', 'post', 'cate_slug'));
    }


    public function article($slug)
    {
        $category = Category::all();
        $post = Post::where('slug', $slug)->orderBy('updated_at', 'desc')->first();
        $related = Post::with('category')->where('category_id', $post->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get(); // hiển thị những phim ở phần có thể bạn muốn xem ramdom trừ phim đang chọn
        $article = Post::all();
        return view('pages.article', compact('category', 'post', 'related', 'article'));
    }
}
