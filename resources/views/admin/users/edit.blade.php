@extends('layouts.admin')

@section('content')
  <div class="col-sm-7">
      <h2>Edit User</h2>
        @include('includes.form_error')
        {!! Form::model($user,array('method' => 'PATCH', 'action' => ['AdminUsersController@update',$user->id],'files'=>true)) !!}
        <div class="form-group">
            {!! Form::label('name','User Name') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email','Email') !!}
            {!! Form::text('email',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('role_id','Role') !!}
            {!! Form::select('role_id',[''=>'Select One']+$roles,null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status') !!}
            {!! Form::select('is_active',array('1'=>'Active','0'=>'No Active'),null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Picture') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>          
        <div class="form-group">
            {!! Form::label('password','Password') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>          
        <div class="form-group">
            {!! Form::submit('Update User',['class'=>'btn btn-primary col-sm-2 pull-left']) !!}
        </div>          
        {!! Form::close() !!}
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id]]) !!}                   
          <div class="form-group">
              {!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-2 col-sm-offset-1']) !!}
          </div>
        {!! Form::close() !!}        
  </div>
  <div class="col-sm-3">
      <img src="{{ $user->photo->file ? $user->photo->file : 'http://placehold.it/400*400'}}" class="img-responsive img-round">
  </div>
@endsection