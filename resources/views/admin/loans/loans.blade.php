@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Customer Name</th>
    <th scope="col">Customer Number</th>
      <th scope="col">Items Purchased</th>
      <th scope="col">Amount Loaned</th>
      <th scope="col">Amount Paid</th>
      <th scope="col">Amount Balance</th>
      <th scope="col">Loan Status</th>
      <th scope="col">  <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addloan">Loan Products</button> </th>
    </tr>
  </thead>
  <tbody>
      @foreach($loans as $loan)
    <tr>
    <td>{{$loan->customername}}</td>
      <th>{{$loan->customernumber}}</th>
      <td>{{$loan->itemspurchased}}</td>
      <td>{{$loan->amountloaned}}</td>
      <td>{{$loan->amountpaid}}</td>
      <td>{{$loan->amountbalance}}</td>
      <td>{{$loan->loanstatus}}</td>
      @if($loan->loanstatus !== 'completed')
      <form action="{{url('payloan',[$loan->id])}}" method="post">
      {{csrf_field()}}
      <td><input class="form-control" type="number" name="payloan" id="" min="100" required></td>
      <td><button class="form-control btn btn-primary">Pay</button></td>
      </form>
      @else
      <td> <p style="color:green">Payment Fully Completed</p></td>
      @endif
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addloan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">LOAN PRODUCTS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addloan')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">

                    <input class="form-control mb-2" type="text" name="customername" id="" placeholder="Enter customer name">
                    <input class="form-control mb-2" type="text" name="customernumber" id="" placeholder="Enter customer number">
                    <textarea class="form-control mb-2" name="itemspurchased" id="" cols="30" rows="10" placeholder="Enter Detailed Product values on loan"></textarea>
                    <input class="form-control mb-2" type="number" name="amountloaned" id="" min='0' placeholder="Input Loan Amount">
                     </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Loan</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

