@extends('layouts.admin')

@section('content')
  <div class="row">
      <h2>Users</h2>          
      <table class="table table-bordered table-hovered table-condensed">
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Active Status</th>
            <th>Created At</th>
            <th>Updated At</th>              
          </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $row)
              <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->role->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->is_active==1 ?'Active':'Not active' }}</td>
                <td>{{ $row->created_at->diffForHumans() }}</td>
                <td>{{ $row->updated_at->diffForHumans() }}</td>
              </tr>
              @endforeach
          @endif
        </tbody>
      </table>
  </div>
@endsection