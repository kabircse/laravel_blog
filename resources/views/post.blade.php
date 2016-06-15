@extends('layouts.blog-post')

@section('content')
              <!-- Blog Post -->

              <!-- Title -->
              <h1>{{ $post->title}}</h1>

              <!-- Author -->
              <p class="lead">
                  by <a href="#">{{$post->user->name}}</a>
              </p>

              <hr>

              <!-- Date/Time -->
              <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

              <hr>

              <!-- Preview Image -->
              <img class="img-responsive" src="{{ asset($post->photo->file) }}" alt="">
              {{-- ?$post->photo->file : 'http://placehold.it/900x300'--}}

              <hr>

              <!-- Post Content -->
                  <p>{{$post->body}}</p>

              <hr>

              <!-- Blog Comments -->
        @if(Auth::check())
              <!-- Comments Form -->
              <div class="well">
                  <h4>Leave a Comment:</h4>
                  {!! Form::open(['method'=>'post', 'action'=>'PostCommentsController@store', 'role'=>'form']) !!}
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group">
                      {!! Form::label('body','Body') !!}
                      {!! Form::textarea('body',null,['class'=>'form-control', 'rows'=>'3']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
              </div>
          @endif
              <hr>

              <!-- Posted Comments -->
          @if(count($comments)>0)
              <!-- Comment -->
              @foreach($comments as $row)
              <div class="media">
                  <a class="pull-left" href="#">
                      <img width="40" class="media-object" src="/uploads/images/profile_picture/{{ $row->photo_id ? $row->photo_id : 'http://placehold.it/64x64' }}" alt="">
                  </a>
                  <div class="media-body">
                      <h4 class="media-heading">{{ $row->author }}
                          <small>{{ $row->created_at->diffForHumans() }}</small>
                      </h4>
                      {{ $row->body }}
                  @if(count($row->replies)>0)
                    @foreach ($row->replies as $reply)
                          <div id="nested-comment" class="media">
                              <a class="pull-left" href="#">
                                  <img width="40" class="media-object" src="{{ $reply->photo_id ? $reply->photo_id : 'http://placehold.it/64x64' }}" alt="">
                              </a>
                              <div class="media-body">
                                  <h4 class="media-heading">{{ $reply->author }}
                                      <small>{{ $reply->created_at }}</small>
                                  </h4>
                                  {{ $reply->body }}
                              </div>
                          <!-- End Nested Comment -->
                            <!-- Nested Comment -->
                            <div class="comment-reply-container">
                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                              <div class="comment-reply col-sm-7">
                                  {!! Form::open(['method'=>'post', 'action'=>'CommentRepliesController@createReply', 'role'=>'form']) !!}
                                    <input type="hidden" name="comment_id" value="{{ $row->id }}">
                                    <div class="form-group">
                                      {!! Form::label('Reply','Reply') !!}
                                      {!! Form::textarea('body',null,['class'=>'form-control', 'rows'=>'3']) !!}
                                    </div>
                                    <div class="form-group">
                                      {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                    </div>
                                  {!! Form::close() !!}
                              </div>
                        </div>
                      </div>
                      @endforeach
                    @endif
                  </div>
              </div>
      @endforeach
  @endif
@section('scripts')
  <script>
      $(".comment-reply-container .toggle-reply").click(function(){
          $(this).next().slideToggle('slow');
          //$(this).next().show();
      });
  </script>
@endsection

@endsection
