@extends('layouts.blog-post')

@section('content')
    <h1 class="page-header">
        Recent Post
        <small>Read latest post</small>
    </h1>

    <!-- First Blog Post -->
    @foreach ($posts as $post)
        <h2>
            <a href="{{route('home.singlePost',$post->slug)}}">{{$post->title}}</a>
        </h2>
        <p class="lead">
            by <a href="index.php">{{$post->user->name}}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
        <hr>
        <img class="img-responsive img-round" width="85" src="{{ asset($post->photo->file)}}">
        {{-- ? $post->photo->file : 'http://placehold.it/900x300'}}--}}
        <hr>
        <p>{{str_limit($post->body,450)}}</p>
        <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
    @endforeach
    <!-- Pager -->
    <ul class="pager">
      {{$posts->render()}};
    </ul>

@endsection
