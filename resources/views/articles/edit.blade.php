@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            Edit Your Post
        </div>
        <div class="card-body">
            <form action="{{ route('articles.update', [$article->id]) }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Title</div>
                    </div>
                    <input type="text" class="form-control" name="title" value="{{$article->title}}" />
                </div>

                <div class="input-group mt-4">
                    
                    <textarea name="content" rows="20" class="form-control my-editor">{{$article->body}}</textarea>
                </div>

                <div class="input-group mt-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Image</div>
                    </div>
                    <input type="file" class="form-control" name="image" />
                </div>

                
                   
                    <input type="submit" class="btn btn-primary btn-sm float-right mt-5" name="submit" value="Save Changes" />
                

            </form>
        </div>
    </div>
@endsection