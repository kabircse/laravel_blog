@extends('layouts.admin')

@section('content')
  <div class="col-sm-7">
      <h2>Edit Post</h2>
        @include('includes.form_error')
        {!! Form::model($post,array( 'method' => 'patch', 'action' => ['AdminPostsController@update',$post->id],'files' => true,'role'=>'form')) !!}
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
            {!! Form::select('category_id',[''=>'Select One']+$category,null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id','Picture') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
        </div>          
        <div class="form-group">
            {!! Form::submit('Update Post',['class'=>'btn btn-primary pull-left']) !!}
        </div>
        {!! Form::close() !!}
        <div class="form-group">
          {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy',$post->id]])!!}
            {!! Form::submit('DELETE',['class'=>'btn btn-danger col-sm-2 col-sm-offset-2']) !!}
          {!! Form::close() !!}
        </div>
  </div>
@endsection