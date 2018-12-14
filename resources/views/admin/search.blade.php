@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">E-mail</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
            @if(count($newbies) > 0)
                
                @foreach($newbies as $newbie)
                    <tr>
                        <th scope="row">{{$newbie->email}}</th>
                        <td>{{$newbie->name}}</td>
                        <td> <a href="/admin/user/{{$newbie->id}}" class="btn btn-primary btn-sm">View User</a></td>
                    </tr>
                @endforeach 
            @endif   
                </tbody>
                
            </table>
            <div class="row justify-content-center">
                {{$newbies->links()}}
            </div>
        </div>

    </div>
@endsection