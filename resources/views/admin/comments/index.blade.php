@extends('layouts.admin')

  @section('content')
    <div class="col-sm-9">
        <h2>Comment List</h2>
        @include('includes.form_error')
        <table class="table table-hovered table-condensed">
          <thead>
            <tr>
              <td>No</td>
              <td>Author</td>
              <td>Email</td>                
              <td>Body</td>
              <td>View Post</td>
              <td>Dis-approve</td>
              <td>Delete</td>  
            </tr>
          </thead>
          <tbody>
          @if($comments)
            @foreach($comments as $comment)
              <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->author }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->body }}</td> 
                <td><a href="{{ route('home.post',$comment->post_id) }}">View Post</a></td>
                <td>
                    @if($comment->is_active==0)
                      {!! Form::open(['method'=>'patch', 'action'=>['PostCommentsController@update',$comment->id], 'form'=>'role'])!!}
                      <input type="hidden" name="is_active" value="1">
                        <div class="form-group">
                          {!! Form::submit('Un-approve', ['class'=>'btn-xs btn-warning'])!!}
                      </div>
                      {!! Form::close() !!}
                     @else
                      {!! Form::open(['method'=>'patch', 'action'=>['PostCommentsController@update',$comment->id], 'form'=>'role'])!!}
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-group">
                          {!! Form::submit('Approve', ['class'=>'btn-xs btn-success'])!!}
                      </div>
                      {!! Form::close() !!}                        
                    @endif
                </td>
                <td>
                  {!! Form::open(array('method'=>'delete', 'action'=>['PostCommentsController@destroy',$comment->id])) !!}
                    <div class="form-group">
                      {!! Form::submit('Delete', ['class'=>'btn-xs btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td>No Comments</td>
            </tr>
          @endif
          </tbody>
        </table>
    </div>
  @endsection