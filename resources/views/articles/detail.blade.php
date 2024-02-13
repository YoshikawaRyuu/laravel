@extends('layouts.app')
@section('content')
@if (session('error'))
    <div class="alert alert-warning">
        {{session('error')}}
    </div>
            
@endif
@if (session('article-delete-error'))
    <div class="alert alert-warning">
        {{session('article-delete-error')}}
    </div>
@endif
<div class="container">
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="cart-title">
                {{$article->title}}
            </h5>
            <div class="card-subtitle mb-2 text-muted small">
                {{$article->created_at->diffForHumans()}}
                Cateogry:<b>{{$article->category->name}}</b>,
                By:<b>{{$article->user->name}}</b>
            </div>
            <p class="card-text">
                {{$article->body}}
            </p>
            @auth
                <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-danger">Delete</a>
            @endauth
            
        </div>
    </div>

    <ul class="list-group mb-2">
        <li class="list-group-item active">
            <b>Comments ({{count($article->comments)}})</b>
        </li>
        @foreach ($article->comments as $comment)
            <li class="list-group-item">
                @auth
                <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end"></a>
                @endauth
                {{$comment->content}}
                <div class="small mt-2">
                    By <b>{{$comment->user->name}}</b>,
                    {{$comment->created_at->diffForHumans()}}
                </div>
            </li>
        @endforeach
    </ul>
    @auth
        <form action="{{url('/comments/add')}}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <textarea name="content" id="content" cols="30" rows="3" class="form-control mb-2" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
    @endauth
    
</div>

@endsection