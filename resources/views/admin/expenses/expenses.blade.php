@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Company</th>
      <th scope="col">Purpose</th>
      <th scope="col">Amount Spent</th>
      <th scope="col">  <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addexpense">Spend</button> </th>
    </tr>
  </thead>
  <tbody>
      @foreach($expenses as $expense)
    <tr>
    <td>{{$expense->Companies->companyname}}</td>
      <th>{{$expense->purpose}}</th>
      <td>{{$expense->amount}}</td>
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addexpense">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sell Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addexpense')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">
          <select class="form-control mb-2" name="company" id="">
          <option value="">Select Company</option>
            @foreach($companies as $company)
         
            <option value="{{$company -> id}}">{{$company -> companyname}}</option>
            @endforeach
          </select>

                    <input class="form-control mb-2" type="text" name="purpose" id="" placeholder="Enter expense purpose ellaboratively->item,Quantity" required>
                   
                    <input class="form-control mb-2" type="number" name="amount" id="" min='0' placeholder="Input Expense Amount" required>
                     </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Spend</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

