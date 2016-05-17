@extends('layouts.admin')

  @section('content')
    <div class="col-sm-4 pull-left">
      <h2>Create Category</h2>
          @include('includes.form_error')
          {!!  Form::open(['method'=>'post', 'action' => 'AdminCategoriesController@store', 'role'=>'form']) !!}
            <div class="form-group">
              {!! Form::label('name','Name') !!}
              {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
            </div>
          {!! Form::close() !!}
    </div>
      <div class="col-sm-7">
      <h2>Category List</h2>
      @include('includes.form_error')
        <table class="table table-condensed">
          <thead>
            <tr>
              <td>No</td>
              <td>Name</td>
              <td>Created At</td>
              <td>Updated At</td>                
              <td>Edit</td>
              <td>Delete</td>                
            </tr>
          </thead>
          <tbody>
            @if($categories)
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>                    
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td>{{ $category->updated_at->diffForHumans() }}</td>  
                    <td><a href="{{ route('admin.category.edit',$category->id) }}">Edit</></td>
                    <td>
                      {!! Form::open(['method'=>'delete','action'=>['AdminCategoriesController@destroy',$category->id]])!!}
                        {!! Form::submit('Delete',['class'=>'btn-mini btn-danger']) !!}
                    </td>
                  </tr>
                @endforeach
            @endif
          </tbody>
        </table>
      </div>
      {{ $categories->render() }}  
  @endsection