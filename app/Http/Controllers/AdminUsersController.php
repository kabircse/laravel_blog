<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Session;
use App\User;
use App\Role;
use App\Photo;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $inputs = $request->all();
        if($file = $request->file('photo_id')){
            $name = date('Y-m-d_his_').$file->getClientOriginalName();
            $file->move('uploads/images/profile_picture',$name);
            $photo = Photo::create(['file'=>$name]);
            $inputs['photo_id'] = $photo->id;
        }
        $inputs['password'] = bcrypt($request->password);
        User::create($inputs);
        $this->notification('bg-danger','Success');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::lists(name,id)->all();
        return view('admin.users.edit',compact('users','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $inputs = $request->except('_method','_token');//->all();
        if($file = $request->file('photo_id')){
            $name = date('Y-m-d_his_').$file->getClientOriginalName();
            $file->move('uploads/images/profile_picture/',$name);
            $photo = Photo::create(['file'=>$name]);
            $inputs['photo_id'] = $photo->id;
        }
        if(trim($request->password)!=''){
            $inputs['password'] = bcrypt($request->password);            
        }
        else
          $inputs = $request->except('_method','_token','password');
        User::where('id',$id)->update($inputs);
        $this->notification('bg-danger','Success');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path().$user->photo->file);
        $user->delete();
        $this->notification('bg-danger','Success');
        return redirect('admin/users');
    }
    public function notification($alert,$msg){
        Session::flash('alert-bg-color',$alert);
        Session::flash('alert-msg',$msg);
    }
}
