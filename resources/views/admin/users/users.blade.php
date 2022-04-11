@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
      <th>Fk Role</th>
      
     
    </tr>
  </thead>
  <tbody>
      @foreach($users as $user)
    <tr>
    <td>{{$user->name}}</td>
      <th>{{$user->email}}</th>
      <td>{{$user->fkrole}}</td>
      <form action="{{url('addrole',[$user->id])}}" method="post">
      {{csrf_field()}}
      <td><input class="form-control" type="number" name="addrole" id="" min="1" max="5" required></td>
      <td><button class="form-control btn btn-primary">Update Role</button></td>
      </form>
     
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection


