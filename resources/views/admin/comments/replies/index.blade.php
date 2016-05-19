@extends('layouts.admin')

  @section('content')
    <div class="col-sm-7">
        <h2>Media List</h2>
        @include('includes.form_error')
        <table class="table table-hovered table-condensed">
          <thead>
            <tr>
              <td>No</td>
              <td>File</td>
              <td>Created</td>
            </tr>
          </thead>
          <tbody>
          @if($photos)
            @foreach($photos as $photo)
              <tr>
                <td>{{ $photo->id }}</td>
                <td>{{ $photo->file }}</td>
                <td>{{ $photo->created_at->diffForHumans()}}</td>
              </tr>
            @endforeach
          @endif
          </tbody>
        </table>
    </div>
  @endsection