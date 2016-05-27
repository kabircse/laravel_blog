@extends('layouts.admin')

  @section('content')
    <div class="col-sm-9">
        <h2>Comment Reply List</h2>
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
          @if(count($replies))
            @foreach($replies as $reply)
              <tr>
                <td>{{ $reply->id }}</td>
                <td>{{ $reply->author }}</td>
                <td>{{ $reply->email }}</td>
                <td>{{ $reply->body }}</td>
                <td><a href="{{ route('home.post',$reply->comment->post_id) }}">View Post</a></td>
                <td>
                    @if($reply->is_active==0)
                      {!! Form::open(['method'=>'patch', 'action'=>['CommentRepliesController@update',$reply->id], 'form'=>'role'])!!}
                      <input type="hidden" name="is_active" value="1">
                        <div class="form-group">
                          {!! Form::submit('Un-approve', ['class'=>'btn-xs btn-warning'])!!}
                      </div>
                      {!! Form::close() !!}
                     @else
                      {!! Form::open(['method'=>'patch', 'action'=>['CommentRepliesController@update',$reply->id], 'form'=>'role'])!!}
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-group">
                          {!! Form::submit('Approve', ['class'=>'btn-xs btn-success'])!!}
                      </div>
                      {!! Form::close() !!}
                    @endif
                </td>
                <td>
                  {!! Form::open(array('method'=>'delete', 'action'=>['CommentRepliesController@destroy',$reply->id])) !!}
                    <div class="form-group">
                      {!! Form::submit('Delete', ['class'=>'btn-xs btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td class="text text-danger">No Replies</td>
            </tr>
          @endif
          </tbody>
        </table>
    </div>
  @endsection
