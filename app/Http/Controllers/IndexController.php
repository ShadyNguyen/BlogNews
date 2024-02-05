<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

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

    public function category($slug){
        $category = Category::where('slug', $slug)->orderBy('id','desc')->get();
        dd($category);
        // return view('pages.category',compact('category'));
    }

    public function article()
    {
        $slider = Post::orderBy('id', 'desc')->take(5)->get();
        $post = Post::all();
        $category = Category::all();
        return view('pages.article', compact('slider', 'category', 'post'));
    }
}
