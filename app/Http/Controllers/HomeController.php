<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\post;
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
        return view('home',compact('posts'));
    }
   public function singlePost($slug)
   {
       $posts = Post::findBySlugOrFail($slug);
       return view('post',compact('posts'));
   }
}
