@extends('layouts.admin')

@section('content')
  <div class="row">
      @include('includes.form_error')
      <h2>Users</h2>
      <table class="table table-bordered table-hovered table-condensed">
        <thead>
          <tr>
            <th>No.</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Active Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $row)
              <tr>
                <td>{{ $row->id }}</td>
                <td><img src="{{ asset($row->photo->file) }}" class="img-rounded" width="50" alt="Profile Picture"></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->role->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->is_active==1 ?'Active':'Not active' }}</td>
                <td>{{ $row->created_at->diffForHumans() }}</td>
                <td>{{ $row->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.users.edit',$row->id) }}">Edit</a></td>
                <td>{!!Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$row->id]])!!}
                      {!!Form::submit('Delete',['class'=>'col-md-9 btn-xs btn-danger'])!!}
                    {!!Form::close()!!}
                </td>
              </tr>
              @endforeach
          @endif
        </tbody>
      </table>
        <div class="pagination col-sm-2 col-sm-offset-3">{{ $users->links() }}</div>
  </div>
@endsection
