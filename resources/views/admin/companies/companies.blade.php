@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Company Name</th>
    <th scope="col">Company Admin</th>
     <th scope="col">  <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addcompany">Add Company</button> </th>
    </tr>
  </thead>
  <tbody>
      @foreach($companies as $company)
    <tr>
    <td>{{$company->companyname}}</td>
      <th>{{$company->User->name}}</th>
      
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addcompany">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADD COMPANY</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addcompany')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">

                    <input class="form-control mb-2" type="text" name="companyname" id="" placeholder="Enter company name" required>
                   <select class="form-control mb-2" name="fkadmin" id="">
                   <option value=" ">Select Company Admin</option>
                   @foreach($users as $user)
                      
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                   </select>
                     </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Create</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

