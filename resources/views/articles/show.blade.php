@extends('layouts.app')

@section('content')
    <div class="card mb-5">
    <div class="card-header">
        <div class="text-right">
            @if(!Auth::guest() && Auth::user()->role_id == 2)
                <a href="/articles/create"> Create new article </a>
                    <i> &nbsp&nbsp;  </i>
                @if($article->user_id == Auth::user()->id)
                    <a href="/articles/{{$article->id}}/edit"> Edit this article </a>
                @endif
            @endif
        </div>
    </div>
        <div class="card-body">
            <div class="jumbotron text-center">
                <h1>{{$article->title}}</h1>
                <p>By: {{$article->user->name}}</p>
            @if($article->image != '')
                <div style="width:200px;style:200px;" class="rounded mx-auto d-block">
                    <img style="" class="img-fluid" src="/storage/images/{{$article->image}}" alt="">
                </div>
            @endif
            </div>
            <div class="text-justify p-4">
                <p>{!! $article->body !!}</p>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
            @if(Auth::check() && Auth::user()->active == true)
                <div class="col-md-6 mb-5">
                    <form action="/articles/get" method="POST">
                        @csrf
                        <h3 class="text-center p-0">Post a Comment</h3>
                        <input type="hidden" name="article_id" value="{{$article->id}}" />
                        <textarea class="form-control"  placeholder="post comment as {{Auth::user()->name}}" name="comment" rows="4" cols="80"></textarea>
                        <input type="submit" class="float-right my-2 btn btn-primary btn-sm" name="submit" value="Post Comment" />
                    </form>
                </div>
            @endif
                <div class="col-md-12">
                @if(count($comments) > 0)
                    <h3 class="text-center">COMMENTS</h3>
                @foreach($comments as $comment)  
                   <div class="container">
                    <div class="card mb-1 pb-0">
                        <div class="card-header py-0 text-center">
                            <div style="font-weight:bold;color:#000">{{$comment->name}} <small class="ml-auto"> On: {{$comment->created_at}}</small> </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-justify">{{$comment->body}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
                
                    <div class="row  justify-content-center"> {{$comments->links()}} </div>
                @endif
                </div>

            </div>
        </div>
    </div>
    
@endsection