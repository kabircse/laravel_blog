@extends('layouts.admin')

@section('content')
  <div class="col-sm-7">
      <h2>New User</h2>
        @include('includes.form_error')
        {!! Form::open(array( 'method' => 'post', 'action' => 'AdminUsersController@store','enctype' => 'multipart/form-data','role'=>'form')) !!}
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
            {!! Form::select('is_active',array('1'=>'Active','0'=>'No Active'),0,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo','Picture') !!}
            {!! Form::file('photo',null,['class'=>'form-control']) !!}
        </div>
          
        <div class="form-group">
            {!! Form::label('password','Password') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
          
        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
  </div>
@endsection