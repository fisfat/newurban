@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            CREATE A NEW POST
        </div>
        <div class="card-body">
            <form action="{{route('articles.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Title</div>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Input the Post/Article title"/>
                </div>

                <div class="input-group mt-4">
                    
                    <textarea name="content" rows="20" class="form-control my-editor"></textarea>
                </div>

                <div class="input-group mt-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Image (2mb MAX)</div>
                    </div>
                    <input type="file" class="form-control" name="image" />
                </div>

                    <input type="submit" class="btn btn-primary btn-sm float-right mt-3" name="submit" value="Create Article" />

            </form>
        </div>
    </div>
@endsection