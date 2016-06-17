
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    @if(count($categories)>0)
      <div class="well">
          <h4>Categories</h4>
          <div class="row">
              <div class="col-lg-6">
                  <ul class="list-unstyled">
                    @foreach($categories as $row)
                      <li><a href="{{ URL::to('home/categoryposts',$row->id) }}">{{$row->name}}</a> </li>
                    @endforeach
                  </ul>
              </div>
              <!-- /.col-lg-6 -->
          </div>
          <!-- /.row -->
      </div>
    @endif

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>
