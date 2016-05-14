@extends('layouts.admin')

@section('content')
  <div class="col-sm-7">
      <h2>New Post</h2>
        @include('includes.form_error')
        {!! Form::open(array( 'method' => 'post', 'action' => 'AdminPostsController@store','files' => true,'role'=>'form')) !!}
        <div class="form-group">
            {!! Form::label('title','Title') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body','Description') !!}
            {!! Form::textarea('body',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cateogy_id','Category') !!}
            {!! Form::select('category_id',[''=>'Select One','a'=>'b'],null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Picture') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>          
        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
  </div>
@endsection