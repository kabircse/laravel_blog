@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
    </div>
@endif

@if(Session::has('alert-msg'))
    <div class="col-sm-3 col-sm-offset-4">
        <span class="{{ Session::get('alert-bg-color') }}">{{ Session::get('alert-msg') }}</span>
    </div>
@endif