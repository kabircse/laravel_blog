@extends('layouts.admin')

@section('content')
  <div class="row">
      @include('includes.form_error')
      <h2>Users</h2>          
      <table class="table table-bordered table-hovered table-condensed">
        <thead>
          <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Body</th>  
            <th>Category</th>
            <th>Photo</th>
            <th>User</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
              <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>                
                <td>{{ str_limit($post->body,120) }}</td>
                <td>{{ $post->category->name }}</td>
                <td><img src="{{ $post->photo->file ? $post->photo->file : 'http://placehold.it/400*400'}}" alt="Profile Picture" class="img-rounded" width="50" height="40"></td>
                <td>{{ $post->user->name }}</td>                  
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.posts.edit',$post->id) }}">Edit</a></td>
                <td>{!!Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy',$post->id]])!!}
                      {!!Form::submit('Delete',['class'=>'col-md-9 btn-xs btn-danger'])!!}
                    {!!Form::close()!!}
                </td>
              </tr>
              @endforeach
          @endif
        </tbody>
      </table>
        <div class="pagination col-sm-2 col-sm-offset-3">{{ $posts->links() }}</div>
  </div>
@endsection