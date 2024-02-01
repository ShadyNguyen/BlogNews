<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function home()
    {
        // $cate_slug = Category::where('slug',$slug)->frist();
        $category = Category::orderBy('id', 'asc')->get();
        $post = Post::orderBy('id', 'desc')->get();
        // $post_cate = [];
        // foreach ($category as $cate) {
        //     $post_cate[$cate->name] = Post::where('category_id', $cate->id)->get();
        // }
        foreach ($category as $cate) {
            $cate->posts = Post::where('category_id', $cate->id)->get();
        }
        return view('pages.home', compact('post', 'category','cate'));
    }

    public function article()
    {
        $slider = Post::orderBy('id', 'desc')->take(5)->get();
        $post = Post::all();
        $category = Category::all();
        return view('pages.article', compact('slider', 'category', 'post'));
    }
}
