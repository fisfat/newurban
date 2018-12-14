@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron text-center">
                <h1>{{Auth::user()->name}}</h1>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mt-3">
                    <div class="card">
                <div class="card-header text-center">
                    ACTIONS
                </div>
                <div class="card-body" style="font-size:13px;">
                    <ul class="list-group list-unstyled">
                            <a href="/articles/create"><li class="list-group-item">Make new Post</li></a>
                    </ul>
                </div>  
            </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                <div class="card-header text-center">
                    SEARCH USER
                </div>
                <div class="card-body pt-1" style="font-size:13px;">
                    <div class="row">
                        <div class="col-md-12">
                        <form action="/search" method="get">
                            @csrf
                            <div class="input-group justify-content-center p-2">
                                <input type="text" name="req" oninput="document.getElementById('search').disabled=false;" class="form-control" placeholder="Search name or email"/>
                                <div class="input-group-append">
                                    <input type="submit" disabled id="search" name="submit" class="btn btn-primary btn-sm" value="Search">
                                </div>
                            </div>
                        </form>
                            <h4 class="text-center">Newbies</h4>
                            <ul class="list-group">
                                @foreach($newUsers as $new)
                                    <a href="/admin/user/{{$new->id}}"><li class="list-group-item">{{$new->email}}</li></a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header text-center">
                    MY POSTS
                </div>
                <div class="card-body pb-0" style="font-size:13px;">
                     <form id="search" role="get" class="mb-4" action="/find" style="width:100%;">
                            <div class="input-group">
                                <input type="search" name="req" placeholder="search for your post" class="form-control">
                                <span class="input-group-btn"> <button type="submit" name="button" class="btn btn-primary"> <i class="fa fa-search" id="icon2"></i> </button> </span>
                            </div>
                    </form>
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Article Title</th>
                        
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
            
                
                @foreach($articles as $article)
                    <tr>
                        <th scope="row"><a href="/articles/{{$article->id}}">{{$article->title}}</a></th>
                        <td>
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item"> <a class="btn btn-primary btn-sm" href="/articles/{{$article->id}}/edit"> <i class="fa fa-edit" style="color:#fff;"></i> </a> </li>
                                <li class="list-inline-item mt-1"> 
                                    <form action="{{route('articles.destroy', [$article->id])}}" method="post" id="delete-form">
                                    @csrf
                                    @method('delete')
                                    </form>
                                <a class="btn btn-danger btn-sm" 
                                onclick="var x = confirm('Are you sure you want to delete this post?');
                                            if(x){
                                                event.preventDefault;
                                                document.getElementById('delete-form').submit();
                                            }
                                "
                                > <i class="fa fa-trash" style="color:#fff;"></i> </a> </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach  
                </tbody>
                
            </table>
                    <div class="row justify-content-center mt-2 ">
                        {{$articles->links()}}
                    </div>
                </div>  
            </div>
        </div>
    </div>

@endsection