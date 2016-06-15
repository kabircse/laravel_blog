<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        $categories = Category::take(10)->get();
        return view('home',compact('posts','categories'));
    }
   public function post($slug)
   {
       $post = Post::findBySlugOrFail($slug);
       $categories = Category::take(10)->get();
       $comments = $post->comments()->whereIsActive(1)->get();
       return view('post',compact('post','categories','comments'));
   }
}
