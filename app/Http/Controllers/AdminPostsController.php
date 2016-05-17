<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Category;
use Auth;
use Session;
class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::lists('name','id')->all();
        return view('admin.posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
      $posts = $request->all();
      if($file = $request->file('photo_id')){
          $name = date('Y-m-d_his').$file->getClientOriginalName();
          $file->move('uploads/images/profile_picture',$name);
          $photo = Photo::create(['file'=>$name]);
          $posts['photo_id'] = $photo->id;
      }
      $posts['user_id'] = Auth::user()->id;
      Post::create($posts);
      $this->notification('bg-danger','Success');
      return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $category = Category::lists('name','id')->all();
        return view('admin.posts.edit',compact('post','category'));
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
        $posts = $request->except(['_method','_token']);
        if($file = $request->file('photo_id')){
            $name = date('Y-m-d_his_').$file->getClientOriginalName();
            $file->move('uploads/images/profile_picture',$name);
            $photo = Photo::create(['file'=>$name]);
            $posts['photo_id'] = $photo->id;
        }
        Post::where('id',$id)->first()->update($posts);
        $this->notification('bg-danger','Success');
        return redirect('admin/posts/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path().$post->photo->file);
        $post->delete();
        $this->notification('bg-danger','Success');
        return redirect('admin/posts/');
    }
    public function notification($alert,$msg){
        Session::flash('alert-bg-color',$alert);
        Session::flash('alert-msg',$msg);
    }
}
