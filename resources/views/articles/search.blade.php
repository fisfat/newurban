@extends('layouts.app')

@section('content')
@if(isset($results))
    <div class="card">

        <div class="card-header">
            <h3 class="text-center">SEARCH RESULTS</h3>
        </div>

        <div class="card-body">
            <ul class="list-group list-unstyled text-center">
            
                @foreach($results as $result)
                    <a href="/articles/{{$result->id}}" style="text-decoration:none;"><li class="list-group-item">{{$result->title}} <em class="" style="font-size:12px;">Created at: {{$result->created_at}}</em></li></a>
                @endforeach
            
            </ul>
        </div>
    </div>
    <div class=" row justify-content-center m-4 ">
        {{ $results->onEachSide(4)->links() }}
    </div>
@endif
@endsection