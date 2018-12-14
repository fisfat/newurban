@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="jumbotron text-center">
                    <h1>{{$user->name}}</h1>
                </div>
                <div class="text-justify p-4">
                    
                    <table class="table table-bordered table-hover">
  {{-- <thead>
    <tr>
      
      <th scope="col">First</th>
      <th scope="col">Last</th> 
    </tr>
  </thead> --}}
  <tbody>
    <tr> 
      <td>Email</td>
      <td>{{$user->email}}</td>
    </tr>
    <tr>
      <td>Join date</td>
      <td>{{$user->created_at}}</td>
    </tr>
    <tr> 
      <td>Role</td>
      <td>@if($user->role_id == 1) User  @else Admin  @endif</td>
    </tr>
    <tr> 
      <td>Change user role</td>
      <td class="pl-0"><form action="/admin/user/{{$user->id}}" id="form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="submit" onclick="return confirm('Change Role?')" class="btn btn-primary ml-4 btn-sm" name="submit" value="change user role" /> to @if($user->role_id == 1) Admin @else User @endif
                    </form>
      </td>
    </tr>
    <tr>
      <td>Action</td>
      <td class="pl-0"><form action="/admin/user/{{$user->id}}" id="form" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="submit" onclick="return confirm('Are you sure you want to @if($user->active == false)Restrict User ? @else Unrestrict User @endif')" class="btn btn-warning ml-4 btn-sm" name="deactivate" value="@if($user->active == false) Un-restrict User @else Restrict User @endif" />
                    </form>
                    <small style="color:red" class="">This will be used to control comment sections. Restricted users wont be able to post comments.</small>
        </td>
    </tr>
  </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection